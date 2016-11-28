<?php

namespace common\models\service;

use common\models\db\SystemCurrency;
use common\models\db\SystemCurrencyRate;
use common\models\db\Store;
use common\components\CacheClient;

/**
 * @auth: huylx
 * Administrator Service
 */
class RateService
{

    static $rates = [];

    /**
     * Lấy chi tiết thông tin quản trị theo $id
     * @param type $id
     * @return type
     * @throws Exception
     */
    public static function get($id)
    {
        $site = Site::findOne($id);
        return $site;
    }

    static $rate = [];

    public static function getSystemCurrencyById($id)
    {
        $systemCurrency = CacheClient::get('getSystemCurrencyById-' . $id);
        if (!$systemCurrency) {
            $systemCurrency = SystemCurrency::findOne($id);
            CacheClient::set('getSystemCurrencyById-' . $id, $systemCurrency);
        }
        return $systemCurrency;
    }

    public static function getArrById($id)
    {
        return SystemCurrency::find()->where(['id' => $id])->asArray()->one();
    }

    public static function getSystemCurrencyByCode($currencyCode = 'usd')
    {
        $systemCurrency = SystemCurrency::findOne(['CurrencyCode' => $currencyCode]);
        return $systemCurrency;
    }

    public static function getSystemCurrencyByIdinArray($data, $values)
    {
        foreach ($data as $currency) {
            if ($currency->id == $values) {
                return isset($currency->Symbol) ? $currency->Symbol : $currency->Name;
            }
        }
    }

    static $rateFromTo = [];

    public static function getRate($currencyFromId = 0, $currencyToId = 0, $currencyFromCode = "usd", $currencyTo = "vnđ")
    {
        $cacheKey = 'c-rate-' . $currencyFromId . '-' . $currencyToId;

        if ($currencyFromId == $currencyToId) {
            return 1;
        }
        if ($currencyFromId && $currencyToId) {
            if (isset(static::$rateFromTo[$currencyFromId . '-' . $currencyToId])) {
                return static::$rateFromTo[$currencyFromId . '-' . $currencyToId];
            }

            $cacheKey = 'c-rate-' . $currencyFromId . '-' . $currencyToId;

            $rate = \Yii::$app->cache->get($cacheKey);
            if (empty($rate)) {
                $rate = SystemCurrencyRate::find()
                    ->andWhere(["CurrencyFromId" => $currencyFromId])
                    ->andWhere(["CurrencyToId" => $currencyToId])
                    ->orderBy('id desc')
                    ->one();
                $rate = isset($rate->Rate) ? $rate->Rate : 21500.0000;
                \Yii::$app->cache->set($cacheKey, $rate, 10800);
            }
            static::$rateFromTo[$currencyFromId . '-' . $currencyToId] = $rate;
            return $rate;
        } else {
            if (isset(static::$rates[strval($currencyFromCode) . '-' . strval($currencyFromCode)])) {
                return static::$rates[strval($currencyFromCode) . '-' . strval($currencyFromCode)];
            }
            $currencyDataFrom = CacheClient::get('getRate-' . $currencyFromCode);
            if (!$currencyDataFrom) {
                $currencyDataFrom = SystemCurrency::find()
                    ->andWhere(["CurrencyCode" => $currencyFromCode])
                    ->one();
                CacheClient::set('getRate-' . $currencyFromCode, $currencyDataFrom);
            }

            $currencyDataTo = CacheClient::get('getRate-' . $currencyTo);
            if (!$currencyDataTo) {
                $currencyDataTo = SystemCurrency::find()
                    ->andWhere(["CurrencyCode" => $currencyTo])
                    ->one();
                CacheClient::set('getRate-' . $currencyTo, $currencyDataTo);
            }

            if (isset($currencyDataFrom->id) && isset($currencyDataTo->id)) {

                $rate = \Yii::$app->cache->get($cacheKey);
                if(empty($rate)){
                    $rate = SystemCurrencyRate::find()
                        ->andWhere(["CurrencyFromId" => $currencyDataFrom->id])
                        ->andWhere(["CurrencyToId" => $currencyDataTo->id])
                        ->orderBy('id desc')
                        ->one();
                    $rate = isset($rate->Rate) ? $rate->Rate : 21500.0000;
                    \Yii::$app->cache->set($cacheKey, $rate, 10800);
                }
                static::$rates[strval($currencyFromCode) . '-' . strval($currencyFromCode)] = $rate;
                return $rate;
            }

            return 21500.0000;
        }
    }

    public static function getRateByCountry($countryFromId, $countryToId)
    {
        $storeFromData = SiteService::getStoreByCountry($countryFromId);
        if (empty($storeFromData)) {
            return 23000;
        }
        $storeToData = SiteService::getStoreByCountry($countryToId);
        if (empty($storeToData)) {
            return 23000;
        }
        return self::getRate($storeFromData->CurrencyId, $storeToData->CurrencyId);
    }

    public static function getByCurrency($currencyCode = "vnđ")
    {
        $currencyFrom = SystemCurrency::find()
            ->andWhere(["CurrencyCode" => $currencyCode])
            ->one();
        if (isset($currencyFrom->id))
            return $currencyFrom->id;

        return 0;
    }

    public static function getByCurreny($currencyTo, $resultData = [])
    {
        $find = SystemCurrency::find();
        $find->andWhere(["Published" => 1]);
        $find->andWhere(["DisplayOrder" => 1]);
        $find->orderBy('DisplayOrder asc');
        $currencyDatas = $find->all();

        $currentData = SystemCurrency::findOne($currencyTo);
        if ($currencyDatas)
            foreach ($currencyDatas as $key => $currencyData) {
                $resultData[$key] = new \stdClass();
                $resultData[$key]->id = $currencyData->id;
                $resultData[$key]->Name = $currencyData->Name;
                $resultData[$key]->CurrencyCode = $currencyData->CurrencyCode;
                $resultData[$key]->CustomFormatting = $currencyData->CustomFormatting;
                $resultData[$key]->Symbol = $currencyData->Symbol;
                if ($currencyData->id == $currentData->id) {
                    $resultData[$key]->current = 1;
                } else {
                    $resultData[$key]->current = 0;
                }
                $resultData[$key]->rate = self::getRate($currencyData->id, $currentData->id);
                $resultData[$key]->CurrencyToName = $currentData->Name;
            }
        return $resultData;
    }

    public static function getRatePhpToSgd($currencyFromCode = "php", $currencyTo = "sgd")
    {
        $currencyFrom = SystemCurrency::find()->andWhere(["CurrencyCode" => $currencyFromCode])->one();
        $currencyTo = SystemCurrency::find()->andWhere(["CurrencyCode" => $currencyTo])->one();
        if (isset($currencyFrom) && isset($currencyTo->id)) {
            $rate = SystemCurrencyRate::find()
                ->andWhere(["CurrencyFromId" => $currencyFrom->id])
                ->andWhere(["CurrencyToId" => $currencyTo->id])
                ->orderBy('id desc')
                ->one();
            $rate = isset($rate->Rate) ? $rate->Rate : 21500.0000;
            static::$rates[strval($currencyFromCode) . '-' . strval($currencyFromCode)] = $rate;
            return $rate;
        }

        return 21500.0000;
    }

    public static function getCurrencyRateByStore($storeId)
    {
        $storeData = Store::findOne(['id' => $storeId]);
        if (!empty($storeData)) {
            return self::getSystemCurrencyById($storeData->CurrencyId);
        }
        return [];
    }

}
