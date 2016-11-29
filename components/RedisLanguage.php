<?php
/**
 * Created by PhpStorm.
 * User: nghipt
 * Date: 10/30/2015
 * Time: 8:56 AM
 */
namespace common\components;

use yii\base\Exception;
use yii\redis\Connection;
use common\models\enu\Language;
use common\models\db\LocaleStringResource;
use common\models\service\LanguageService;
use common\components\CacheClient;

class RedisLanguage
{
    public static $conn;
    public static function getConnection()
    {
        if (self::$conn == null) {
            self::$conn = new Connection();
        }
        return self::$conn;
    }
	public static function checkToDb($key, $languageId){
		$localeStringResource = CacheClient::get('checkToDb-'.$key.'-'.$languageId);
    	if (!$localeStringResource){
    		$localeStringResource = LocaleStringResource::find()->where([
				'ResourceName' => $key,
				'LanguageId' => $languageId
			])->one();
    		CacheClient::set('checkToDb-'.$key.'-'.$languageId,$localeStringResource);
    	}
		
		return $localeStringResource;
	}
	
	public static function insertToDb($key, $value, $languageId, $type = 1){
		$localeStringResource = new LocaleStringResource();
		$localeStringResource->ResourceName = $key;
		$localeStringResource->ResourceValue = $value;
		$localeStringResource->LanguageId = $languageId;
		$localeStringResource->Active = 1;
		$localeStringResource->Type = $type;
		
		$localeStringResource->save();
	}
	
    public static function getLanguageByKey($key, $title='', $languageId = null)
    {
        if($languageId == null){
            $languageId = LanguageService::getCurrentLanguageId();
        }
        $languageId =  !empty($languageId) ? $languageId : 2;

        $redis = self::getConnection();
        $getlangtokey = $redis->executeCommand('HGET', [Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]);
        
        if (empty($getlangtokey)){
        	$languageValue = self::checkToDb($key, $languageId);
        	if (!empty($languageValue)){
                    //self::updateLanguageByKey($key, $languageId, $title);
        	}else{
                    self::insertToDb($key, $title, $languageId);
                    //self::updateLanguageByKey($key, $languageId, $title);
        	}
        	return $title;
        }       

        return $getlangtokey;
    }
	
	public static function getLanguageByKey2($key, $title='', $languageId = null)
    {
        if($languageId == null){
            $languageId = LanguageService::getCurrentLanguage();
        }
        $languageId =  !empty($languageId) ? $languageId : 1;

        $redis = self::getConnection();
        $getlangtokey = $redis->executeCommand('HGET', [Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]);
        
        if (empty($getlangtokey)){
			echo 'redis empty<br>=>'.$title;
        	$languageValue = self::checkToDb($key, $languageId);
        	if (!empty($languageValue)){
        		self::updateLanguageByKey($key, $languageId, $title);
        	}else{
        		self::insertToDb($key, $title, $languageId);
        		self::updateLanguageByKey($key, $languageId, $title);
        	}
        	return $title;
        }       
		echo 'redis not empty<br>=>>' . $getlangtokey;
        return $getlangtokey;
    }

    public static function checkLanguageByKey($key,$languageId = null)
    {
        if($languageId == null)
            $languageId = \Yii::$app->session->get('languageId');
        $languageId =  isset($languageId) && $languageId != null ? $languageId : 2;
        $redis = self::getConnection();
        $getlangtokey = $redis->executeCommand('HGET', [Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]);
        return !empty($getlangtokey) ? true :false;
    }

    public static function updateLanguageByKey($key = null,$languageId = null,$newValue = null)
    {
        if($key == null || $languageId == null || $newValue == null)
            return false;
        $redis = self::getConnection();
        try
        {
            $redis->executeCommand('HDEL',[Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]);
            $redis->executeCommand('HSET',[Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId, $newValue]);
        }catch (Exception $ex)
        {
            throw  $ex;
        }

        return true;
    }

    public static function deleteLanguageByKey($key = null,$languageId = null)
    {
        if($key == null || $languageId == null)
            return false;

        $redis = self::getConnection();
        try{
            if($redis->executeCommand('HEXISTS',[Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]))
                $redis->executeCommand('HDEL',[Language::STACK_LANGUAGE,$key . '_2' . '_' . $languageId]);
        }catch (Exception $ex)
        {
            throw $ex;
        }
        
        return true;
    }
}