<?php
/**
 * Created by PhpStorm.
 * User: ducqu
 * Date: 11/4/2015
 * Time: 8:57 AM
 */

namespace common\models\solr;


use common\components\Solr\ApacheSolrDocument;
use common\models\ebay\SolrEbayKeyword;
use yii\helpers\Json;

class EbayKeywordSolr extends BaseSolr
{
    public static $tableName = '/solr/ebaykeyword';

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

    public static function getOne($keyword, $siteId = null, $storeId = null)
    {
        $url = '?q=keyword:' . $keyword;
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
            foreach ($data->response->docs as $item) {
                return $item;
            }
            return false;
        }
        return false;
    }

    public static function keywordCountUp($keyword, $category = null, $siteId = null, $storeId = null)
    {
        $check = static::getOne($keyword, $siteId, $storeId);
        if ($check != false) {
            $check->count = $check->count + 1;
            if ($category != null) {
                $category = is_array($category) ? $category : [$category];
                if (isset($check->category)) {
                    $check->category = array_unique(array_merge($check->category, $category));
                } else {
                    $check->category = $category;
                }
            }
        } else {
            $check = new SolrEbayKeyword();
            $check->count = 1;
            $check->keyword = $keyword;
            $check->category = $category == null ? [] : $category;
            $check->siteId = $siteId;
            $check->StoreId = $storeId;
        }
        return self::updateOne($check);
    }

    /**
     * @param null $category
     * @param int $limit
     * @param null $siteId
     * @param null $storeId
     * @return array common\models\ebay\SolrEbayKeyword
     */
    public static function getTop($category = null, $limit = 10, $siteId = null, $storeId = null)
    {
        $url = '?q=';
        $qArray = [];
        if ($siteId != null) {
            $qArray [] = 'siteId:' . $siteId;
        }
        if ($storeId != null) {
            $qArray [] = 'StoreId:' . $storeId;
        }
        if ($category != null) {
            $qArray [] = 'category:' . $category;
        }
        $url .= implode(' AND ', $qArray);
        $url .= '&rows=' . $limit . '&wt=json&sort=count desc';
        $data = self::callSearch($url);
        if ($data->getHttpStatus() == 200) {
            $data = Json::decode($data->getRawResponse(), false);
            $items = [];
            foreach ($data->response->docs as $item) {
                $items[] = SolrEbayKeyword::convert($item);
            }
            return $items;
        }
        return [];
    }

}