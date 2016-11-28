<?php

/**
 * Created by PhpStorm.
 * User: nghipt
 * Date: 11/3/2015
 * Time: 6:12 PM
 */

namespace common\components;

use common\models\db\TaxFeeSellers;
use common\models\ebay\EbayPrice;
use common\models\service\RateService;
use common\models\service\SiteService;

class CaculatePrice {
    /* Hàm tính giá sản phẩm
     * @obj item
     * @int priceMultiple
     */

    public static function getItemPrice($new = false, $sellPrice = 0, $usTax = 0, $usShipping = 0, $priceMultiple = 0, $priceMultipleOld = 0, $priceAddition = 0, $priceAdditionOld = 0, $quantity = 1, $sellerId = '') {
        $exchangeRate = RateService::getRate();
        if (!$usTax && $sellerId) {
            //Lấy thuế bang
//            $seller = TaxFeeSeller::model()->getBySellerId($sellerId);
//            if($seller)
//                $usTax = $seller->usTax;
        }
        $itemUSPrice = $sellPrice + ($sellPrice + $usShipping) * $usTax / 100 + $usShipping;
        if ($new === false)
            $itemVNPrice = round($itemUSPrice * $priceMultipleOld + $priceAdditionOld, 2);
        else
            $itemVNPrice = round($itemUSPrice * $priceMultiple + $priceAddition, 2);
        $itemPrice = round($itemVNPrice * $exchangeRate, 0);
        $totalPrice = $itemPrice * $quantity;

        return array(
            'itemUSPrice' => $itemUSPrice,
            'itemVNPrice' => $itemVNPrice,
            'itemPrice' => $itemPrice,
            'totalPrice' => $totalPrice,
        );
    }

    /* Hàm tính giá sản phẩm
     * @obj item
     * @int priceMultiple
     */

    static $sellerTaxs = [];

    public static function getPriceLocal($sellPrice = 0, $usTax = 0, $usShipping = 0, $priceMultiple = 0, $priceAddition = 0, $quantity = 1, $sellerId = '', $exchangeRate = 21500) {
        if (!$usTax && $sellerId) {
            //Lấy thuế bang
            if (isset(static::$sellerTaxs[$sellerId])) {
                $seller = static::$sellerTaxs[$sellerId];
            } else {

                $sellerCache = CacheClient::get('t_' . $sellerId, false);
                if ($sellerCache === false) {
                    $seller = TaxFeeSellers::find()->where(['sellerId' => $sellerId])->one();
                    static::$sellerTaxs[$sellerId] = $seller;
                    CacheClient::set('t_' . $sellerId, $seller);
                } else {
                    $seller = $sellerCache;
                }
            }

            if (isset($seller->usTax) && $seller->usTax > 0) {
                $usTax = $seller->usTax;
            }
        }

        $itemUSPrice = $sellPrice + ($sellPrice + $usShipping) * $usTax / 100 + $usShipping;
        $itemVNPrice = ($itemUSPrice * $priceMultiple ) + $priceAddition;
        $itemPrice = round($itemVNPrice * $exchangeRate, 2);
        $totalPrice = $itemPrice * $quantity;
        $checkStore = \Yii::$app->params['checkStore'];
        $storeData = SiteService::getStore($checkStore);
        if (isset($storeData->Hosts) && $storeData->Hosts == \Yii::$app->params['stotes']['weshopmy']) {
            $totalPrice = $totalPrice * 1.1 * 0.06;
        }
        
        return array(
            'itemUSPrice' => $itemUSPrice,
            'itemVNPrice' => $itemVNPrice,
            'itemPrice' => $itemPrice,
            'totalPrice' => $totalPrice,
        );
    }

    public static function getItemPriceByObj(EbayPrice $obj) {
        if (!$obj->usTax && $obj->sellerId) {
            //Lấy thuế bang
//            $seller = TaxFeeSeller::model()->getBySellerId($sellerId);
//            if($seller)
//                $usTax = $seller->usTax;
        }
        $itemUSPrice = $obj->sellPrice + ($obj->sellPrice + $obj->usShipping) * $obj->usTax / 100 + $obj->usShipping;
        if ($obj->condition === false)
            $itemVNPrice = round($itemUSPrice * $obj->priceMultipleOld + $obj->priceAdditionOld, 2);
        else
            $itemVNPrice = round($itemUSPrice * $obj->priceMultiple + $obj->priceAddition, 2);
        $itemPrice = round($itemVNPrice * $obj->exchangeRate, 0);
        $totalPrice = $itemPrice * $obj->quantity;

        return array(
            'itemUSPrice' => $itemUSPrice,
            'itemVNPrice' => $itemVNPrice,
            'itemPrice' => $itemPrice,
            'totalPrice' => $totalPrice,
        );
    }

    public static function buildPriceAmazon($price, $exRate) {
        if ($price > 0) {
            //$feeShip = $usTax = $feeMore = $coefficient = 0;
            $coefficientUs = 1.0875; // Phần thuế Mỹ.

            $price = $price * $coefficientUs;

            //$price += $feeMore + $feeShip + ($price * $usTax / 100);
            $price *= $exRate;

            //$price = $price / 1000;
            $price = round($price);
            //$price = $price * 1000;
        }
        return $price;
    }

}
