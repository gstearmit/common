<?php
/**
 * Created by PhpStorm.
 * User: ducquan
 * Date: 20/10/2015
 * Time: 11:04 AM
 */

namespace common\models\solr;


use common\components\Solr\ApacheSolrDocument;
use common\models\db\EbayItem;
use common\models\ebay\DataPage;
use common\models\ebay\SearchForm;
use common\models\service\EbayService;
use yii\base\Exception;
use yii\helpers\Json;

class EbayItemSolr extends BaseSolr
{
    public static $tableName = '/solr/ebayitem';

    public static function updateOne($item)
    {
        $doc = new ApacheSolrDocument();
        foreach ($item as $key => $data) {
            if (is_array($data)) {
                foreach ($data as $value) {
                    $doc->setMultiValue($key, $value);
                }
            } else {
                $doc->$key = $data;
            }
        }
        try {
            $solrSV = self::getSolrService();
            $addDoc = $solrSV->addDocument($doc);
            if ($addDoc->getHttpStatus() == 200) {
                $commit = $solrSV->commit();
                if ($commit->getHttpStatus() == 200) {
                    $optimize = $solrSV->optimize();
                    if ($optimize->getHttpStatus() == 200) {
                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
        }
        return false;
    }

    public static function updateItems($items)
    {
        if(empty($items)){
            return null;
        }
        $solrSv = self::getSolrService();
        $documents = [];
        foreach ($items as $item) {
            $doc = new ApacheSolrDocument();
            foreach ($item as $key => $data) {
                if (is_array($data)) {
                    foreach ($data as $value) {
                        $doc->setMultiValue($key, $value);
                    }
                } else {
                    $doc->$key = $data;
                }
            }
            $documents[] = $doc;
        }
        try {
            $solrSv->addDocuments($documents);
            $solrSv->commit();
            $solrSv->optimize();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

//    public static function updateItems($ids = [])
//    {
//        $save = [];
//        $rs = [];
//        $items = EbayService::getItems($ids);
//        $oldIds = [];
//        foreach ($items as $item) {
//            $oldIds[] = $item->itemId;
//        }
//        $oldItems = EbayItemSolr::getByIds($oldIds);
//        foreach ($oldItems as $k => $item) {
//            $oldItems[$item->itemId] = $item;
//            unset($oldItems[$k]);
//        }
//        foreach ($items as $item) {
//            if (!is_object($item)) {
//                continue;
//            }
//            $check = isset($oldItems[$item->itemId]) ? $oldItems[$item->itemId] : false;
////            $check = EbayItemSolr::getOne($item->itemId);
//            if ($check != false) {
//                $vars = get_object_vars($item);
//                unset($vars['id']);
//                $check->setAttributes($vars);
//                if (isset($item->description)) {
//                    $check->setAttribute('description', $item->description);
//                }
//                $isNew = false;
//                $check->isNewRecord = false;
//            } else {
//                $isNew = true;
//                $check = $item;
//                $check->isNewRecord = true;
//            }
//            try {
//                if ($isNew) {
//                    $specific_Features = $check->specific_Features;
//                    $check->specific_Features = '';
//                    $save = $check->save(false);
//                } else {
//                    $save = true;
//                }
//                if ($save) {
//                    $rs[$check->itemId] = $check;
//                    $check->specific_Features = isset($specific_Features) ? $specific_Features : '';
//                    $check->updateTime = time();
////                    echo $isNew ? 'Add new' : 'Update' . ' item ' . $item->itemId . PHP_EOL;
//                    $save[] = $check->buildSolrItem();
//                }
//            } catch (\Exception $e) {
////                echo $e->getMessage() . PHP_EOL;
////                var_dump($e->getTraceAsString());
////                echo 'Error => Sleep' . PHP_EOL;
//                continue;
//            }
//        }
//        EbayItemSolr::updateItems($save);
//        return $rs;
//    }

    private static function buildSearchUrl(SearchForm $searchForm)
    {
        if (!$searchForm->valid()) {
            return false;
        }
        $urls = self::getStaticQuery($searchForm);
        $base = $urls['base'] . '&facet=true' . static::getPagingQuery($searchForm);
        $facets = array_merge(EbayItem::getSpecifics(), ['condition', 'location', 'sellerId']);
        foreach ($facets as $fc) {
            $base .= '&facet.field=' . $fc;
        }
        return $base;
//        $urls = self::getStaticQuery($searchForm);
//
//        $facet = self::callSearch($urls['facetOnly']);
//        if ($facet->getHttpStatus() == 200) {
//            $rs = Json::decode($facet->getRawResponse(), false);
//            $fields = $rs->facet_counts->facet_fields->facets;
//            $facets = [];
//            $i = 0;
//            foreach ($fields as $field) {
//                if ($i % 2 == 0) {
//                    $facets[] = 'specific_' . TextUtility::base64Encode($field);
//                }
//                $i++;
//            }
//            $facets = ArrayHelper::merge(static::defaultFacet(), $facets);
//            $base = $urls['base'] . '&facet=true' . static::getPagingQuery($searchForm);
//            foreach ($facets as $fc) {
//                $base .= '&facet.field=' . $fc;
//            }
//            return $base;
//        }

//        return false;
    }

    public static function getProductCare($itemId, $categoryId = null, $price = 10, $limit = 4, $offset = 0, $siteId = null, $storeId = null)
    {
        $url = '?q=-itemId:' . $itemId;
        if ($categoryId != null) {
            if (is_array($categoryId)) {
                $url .= ' AND category:(' . implode(' OR ', $categoryId) . ')';
            } else if (is_string($categoryId)) {
                $url .= ' AND category:' . $categoryId;
            }
        }
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND storeId:' . $storeId;
        }
        if ($price > 10) {
            $priceFrom = $price - 10;
            $priceTo = $price + 10;
        } else {
            $priceFrom = 0;
            $priceTo = $price + 10;
        }
        $url .= " AND sellPrice:[{$priceFrom} TO {$priceTo}]";
        $url .= "&wt=json&start={$offset}&rows={$limit}";
        //echo $url;exit();
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $items = [];
            foreach ($data->response->docs as $item) {
                $items[] = static::buildToModelItem($item);
            }
            return $items;
        }
        return false;
    }

    public static function getProductRelate($itemId, $categoryId = null, $offset = 0, $limit = 4, $siteId = null, $storeId = null)
    {
        $url = '?q=-itemId:' . $itemId;
        if ($categoryId != null) {
            if (is_array($categoryId)) {
                $url .= ' AND category:(' . implode(' OR ', $categoryId) . ')';
            } else if (is_string($categoryId)) {
                $url .= ' AND category:' . $categoryId;
            }
        }
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND storeId:' . $storeId;
        }
        $url .= "&wt=json&start={$offset}&rows={$limit}";
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $items = [];
            foreach ($data->response->docs as $item) {
                $items[] = static::buildToModelItem($item);
            }
            return $items;
        }
        return false;
    }

    public static function getOne($itemId, $siteId = null, $storeId = null)
    {
        $url = '?q=itemId:' . $itemId;
//        if ($siteId != null) {
//            $url .= ' AND siteId:' . $siteId;
//        }
//        if ($storeId != null) {
//            $url .= ' AND storeId:' . $storeId;
//        }
        $url .= '&rows=1&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            foreach ($data->response->docs as $item) {
                return static::buildToModelItem($item);
            }
            return false;
        }
        return false;
    }

    public static function getByIds($itemIds, $siteId = null, $storeId = null)
    {
        if ($itemIds == null || empty($itemIds)) {
            return [];
        }
        $itemIds == is_array($itemIds) ? $itemIds : [$itemIds];
//        $ids = [];
//        foreach ($itemIds as $id) {
//            $ids[] = 'itemId:' . $id;
//        }
        $ids = 'itemId:(' . implode(' ',$itemIds) . ')';
        $url = '?q=' . $ids . '&wt=json&rows=1000';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $rs = [];
            foreach ($data->response->docs as $item) {
                $rs[] = static::buildToModelItem($item);
            }
            return $rs;
        }
        return [];
    }

    public static function getStaticQuery(SearchForm $searchForm)
    {
        $query = [];
        $unHold = '';
        if (is_array($searchForm->unHold)) {
            foreach ($searchForm->unHold as $specific) {
                $unHold .= '&f.' . $specific . '.facet.mincount=1';
            }
        }
        if ($searchForm->keyword != null) {
            $isNum = is_numeric($searchForm->keyword);
            if ($isNum) {
                $origin = $searchForm->keyword;
            }
//            if (!is_array($searchForm->keyword)) {
//                $searchForm->keyword = explode(' ', $searchForm->keyword);
//            }
//            $sKeyword = [];
//            foreach ($searchForm->keyword as $key) {
//                $sKeyword [] = '*' . $key . '*';
//            }
//            $searchKey = 'title:(' . implode(' AND ', $sKeyword) . ')';
            $searchKey = 'title:*' . $searchForm->keyword . '*';

            if ($isNum) {
                $searchKey .= ' OR ' . 'itemId:' . $origin;
                $searchKey = '(' . $searchKey . ')';
            }
            $query[] = $searchKey;
        }
        if ($searchForm->sellerIds != null) {
            if (is_array($searchForm->sellerIds)) {
                $sSeller = [];
                foreach ($searchForm->sellerIds as $key) {
                    $sSeller [] = '"' . $key . '"';
                }
                $query [] = 'sellerId:(' . implode(' OR ', $sSeller) . ')';
            } else if (is_string($searchForm->sellerIds)) {
                $query [] = 'sellerId:"' . $searchForm->sellerIds . '"';
            }
        }
        if ($searchForm->categoryIds != null) {
            if (is_array($searchForm->categoryIds)) {
                $query [] = 'category:(' . implode(' OR ', $searchForm->categoryIds) . ')';
            } else if (is_string($searchForm->categoryIds)) {
                $query [] = 'category:' . $searchForm->categoryIds;
            }
        }
        $query [] = 'endTime: ['. time() * 1000 .' TO *]';
//        endTime: [1446780488000 TO *]
        //auction solr
        if ($searchForm->auction != null) {
            if ($searchForm->auction == 1) {
                $searchForm->auction = true;
            } else if ($searchForm->auction == 2) {
                $searchForm->auction = false;
            }
        }
        if ($searchForm->auction !== null) {
            $query [] = 'isAution:"' . strval($searchForm->auction) . '"';
        }
        //
        if ($searchForm->location != null) {
            if (is_array($searchForm->location)) {
                $sSeller = [];
                foreach ($searchForm->location as $key) {
                    $sSeller [] = '"' . $key . '"';
                }
                $query [] = 'location:(' . implode(' OR ', $sSeller) . ')';
            } else if (is_string($searchForm->location)) {
                $query [] = 'location:"' . $searchForm->location . '"';
            }
        }
        if ($searchForm->conditions != null) {
            if (is_array($searchForm->conditions)) {
                foreach ($searchForm->conditions as $k => $key) {
                    $searchForm->conditions [$k] = '"' . $key . '"';
                }
                $query [] = 'condition:(' . implode(' OR ', $searchForm->conditions) . ')';
            } else if (is_string($searchForm->conditions)) {
                $query [] = 'condition:"' . $searchForm->conditions . '"';
            }
        }
        if ($searchForm->minPrice != null || $searchForm->maxPrice != null) {
            $from = ($searchForm->minPrice != null && is_numeric($searchForm->minPrice)) ? $searchForm->minPrice : '0';
            $to = ($searchForm->maxPrice != null && is_numeric($searchForm->maxPrice)) ? $searchForm->maxPrice : '*';
            $query[] = 'sellPrice:[' . $from . ' TO ' . $to . ']';
        }
        $queryFilter = [];
        if ($searchForm->specifics != null && is_array($searchForm->specifics)) {
            foreach ($searchForm->specifics as $key => $specific) {
                if(!in_array($key,EbayItem::getSpecifics())){
                    continue;
                }
                $speQuery = $key . ':';
                if (is_array($specific)) {
                    $tmp = [];
                    foreach ($specific as $value) {
                        $value = $value == '_others' ? '' : $value;
                        $value = (is_numeric($value)) ? $value : '"' . str_replace('"','\"',strval($value)) . '"';
                        $tmp[] = $value;
                    }
                    $speQuery .= '(' . implode(' OR ', $tmp) . ')';
                } else {
                    $speQuery .= is_numeric($specific) ? $specific : '"' . str_replace('"','\"',strval($specific)) . '"';
                }
                $queryFilter[] = $speQuery;
            }
        }

        switch ($searchForm->order) {
            case 1:
                $order = 'sellPrice desc';
                break;
            case 2:
                $order = 'sellPrice asc';
                break;
            case 3:
                $order = 'discount desc';
                break;
            default:
                $order = 'startTime desc';
                break;

        }
        $query = array_merge($query, $queryFilter);
        $query = urlencode(implode(' AND ', $query));
        $facet = 'facet=true&facet.field=facets&facet.mincount=2';
        $base = '?q=' . $query . '&wt=json&facet.mincount=2&sort=' . $order;
        //$facetOnly = '?q=' . $query . '&' . $facet . '&start=0&wt=json&rows=0' . $unHold . '&sort=' . $order;
        return [
            'base' => $base,
//            'facetOnly' => $facetOnly
        ];
    }

    private static function getPagingQuery(SearchForm $searchForm)
    {
        $searchForm->page = ($searchForm->page < 1) ? 1 : $searchForm->page;
        $searchForm->size = ($searchForm->size < 1) ? 1 : $searchForm->size;
        $searchForm->size = ($searchForm->size > 100) ? 100 : $searchForm->size;
        $start = $searchForm->size * $searchForm->page - $searchForm->size;
        return '&start=' . $start . '&rows=' . $searchForm->size;
    }

    public static function search(SearchForm $searchForm)
    {
        $dataPage = new DataPage();
        $url = self::buildSearchUrl($searchForm);
        if ($url != false) {
            $data = self::callSearch($url);
            if ($data->getHttpStatus() == 200) {
                $data = Json::decode($data->getRawResponse(), false);
                foreach ($data->response->docs as $item) {
                    $dataPage->items[] = EbayService::convertItem(static::buildToModelItem($item));
                }
                $dataPage->facets = static::rebuildFacet($data->facet_counts->facet_fields);
                $dataPage->count = ceil($data->response->numFound / $searchForm->size);
                $dataPage->itemCount = $data->response->numFound;
                return $dataPage;
            }
            return $dataPage;
        }
        return $dataPage;
    }

    public static function buildToModelItem($item)
    {
        $modelItem = new EbayItem();
        $modelItem->setAttributes(get_object_vars($item), false);
        if (isset($item->description)) {
            $modelItem->desc = $item->description;
        }
        $modelItem->seller = Json::decode($modelItem->seller, false);
        $modelItem->saleSpecific = Json::decode($modelItem->saleSpecific);
        $modelItem->specifics = Json::decode($modelItem->specifics, false);
        $modelItem->subItems = Json::decode($modelItem->subItems, false);
        return $modelItem;
    }

    private static function rebuildFacet($facetFields)
    {
        $fields = get_object_vars($facetFields);
        foreach ($fields as $key => $field) {
            $value = [];

            $i = 0;
            foreach ($field as $data) {
                if ($i % 2 == 0) {
                    $value[$data] = $field[$i + 1];
                }
                $i++;
            }

            $fields[$key] = $value;
        }
        return $fields;
    }

    private static function defaultFacet()
    {
        return ['sellerId', 'category', 'condition', 'location'];
    }

}