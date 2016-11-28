<?php
/**
 * Created by PhpStorm.
 * User: ducqu
 * Date: 11/3/2015
 * Time: 2:54 PM
 */

namespace common\models\solr;

use common\components\Solr\ApacheSolrDocument;
use common\models\db\Category;
use yii\base\Exception;
use yii\helpers\Json;

class EbayCategorySolr extends BaseSolr
{
    public static $tableName = '/solr/ebaycategory';

    public static function updateOne($category)
    {
        $doc = new ApacheSolrDocument();
        foreach ($category as $key => $data) {
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

    public static function update($categorys)
    {
        $solrSv = self::getSolrService();
        $documents = [];
        foreach ($categorys as $category) {
            $doc = new ApacheSolrDocument();
            foreach ($category as $key => $data) {
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
            $check = $solrSv->addDocuments($documents);
            if ($check != true) {
                die(var_dump($check));
            }
            $solrSv->commit();
            $solrSv->optimize();
            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function getOneByAlias($categoryId, $siteId = null, $storeId = null)
    {
        if(is_array($categoryId)){
            $categoryId = end($categoryId);
        }
        $url = '?q=alias:' . $categoryId;
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND StoreId:' . $storeId;
        }
        $url .= '&rows=1&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            foreach ($data->response->docs as $category) {
                return static::buildToModelItem($category);
            }
            return false;
        }
        return false;
    }

    public static function getByAliasIds($alias = [], $siteId = null, $storeId = null)
    {
        if (empty($alias) || $siteId == null || $storeId == null) {
            return [];
        }
        $url = '?q=';
        $tmpA = [];
        $alias = is_array($alias) ? $alias : [$alias];
        foreach ($alias as $id) {
            $tmpA[] = 'alias:' . $id;
        }
        $url .= '(' . implode(' OR ', $tmpA) . ')';
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND StoreId:' . $storeId;
        }
        $url .= '&rows=999999999&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $rs = [];
            foreach ($data->response->docs as $category) {
                $rs[$category->alias] = static::buildToModelItem($category);
            }
            return $rs;
        }
        return [];
    }

    public static function getOneById($categoryId)
    {
        $url = '?q=id:' . $categoryId;
        $url .= '&rows=1&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            foreach ($data->response->docs as $category) {
                return static::buildToModelItem($category);
            }
            return false;
        }
        return false;
    }

    public static function getByParent($parent, $siteId = null, $storeId = null, $limit = 5)
    {
        $url = '?q=parentId:' . $parent;
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND StoreId:' . $storeId;
        }
        $url .= '&rows=' . $limit . '&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $rs = [];
            foreach ($data->response->docs as $category) {
                $rs[] = static::buildToModelItem($category);
            }
            return $rs;
        }
        return [];
    }

    public static function getByLevel($level, $siteId = null, $storeId = null)
    {
        if (!is_array($level)) {
            $url = '?q=level:' . $level;
        } else {
            $url = '?q=';
            $ids = [];
            foreach ($level as $id) {
                $ids[] = 'level:' . $id;
            }
            $url .= implode(' OR ',$ids);
        }
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND StoreId:' . $storeId;
        }
        $url .= '&rows=999999999&wt=json';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $rs = [];
            foreach ($data->response->docs as $category) {
                $rs[] = static::buildToModelItem($category);
            }
            return $rs;
        }
        return [];
    }

    public static function buildToModelItem($category)
    {
        $modelItem = new Category();
        $modelItem->setAttributes(get_object_vars($category), false);
        return $modelItem;
    }
}