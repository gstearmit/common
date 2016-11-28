<?php
/**
 * Created by PhpStorm.
 * User: ducquan
 * Date: 20/10/2015
 * Time: 10:32 AM
 */

namespace common\models\solr;


use common\components\CacheClient;
use common\components\Solr\ApacheSolrService;

class BaseSolr
{
    public static $solrService = [];
    public static $tableName;

    /**
     * @return ApacheSolrService
     */
    public static function getSolrService()
    {
        if (!isset(self::$solrService[md5(static::$tableName)])) {
            self::$solrService[md5(static::$tableName)] = new ApacheSolrService(\Yii::$app->params['solr']['host'], \Yii::$app->params['solr']['port'], static::$tableName);
        }
        return self::$solrService[md5(static::$tableName)];
    }

    /**
     * @param $query
     * @param array $data
     * @param string $method
     * @return bool|\common\components\Solr\ApacheSolrResponse
     */
    public static function callSearch($query, $data = [], $method = 'GET')
    {
        if ($method != 'POST') {
            return static::getSolrService()->_sendRawGet(str_replace(' ', '%20', static::getSolrService()->_searchUrl . $query));
        } else {
            $cacheKey = 'solr_get' . CacheClient::identity(static::getSolrService()->_searchUrl);
            $cache = CacheClient::get($cacheKey,false);
            if($cache != false){
                return $cache;
            }
            $data =  static::getSolrService()->_sendRawPost(static::getSolrService()->_searchUrl, $data, false, 'application/x-www-form-urlencoded; charset=UTF-8');
            CacheClient::set($cacheKey, $data);
            return $data;
        }
//        echo '<pre>';
//        var_dump(str_replace(' ', '%20', self::getSolrService()->_searchUrl . $query));
//        echo '</pre>';
//        if (static::getSolrService()->ping() != false) {
//            if ($method != 'POST') {
//                return static::getSolrService()->_sendRawGet(str_replace(' ', '%20', static::getSolrService()->_searchUrl . $query));
//            } else {
//                return static::getSolrService()->_sendRawPost(static::getSolrService()->_searchUrl, $data, false, 'application/x-www-form-urlencoded; charset=UTF-8');
//            }
//        }
//        return false;
    }


}