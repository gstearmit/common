<?php
/**
 * Created by PhpStorm.
 * User: tuanduong
 * Date: 1/7/2015
 * Time: 11:48 AM
 */

namespace common\models\solr;


use common\components\Solr\ApacheSolrDocument;
use common\models\ebay\SolrEbayKeyword;
use common\models\ebay\SearchForm;
use common\models\ebay\DataPage;
use yii\helpers\Json;

class SearchInfoKeywordSolr extends BaseSolr
{
    public static $tableName = '/solr/search_info';

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
            // get obj solr
            $solrSV = self::getSolrService();
                $addDoc = $solrSV->addDocument($doc);
                if ($addDoc->getHttpStatus() == 200) {
                    // update to solr
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

    
    
     public static function getOneSearch($param, $siteId = null, $storeId = null)
    {
        $url ='';
        if(!empty($param)){
            foreach($param as $key=>$item){
                $url .= '?q='.$key.':' . $item;
            }
        }
        if ($siteId != null) {
            $url .= ' AND siteId:' . $siteId;
        }
        if ($storeId != null) {
            $url .= ' AND storeId:' . $storeId;
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
            $check->count    = 1;
            $check->keyword  = $keyword;
            $check->category = $category == null ? [] : $category;
            $check->siteId   = $siteId;
            $check->StoreId  = $storeId;
        }
        return self::updateOne($check);
    }
    
     public static function keywordCountUpSearch($keyword, $category = null, $siteId = null, $storeId = null)
    {
        $check = static::getOneSearch($keyword, $siteId, $storeId);
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
                    $dataPage->items[] = static::buildToModelItem($item);
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

    private static function buildSearchUrl(SearchForm $searchForm)
    {
        if (!$searchForm->valid()) {
            return false;
        }
        $urls = self::getStaticQuery($searchForm);
        $base = $urls['base'] . '&facet=true' . static::getPagingQuery($searchForm);
        $facets = array_merge(EbayItem::getSpecifics(),['condition','location','sellerId']);
        foreach ($facets as $fc) {
            $base .= '&facet.field=' . $fc;
        }
        return $base;
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
            $from = ($searchForm->minPrice != null && is_numeric($searchForm->minPrice)) ? $searchForm->minPrice : '*';
            $to = ($searchForm->maxPrice != null && is_numeric($searchForm->maxPrice)) ? $searchForm->maxPrice : '*';
            $query[] = 'sellPrice:[' . $from . ' TO ' . $to . ']';
        }
        $queryFilter = [];
        if ($searchForm->specifics != null && is_array($searchForm->specifics)) {
            foreach ($searchForm->specifics as $key => $specific) {
                $speQuery = $key . ':';
                if (is_array($specific)) {
                    $tmp = [];
                    foreach ($specific as $value) {
                        $value = $value == '_others' ? '' : $value;
                        $value = (is_numeric($value)) ? $value : '"' . strval($value) . '"';
                        $tmp[] = $value;
                    }
                    $speQuery .= '(' . implode(' OR ', $tmp) . ')';
                } else {
                    $speQuery .= is_numeric($specific) ? $specific : '"' . strval($specific) . '"';
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
        $facetOnly = '?q=' . $query . '&' . $facet . '&start=0&wt=json&rows=0' . $unHold . '&sort=' . $order;
        return [
            'base' => $base,
        ];
    }
    

}