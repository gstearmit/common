<?php

/**
 * Created by PhpStorm.
 * User: huylx
 * Date: 11/11/2015
 * Time: 9:45 AM
 */

namespace common\models\service;

use common\components\RedisLanguage;
use common\models\db\Language;
use common\models\db\LocaleStringResource;
use common\models\enu\LocalStringResourceType;
use common\components\CacheClient;
use Yii;

class LanguageService {

    public static function getList() {
        return Language::find()->all();
    }

    /**
     * Get by id
     */
    public static function getOnce($id) {
        $languageData = CacheClient::get('LanguageService-getOnce-' . $id);
        if (empty($languageData)) {
            $languageData = Language::findOne($id);
            CacheClient::set('LanguageService-getOnce-' . $id, $languageData);
        }
        return $languageData;
    }

    /**
     * Get by condition
     */
    public static function getByCondition() {
        $languageData = CacheClient::get('LanguageService-getByCondition');
        if (!$languageData) {
            $find = Language::find()->where(['Published' => 1]);
            $find->limit('LimitedToStores');
            $find->orderBy('DisplayOrder');

            $languageData = $find->all();
            CacheClient::set('LanguageService-getByCondition', $languageData);
        }

        return $languageData;
    }

    /**
     * Get once current language use
     * @return \yii\db\ActiveRecord|NULL
     */
    public static function getDefault() {
        $checkStore = \Yii::$app->params['checkStore'];
        $storeData = SiteService::getStore($checkStore);
        if (!empty($storeData) && !empty($storeData->LanguageId)) {
            return self::getOnce($storeData->LanguageId);
        } else {
            $find = Language::find()->where(['Published' => 1]);
            $find->andWhere(['LanguageCulture' => 'vn-VN']);
            return $find->one();
        }
    }

    /**
     * Get list current language use
     */
    public static function getCurrentLanguage() {
        $languageData = self::getDefault();
        if (isset($languageData)) {
            self::setCurrentLanguage($languageData->id);
            return $languageData->id;
        } else {
            return false;
        }
    }
    
    /**
     * Get list current language use
     */
    public static function getCurrentLanguageId() {
        $checkStore = \Yii::$app->params['checkStore'];
        $storeData = SiteService::getStore($checkStore);
        if (!empty($storeData) && !empty($storeData->LanguageId)) {
            return $storeData->LanguageId;
        } else {
            return 2;
        }
    }

    /**
     * Set language use
     * @param number $languageId
     * @param string $remove
     */
    public static function setCurrentLanguage($languageId = 1, $remove = false) {
        try {
            if ($languageId) {
                Yii::$app->getSession()->set("languageId", $languageId);
            }
            if ($remove) {
                Yii::$app->getSession()->set("languageId", null);
            }

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    /**
     * Get list ngon ngu
     * @param unknown $languageId
     */
    public static function getLocalLanguage($languageId, $type = LocalStringResourceType::WEB_TYPE) {
        $key = 'language-id-' . $languageId . '-type-' . $type;
        
        $result = CacheClient::get($key);

        if (empty($result)) {
            $result = LocaleStringResource::find()->andWhere(['LanguageId' => $languageId, 'Active' => 1, 'Type' => $type])->all();
            CacheClient::set($key, $result);
        }
        return $result;
    }

    public static function getLanguageOrInsertNew($name, $prefix = null, $languageId = null, $key = null) {
        if ($languageId == null)
            $languageId = \Yii::$app->session->get('languageId');
        if (empty($prefix)) {
            $prefix = 'detail_attribute_';
        }
        if (empty($key) || $key == null) {
            $key = $prefix . self::urlNormalization($name);
        }
        if (RedisLanguage::checkLanguageByKey($key, $languageId)) {
            return RedisLanguage::getLanguageByKey($key, $name);
        } else {
            $localeStringResourceExits = LocaleStringResource::find()->andWhere(['ResourceName' => $key, 'LanguageId' => $languageId])->one();
            if (!empty($localeStringResourceExits)) {
                return RedisLanguage::getLanguageByKey($key, $name);
            } else {
                $locale = new LocaleStringResource();
                $locale->LanguageId = $languageId;
                $locale->ResourceName = $key;
                $locale->ResourceValue = $name;
                $locale->Active = 1;
                $locale->Type = 1;
                $locale->save();
                return $name;
            }
        }
    }

    private static function unicode_str_filter($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    private static function urlNormalization($str) {
        $string = self::unicode_str_filter($str);
        $re = "/\W+/";
        $re2 = "/^\W+|\W+$/";
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $string)); // Replaces all spaces with hyphens.
        $newString = preg_replace($re, "_", $string);
        $done = preg_replace($re2, "", $newString);
        return strtolower($done);
    }

}
