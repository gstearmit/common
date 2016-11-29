<?php
/**
 * Created by PhpStorm.
 * User: ducquan
 * Date: 14/10/2015
 * Time: 14:07 PM
 */

namespace common\models\service;

use common\components\CacheClient;
use common\components\CaculatePrice;
use common\components\EbayAPIClient;
use common\models\db\Category;
use common\models\db\CustomerFollowed;
use common\models\db\SystemCurrency;
use common\models\ebay\SearchForm;
use common\models\enu\SiteConfig;
use common\models\model\EbayItem;
use common\models\solr\EbayCategorySolr;
use common\models\solr\EbayItemSolr;
use yii\base\Exception;
use yii\helpers\Json;
use common\components\TextUtility;

class EbayService
{

    private static $cache = true;
    private static $duration = 1200;

//    static function getItems($ids = [])
//    {
//        $data = EbayAPIClient::getItems($ids);
//    }

    /**
     * @param $id
     * @param int $tries
     * @return EbayItem|null
     */
    public static function getOneItem($id, $tries = 1)
    {
        if (empty($id)) {
            return null;
        }
        $cache = CacheClient::get('eb_it' . $id);

        if ($cache != false && \Yii::$app->request->get('nocache', null) == null) {
            return self::buildItemToModelItem($cache);
        }
        $data = EbayAPIClient::getItemFinal($id);

        $items = get_object_vars($data['item']);
        $shippings = get_object_vars($data['shipping']);

        foreach ($items as $k => $item) {
            if (!isset($item->title)) {
                if ($tries < 3) {
                    return self::getOneItem($id, $tries + 1);
                }
            }

            $item = self::rebuildItem($item, isset($shippings[$item->id]) && $shippings[$item->id] != null ? $shippings[$item->id] : null);
            $item = self::buildItemToModelItem($item);
            if ($item->title != null) {
                CacheClient::set('eb_it' . $id, $item);
            }
            return $item;
        }
    }

    public static function getDescriptionItem($ids)
    {
        $data = EbayAPIClient::getItemsDescription($ids);
        return $data;
    }

    public static function getItems($ids, $cache = true)
    {
        if (empty($ids)) {
            return [];
        }
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $result = [];
        if ($cache) {
            foreach ($ids as $key => $id) {
                $cacheData = CacheClient::get('eb_it' . $id);
                if ($cacheData != false) {
                    unset($ids[$key]);
                    $result[] = self::buildItemToModelItem($cacheData);
                }
            }
        }
        if (!empty($ids)) {
            $data = EbayAPIClient::getItemsFinal($ids);
            foreach ($data as $key => $rsData) {
                if (count(explode('item', $key)) == 1) {
                    continue;
                }
                if ($rsData == null) {
                    $result[] = null;
                    continue;
                }
                $item = get_object_vars($rsData);
                $ship = null;
                $desc = '';
                foreach ($item as $it) {
                    $item = $it;
                    break;
                }
                $keyShipping = str_replace('item', 'shipping', $key);

                $keyDesc = str_replace('item', 'description', $key);

                if (isset($data[$keyShipping])) {
                    $ship1 = get_object_vars($data[$keyShipping]);
                    foreach ($ship1 as $shipTmp) {
                        $ship = $shipTmp;
                        break;
                    }
                }
                if (isset($data[$keyDesc])) {
                    $tmp = get_object_vars($data[$keyDesc]);
                    foreach ($tmp as $tmpDesc) {
                        if (isset($tmpDesc->description)) {
                            $desc = $tmpDesc->description;
                            break;
                        }
                    }
                }
                $rebuild = self::rebuildItem($item, $ship, $desc);
                $item = self::buildItemToModelItem($rebuild);
                if ($cache && $item->title != null) {
                    CacheClient::set('eb_it' . $item->itemId, $rebuild, 3600);
                }
                $result[] = $item;
            }
        }
        return $result;
    }

    public static function buildItemToModelItem($item)
    {
        $item2 = new EbayItem();
        if (!isset($item->itemId) || $item->itemId == null) {
            $item->itemId = strval($item->id);
            $item->id = null;
        }
        if (isset($item->specifics) && is_array($item->specifics)) {
            foreach ($item->specifics as $specific) {
                if (isset(EbayItem::getSpecifics()[$specific->name])) {
                    $item2->setAttribute(EbayItem::getSpecifics()[$specific->name], trim($specific->value));
                }
            }
        }
        $item2->setAttributes(get_object_vars($item), false);
        if (isset($item->description))
            $item2->setAttribute('description', $item->description);
        return $item2;
    }

    public static function rebuildSubItem($subItem)
    {
        $identity = sha1('default');
        if (isset($subItem->specifics) && is_array($subItem->specifics)) {
            $identityStr = '';
            foreach ($subItem->specifics as $specifics) {
                $identityStr .= $specifics->name . $specifics->value;
            }
            $identity = sha1($identityStr);
        }
        $subItem->identity = $identity;
        return $subItem;
    }

    public static function getSeller($id, $default = null)
    {
        $cache = CacheClient::get('ES' . $id, null);
        if ($cache !== null) {
            return $cache;
        }
        $data = static::getSellers($id);
        $seller = isset($data->$id) ? $data->$id : $default;
        if ($seller !== $default) {
            CacheClient::set('ES' . $id, $seller);
        }
        return $seller;
    }

    public static function getSellers($ids, $result = [])
    {
        return EbayAPIClient::getSeller($ids);
    }

    public static function searchItems(SearchForm $searchForm)
    {
//        if (!\Yii::$app->params['useEbayAPI']) {
//            $data = EbayItemSolr::search($searchForm);
//            $updateIds = [];
//            foreach ($data->items as $item) {
//                if (EbayUpdateScheduleService::check(($item->endTime / 1000), $item->updateTime, $item->isAution == true ? 0 : 1)) {
////                    if (time() > $item->updateTime + 900) {
//                    $updateIds[$item->id] = $item->itemId;
//                }
//            }
//            $updated = [];
//            if (!empty($updateIds)) {
//                $updated = static::updateSolr($updateIds);
//                foreach ($updated as $k => $item) {
//                    $updated[$k] = EbayService::convertItem($item);
//                }
//            }
//            if (!empty($updated)) {
//                foreach ($data->items as $key => $item) {
//                    if (isset($updated[$item->itemId])) {
//                        $data->items[$key] = $updated[$item->itemId];
////                        $data->items[$key] = $updated[$item->itemId];
//                    }
//                }
//            }
//            return $data;
//
//        } else {
            if (isset($searchForm->conditions)) {
                foreach ($searchForm->conditions as $key => $condition) {
                    $obj = new \stdClass();
                    $obj->id = intval($condition);
                    $searchForm->conditions = [];
                    $searchForm->conditions[] = $obj;
                    break;
                }
            }
            if (!is_array($searchForm->sellerIds) && $searchForm->sellerIds != null) {
                $searchForm->sellerIds = [$searchForm->sellerIds];
            }
            $data = static::findItems($searchForm);
            foreach ($data->items as $key => $item) {
                $data->items[$key] = EbayService::convertItem(self::buildItemToModelItem($item));
            }
            return $data;
//        }
    }

    static $maxEndtime = 172800;

    public static function findItems($searchForm)
    {

//        $key = static::identitySearchForm($searchForm);
//        $data = CacheClient::get($key);
//        var_dump($data);die;
//        if ($data !== false) {
//            return $data;
//        }
        $data = EbayAPIClient::findItems($searchForm);

        $ids = [];
        foreach ($data->items as $item) {
            $ids[] = $item->id;
        }
        $shipping = EbayAPIClient::getItemsShipping($ids);
        $shipTaxFee = [];
        foreach ($shipping as $ship) {
            try {
                $shipTaxFee[$ship->id] = $ship;
            } catch (\Exception $e) {
                continue;
            }
        }
        $cTime = time();
        if (!empty($shipTaxFee)) {
            foreach ($data->items as $k => $item) {
                if (isset($shipTaxFee[$item->id])) {
                    $item->usShipping = $shipTaxFee[$item->id]->usShipping;
                    $item->usTax = $shipTaxFee[$item->id]->usTax;
                }
                $item_rb = static::rebuildItem($item, isset($shipTaxFee[$item->id]) ? $shipTaxFee[$item->id] : null);
                if ($item_rb->isAution && (($item_rb->endTime / 1000 - $cTime) < static::$maxEndtime)) {
                    unset($data->items[$k]);
                    continue;
                }

                $data->items[$k] = $item_rb;
            }
        }
//        CacheClient::set($key, $data);
        return $data;
    }

    private static function identitySearchForm(SearchForm $searchForm)
    {
        return md5(Json::encode($searchForm));
    }

    public static function searchAPIAddSolr(SearchForm $searchForm)
    {
        if (isset($searchForm->conditions)) {
            foreach ($searchForm->conditions as $key => $condition) {
                $obj = new \stdClass();
                $obj->id = intval($condition);
                $searchForm->conditions = [];
                $searchForm->conditions[] = $obj;
                break;
            }
        }
        if (!is_array($searchForm->sellerIds) && $searchForm->sellerIds != null) {
            $searchForm->sellerIds = [$searchForm->sellerIds];
        }
        $data = EbayAPIClient::findItems($searchForm);

        foreach ($data->items as $key => $item) {
            $data->items[$key] = EbayService::convertItem(self::buildItemToModelItem(self::rebuildItem($item)));
        }
        return $data;
    }

    public static function rebuildItem($item, $shipping = null, $desc = '')
    {
        $item->description = $desc;
        if (isset($item->listingType)) {
            $item->isAution = !in_array($item->listingType, ['StoresFixedPrice', 'FixedPrice', 'FixedPriceItem', 'StoreInventory']);
        }
        if ($shipping != null) {
            $item->usTax = $shipping->usTax;
            $item->usShipping = $shipping->usShipping;
        }
        $item->saleSpecific = [];
        if (isset($item->subItems) && (count($item->subItems) > 0)) {
            foreach ($item->subItems as $subItem) {
                $subItem = self::rebuildSubItem($subItem);
                foreach ($subItem->specifics as $specifics) {
                    if (!isset($item->saleSpecific[$specifics->name]) || !in_array($specifics->value, $item->saleSpecific[$specifics->name])) {
                        $item->saleSpecific[$specifics->name][$specifics->value][] = $subItem->identity;
                    }
                }
            }
        }
        return $item;
    }

    public static function getCategory()
    {
        $cache = CacheClient::get('categories');
        $data = $cache != false ? $cache : EbayAPIClient::getCategory();
        if ($cache == false) {
            CacheClient::set('categories', $data);
        }
        $rs = [];
        foreach ($data as $k => $cat) {
            $cat2 = new Category();
            $cat2->setAttributes(get_object_vars($cat), false);
            $cat2->alias = $cat->id;
            $cat2->id = null;
            $rs[] = $cat2;
        }
        return $rs;
    }

    public static function getCategoriesSolr($ids = [])
    {
        return EbayCategorySolr::getByAliasIds($ids, 2, 2);
    }

    public static function getTreeByLeaf($id)
    {
        $leaf = EbayCategorySolr::getOneByAlias(intval($id), 2, 2);
        $rs = [];
        if (empty($leaf->path)) {
            return [$leaf];
        }
        $list = EbayCategorySolr::getByAliasIds(explode(':', $leaf->path), 2, 2);
        foreach ($list as $cat) {
            $rs[$cat->level] = $cat;
        }
        ksort($rs);
        return $rs;

    }

    static $converted = [];

    static $currencyToTmp = [];
    static $currencyFromTmp = [];

    public static function convertItem($item, $flagOrder = false, $exRate = 0, $check = true, $siteId = SiteConfig::WESHOP_EBAY)
    {
        $checkStore = \Yii::$app->params['checkStore'];
        $storeData = SiteService::getStore($checkStore);

        $defautCurrencyData = RateService::getSystemCurrencyById($storeData->CurrencyId);
        if (!$exRate) {
            if (isset(static::$currencyFromTmp['usd'])) {
                $currencyFrom = static::$currencyFromTmp['usd'];
            } else {
                $currencyFrom = SystemCurrency::findOne(['CurrencyCode' => 'usd']);
                static::$currencyFromTmp['usd'] = $currencyFrom;
            }
            if (!empty($storeData->CurrencyId)) {
                if (isset(static::$currencyToTmp[$storeData->CurrencyId])) {
                    $currencyTo = static::$currencyToTmp[$storeData->CurrencyId];
                } else {
                    $currencyTo = SystemCurrency::findOne($storeData->CurrencyId);
                    static::$currencyToTmp[$storeData->CurrencyId] = $currencyTo;
                }
            } else {
                $currencyTo = SystemCurrency::findOne(['CurrencyCode' => 'vnđ']);
            }
            $exRate = RateService::getRate($currencyFrom->id, $currencyTo->id);
        }

        if (isset($item->itemId)) {
            if (isset(static::$converted[$item->itemId])) {
                static::$converted[$item->itemId]++;
            } else {
                static::$converted[$item->itemId] = 0;
            }
        }
        $categoryId = 0;
        $condition = false;
        $sellerId = '';
        if (isset ($item->sellerId)) {
            $sellerId = $item->sellerId;
        }
        if (isset ($item->seller->id)) {
            $sellerId = $item->seller->id;
        }

        $serviceFee = 1;
        $surchargeFee = 0;

        $item->originSellPrice = $item->sellPrice;
        $item->originStartPrice = $item->startPrice;
        $item->originBuyNowPrice = $item->buyNowPrice;

        if (isset($item->startPrice)) {
            $item->startPrice = CaculatePrice::getPriceLocal($item->startPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemPrice'];
        }
        if (isset($item->isAution) && $item->isAution == true && isset($item->sellPrice) && $flagOrder == false) {
            if ($item->sellPrice > 1) {
                $item->sellPrice = round(($item->sellPrice * (1 + $item->usTax / 100) + $item->usShipping) * $exRate);
            } else {
                $item->sellPrice = ($item->sellPrice * (1 + $item->usTax / 100) + $item->usShipping) * $exRate;
            }
            $flag = true;
        }
        if (!isset($flag) && isset($item->sellPrice)) {
            $item->sellFinalPrice = round(CaculatePrice::getPriceLocal($item->sellPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemVNPrice'], 2);
            $item->sellPrice = CaculatePrice::getPriceLocal($item->sellPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemPrice'];
        }

        if (isset($item->buyNowPrice) && $item->buyNowPrice > 0) {
            $item->buyNowPrice = CaculatePrice::getPriceLocal($item->buyNowPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemPrice'];
        }
        $numberFormatting = isset($defautCurrencyData->CustomFormatting) ? $defautCurrencyData->CustomFormatting : '.';
        if (isset($item->subItems) && $item->subItems) foreach ($item->subItems as $subItem) {
            $sale = 0;
            if (isset($subItem->startPrice) && isset($subItem->sellPrice)) {
                if ($subItem->startPrice > $subItem->sellPrice) {
                    $sale = round(($subItem->sellPrice / $subItem->startPrice) * 100, 0);
                }
            }
            $subItem->sale = $sale;

            if (isset($subItem->startPrice)) {
                $subStartPrice = CaculatePrice::getPriceLocal($subItem->startPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemPrice'];
                if ($subStartPrice < 0) {
                    $subStartPrice = 0;
                }
                $subItem->startPrice = TextUtility::numberFormat($subStartPrice, $numberFormatting);
            }
            $costPrice = 0;
            $vnShipping = 0;
            $vnTax = 0;
            $point = 0;
            $internationFee = 0;
            $restServiceFee = 0;
            if (isset($subItem->sellPrice)) {
                $costPrice = $subItem->sellPrice * $exRate;
                $vnShipping = $item->usShipping * $exRate;
                $subItem->costPrice = TextUtility::numberFormat($costPrice, $numberFormatting);
                $subItem->vnShipping = TextUtility::numberFormat($vnShipping, $numberFormatting);

                $subSellPrice = CaculatePrice::getPriceLocal($subItem->sellPrice, $item->usTax, $item->usShipping, $serviceFee, $surchargeFee, 1, $sellerId, $exRate)['itemPrice'];
                if ($subSellPrice < 0) {
                    $subSellPrice = 0;
                }
                $vnTax = $subSellPrice - ($costPrice + $vnShipping);
                $point = DiscountService::getAmountToPrice($subSellPrice, $siteId);
                $internationFee = 7 * $exRate;
                $restServiceFee = 0.08 * $subSellPrice;

                $subItem->point = TextUtility::numberFormat($point, $numberFormatting);
                $subItem->sellPrice = TextUtility::numberFormat($subSellPrice, $numberFormatting);
                $subItem->internationFee = TextUtility::numberFormat($internationFee, $numberFormatting);
                $subItem->restServiceFee = TextUtility::numberFormat($restServiceFee, $numberFormatting);

                $subItem->restTotalFee = number_format($internationFee + $restServiceFee,2);
                $subItem->vnTax = TextUtility::numberFormat($vnTax, $numberFormatting);
            }
        }
        return $item;
    }

    public static function convertItems($items)
    {
        foreach ($items as $k => $item) {
            $items[$k] = static::convertItem($item);
        }
        return $items;
    }

    public static function getUsPriceAuction($itemId, $priceVn)
    {
        $item = self::getOneItem($itemId);
        if (!$item)
            return false;
        $usTax = $item->usTax;
        $usShiping = $item->usShipping;
        $exchangeRate = RateService::getRate();
        $bidUs = $priceVn / $exchangeRate;
        $bidUs = $bidUs / (1 + $usTax / 100) - $usShiping;
        return (float)round($bidUs, 2);
    }

    public static function checkItemStatus($condition)
    {
        if (substr($condition, 0, 3) == "New") {
            return true;
        } elseif ($condition == "Brand New") {
            return true;
        }
        return false;
    }

    static $fail = [];

    public static function updateSolr1($ids)
    {
        if (empty($ids)) {
            return false;
        }
        \Yii::$app->params['cache']['enable'] = false;
        $items = EbayService::getItems($ids);
        $itemSave = [];
        $rs = [];
        $oldIds = [];
        foreach ($items as $item) {
            $oldIds[] = $item->itemId;
        }
        $oldItems = EbayItemSolr::getByIds($oldIds);
        foreach ($oldItems as $k => $item) {
            $oldItems[$item->itemId] = $item;
            unset($oldItems[$k]);
        }

        foreach ($items as $item) {
            if (!is_object($item)) {
                continue;
            }
            try {
//                $check = EbayItemSolr::getOne($item->itemId);
                $check = isset($oldItems[$item->itemId]) ? $oldItems[$item->itemId] : false;

                if ($check != false) {
                    $check->setAttributes(get_object_vars($item));
                    $check->isNewRecord = false;
                    $check->save(false);
                    $rs[$check->itemId] = $check;
                    $itemSave[] = $check->buildSolrItem();
                    continue;
                }
                if ($item->save(false)) {
                    if (in_array($item->itemId, self::$fail)) {
                        unset(self::$fail[array_search($item->itemId, self::$fail)]);
                    }
                }
            } catch (Exception $e) {
                continue;
            }
            $rs[$item->itemId] = $item;
            $itemSave[] = $item->buildSolrItem();
        }
        EbayItemSolr::updateItems($itemSave);
        return $rs;
    }

    public static function updateSolr($ids = [])
    {
        $rs = [];
        $items = EbayService::getItems($ids);
        $map = [];
        foreach ($ids as $k => $v) {
            $map[$v] = $k;
        }
        foreach ($items as $item) {
            if (!is_object($item)) {
                continue;
            }
            if (!isset($map[$item->itemId])) {
                continue;
            }
            try {
                $item->id = $map[$item->itemId];
                $rs[] = clone $item;
                $redis = new \common\models\redis\EbayItem();
//                $item->convertToSolrSave();
                $redis->setAttribute('id', $item->id);
                $redis->setAttribute('data', Json::encode($item->buildSolrItem()));
//                $redis->setAttributes($item->getAttributes(), false);
//                $redis->setAttribute('updateTime',time());
                $redis->save(false);
            } catch (\Exception $e) {
                continue;
            }
        }
        return $rs;
    }

    public static function updateSolrBAK($ids = [])
    {
//        var_dump(1);
        //var_dump(count($ids));
        $saveUpdate = [];
        $rs = [];
        $items = EbayService::getItems($ids);
        $oldIds = [];
        foreach ($items as $item) {
            $oldIds[] = $item->itemId;
        }
        $oldItems = EbayItemSolr::getByIds($oldIds);
        foreach ($oldItems as $k => $item) {
            $oldItems[$item->itemId] = $item;
            unset($oldItems[$k]);
        }
//        die(var_dump(count($oldItems)));
        foreach ($items as $item) {
            if (!is_object($item)) {
                continue;
            }
            $check = isset($oldItems[$item->itemId]) ? $oldItems[$item->itemId] : false;
//            $check = EbayItemSolr::getOne($item->itemId);
            if ($check != false) {
                $vars = get_object_vars($item);
                unset($vars['id']);
                $check->setAttributes($vars);
                if (isset($item->description)) {
                    $check->setAttribute('description', $item->description);
                }
                $isNew = false;
                $check->isNewRecord = false;
            } else {
                $isNew = true;
                $check = $item;
                $check->isNewRecord = true;
            }
            try {
                if ($isNew) {
                    $specific_Features = $check->specific_Features;
                    $check->specific_Features = '';
                    $save = $check->save(false);
                } else {
                    $save = true;
                }
                if ($save) {
                    $check->specific_Features = isset($specific_Features) ? $specific_Features : '';
                    $check->updateTime = time();
//                    echo $isNew ? 'Add new' : 'Update' . ' item ' . $item->itemId . PHP_EOL;
                    $rs[$check->itemId] = $check;
                    $redis = new \common\models\redis\EbayItem();
//                    $redis->setAttributes($check->)
//                    $solr = $check->buildSolrItem();
//                    $saveUpdate[] = $solr;
                }
            } catch (\Exception $e) {
//                echo $e->getMessage() . PHP_EOL;
//                var_dump($e->getTraceAsString());
//                echo 'Error => Sleep' . PHP_EOL;
                continue;
            }
        }
//        EbayItemSolr::updateItems($saveUpdate);
        return $rs;
    }

    public static function getFollowed()
    {
        $uid = \Yii::$app->user->isGuest ? 'guest' : \Yii::$app->user->getId();
//        $followItemIds = CacheClient::get('follow_items ' . $uid, false);
//
//        if($followItemIds != false){
//            return $followItemIds;
//        }

        $data = CustomerFollowedService::getList(\Yii::$app->user->getId(), CustomerFollowed::ebay_item, SiteConfig::EBAY_VN, SiteConfig::EBAY_VN, 'desc', 1, 10, 'objectId');
        $ids = [];
        foreach ($data->data as $item) {
            $ids[] = $item->objectId;
        }
        //$follows = 1 == CustomerFollowed::ebay_auction ? EbayService::getItems($ids) : EbayItemSolr::getByIds($ids);
        $follows = EbayService::getItems($ids);
        foreach ($follows as $k => $follow) {
            $follows[$k] = EbayService::convertItem($follow);
        }
        //CacheClient::set('follow_items ' . $uid, $follows);
        return $follows;
    }

}