<?php

namespace common\models\service;

use common\components\CacheClient;
use common\models\db\Site;
use common\models\db\SiteCategory;
use common\models\enu\Boolean;
use common\models\enu\ImageType;
use common\models\enu\StoreConfig;
use common\models\inter\Service;
use common\models\model\form\AdministratorForm;
use common\models\model\form\SiteForm;
use common\models\model\search\AdministratorSearch;
use common\models\model\search\SiteSearch;
use common\models\output\DataPage;
use common\models\output\Response;
use Exception;
use Yii;
use yii\data\Pagination;
use common\models\db\Store;
use yii\helpers\Url;

/**
 * @auth: huylx
 * Administrator Service
 */
class SiteService implements Service {

    private static $storeFixed = false;

    /**
     * Lấy chi tiết thông tin quản trị theo $id
     * @param type $id
     * @return type
     * @throws Exception
     */
    public static function get($id) {
        return Site::findOne($id);
    }

    /**
     * Danh sách quản trị theo danh sách email
     * @param type $condition
     * @return type
     */
    public static function mGet($condition = array(), $thumb = array()) {
        $sites = Site::find()->andWhere(['id' => $condition])->all();
        $images = ImageService::getByTarget($condition, ImageType::SITE_LOGO, true, $thumb);
        foreach ($sites as $site) {
            $site->images = isset($images[$site->id]) ? $images[$site->id] : [];
        }
        return $sites;
    }

    public static function getSiteIdsByStoreId($storeId, $result = []) {
        $siteData = Site::find()->select(['id'])->where(['StoreId' => $storeId, 'IsActive' => 1])->all();
        if ($siteData)
            foreach ($siteData as $site) {
                $result[] = $site->id;
            }
        return $result;
    }

    /**
     * Xoá quản trị
     * @param type $condition
     */
    public static function remove($id) {
        $site = self::get($id);
        if (!empty($site)) {
            ImageService::deleteByTarget($site->id);
            SiteCategory::deleteAll(['siteId' => $id]);
            $site->delete();
            return $site;
        } else {
            throw new Exception("Site này đã bị xóa không thể tiếp tục thao tác");
        }
    }

    /**
     * Thay đổi trạng thái admin theo email
     * @param type $email
     * @return type
     */
    public static function active($id) {
        $site = Site::findOne($id);
        $site->active = $site->active == Boolean::TRUE ? Boolean::FALSE : Boolean::TRUE;
        $site->save(false);
        return $site;
    }

    /**
     * Thay đổi trạng thái admin theo email
     * @param type $email
     * @return type
     */
    public static function home($id) {
        $site = Site::findOne($id);
        $site->home = $site->home == Boolean::TRUE ? Boolean::FALSE : Boolean::TRUE;
        $site->save(false);
        return $site;
    }

    /**
     * Thay đổi trạng thái admin theo email
     * @param type $email
     * @return type
     */
    public static function complete($id) {
        $site = Site::findOne($id);
        $site->complete = $site->complete == Boolean::TRUE ? Boolean::FALSE : Boolean::TRUE;
        $site->save(false);
        return $site;
    }

    /**
     * Thêm tài khoản quản trị
     * @param AdministratorForm $form
     * @return Response
     */
    public static function save(SiteForm $form) {
        if (!$form->validate()) {
            return new Response(false, "Thêm mới không thành công, dữ liệu không chính xác", $form->errors);
        }

        $regex = '/^(\w+)\.(\w{2,10})(\.?(\w{2,10})?)+(\/?(\w+)?)+$/';
        $match = preg_match($regex, $form->domain);

        if (!$match) {
            return new Response(false, "Domain không đúng định dạng , vd : domain.com.vn", $form->errors);
        }

        $site = Site::findOne($form->id);
        if ($site == null) {
            $site = new Site();
            $site->createEmail = Yii::$app->user->getId();
            $site->createTime = time();
        }
        $site->domain = strtolower($form->domain);
        $site->name = $form->name;
        $site->active = $form->active == Boolean::TRUE ? Boolean::TRUE : Boolean::FALSE;
        $site->updateEmail = Yii::$app->user->getId();
        $site->updateTime = time();

        if (!$site->save()) {
            return new Response(false, "Thêm mới không thành công, dữ liệu không chính xác", $site->errors);
        }
        return new Response(true, "Thêm mới site thành công", $site);
    }

    /**
     * Tìm kiếm thông tin admin, có phân trang
     * @param AdministratorSearch $search
     * @return \common\service\DataPage
     */
    public static function filter(SiteSearch $search) {
        $query = self::buildQuery($search);
        $dataPage = new DataPage();
        $dataPage->dataCount = $query->count();
        $dataPage->dataCount = $dataPage->dataCount == null ? 0 : $dataPage->dataCount;
        $dataPage->pageSize = $search->pageSize <= 0 ? 100 : $search->pageSize;
        $dataPage->page = $search->page <= 0 ? 1 : $search->page;
        $paging = new Pagination(['totalCount' => $dataPage->dataCount]);
        $paging->setPageSize($dataPage->pageSize);
        $paging->setPage($dataPage->page - 1);
        $query->limit($paging->getLimit());
        $query->offset($paging->getOffset());
        $dataPage->data = $query->all();
        $dataPage->pageCount = intval($dataPage->dataCount / $dataPage->pageSize);
        if ($dataPage->pageCount % $dataPage->pageSize != 0) {
            $dataPage->pageCount = $dataPage->pageCount + 1;
        }
        $dataPage->pageCount = $dataPage->pageCount <= 0 ? 1 : $dataPage->pageCount;
        $ids = [];
        foreach ($dataPage->data as $site) {
            $ids[] = $site->id;
        }
        $thumb = [];
        if ($search->w_thum > 0 || $search->h_thum > 0) {
            $thumb = [$search->w_thum, $search->h_thum];
        }
        $images = ImageService::getByTarget($ids, ImageType::SITE_LOGO, true, $thumb);
        foreach ($dataPage->data as $site) {
            $site->images = isset($images[$site->id]) ? $images[$site->id] : "";
        }
        return $dataPage;
    }

    /**
     * build query by entity search
     * @param AdministratorSearch $search
     * @return type
     */
    private static function buildQuery(SiteSearch $search) {
        $query = Site::find();
        if ($search->domain != null && $search->domain != '') {
            $query->andWhere(['LIKE', 'domain', strtolower($search->domain)]);
        }
        if ($search->active > 0) {
            $query->andWhere(['=', 'active', $search->active == 1 ? 1 : 0]);
        }

        if ($search->complete > 0) {
            $query->andWhere(['=', 'complete', $search->complete == 1 ? 1 : 0]);
        }

        if ($search->home > 0) {
            $query->andWhere(['=', 'home', $search->home == 1 ? 1 : 0]);
        }

        if ($search->createTimeFrom > 0 && $search->createTimeTo > 0) {
            $query->andWhere(['between', 'createTime', $search->createTimeFrom / 1000, $search->createTimeTo / 1000]);
        } else if ($search->createTimeFrom > 0) {
            $query->andWhere('createTime >= :time', [':time' => $search->createTimeFrom / 1000]);
        } else if ($search->createTimeTo > 0) {
            $query->andWhere('createTime <= :time', [':time' => $search->createTimeTo / 1000]);
        }

        switch ($search->sort) {
            case 'createTime_asc':
                $query->orderBy("createTime ASC");
                break;
            case 'createTime_desc':
                $query->orderBy("createTime DESC");
                break;
            case 'updateTime_asc':
                $query->orderBy("updateTime ASC");
                break;
            case 'updateTime_desc':
                $query->orderBy("updateTime DESC");
                break;
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            case 'name_asc':
                $query->orderBy("name ASC");
                break;
            default :
                $query->orderBy("createTime DESC");
        }
        return $query;
    }

    /**
     * get site by domain
     * @param type $domain
     * @return type
     */
    public static function getByDomain($domain) {
        $site = Site::find()->andWhere(["domain" => $domain])->one();
        if ($site == null) {
            throw new Exception("Không tìm thấy site yêu cầu trên hệ thống");
        }
        return $site;
    }

    /**
     * Get site condition storeId
     * @param unknown $storeId
     */
    public static function getByStoreId($storeId) {
        $siteData = CacheClient::get('site-data-storeid' . $storeId);
        if (empty($siteData)) {
            $siteData = Site::find()->andWhere(["StoreId" => $storeId, 'IsActive' => 1])->all();
            CacheClient::set('site-data-storeid' . $storeId, $siteData);
        }
        return $siteData;
    }

    public static function getAllBrandBySite($siteId) {
        return BrandService::getBySite($siteId);
    }

    static $currentStore = null;

    /**
     * Get Store by domain
     * @return \yii\db\ActiveRecord|NULL|NULL
     */
    public static function getStore($check = true) {
        if (static::$currentStore == null) {
            if ($check) {
                $currentDomain = Url::base(true);
                if ($currentDomain == Yii::$app->params['stotes']['weshopvnuser']) {
                    $currentDomain = Yii::$app->params['stotes']['weshopvn'];
                }
                if ($currentDomain) {
                    $storeData = Yii::$app->cache->get('store_domain' . $currentDomain);
                    if (empty($storeData)) {
                        $storeData = Store::find()->andWhere(["Hosts" => $currentDomain])->one();
                        Yii::$app->cache->set('store_domain' . $currentDomain, $storeData);
//                    CacheClient::set('store-data-domain' . $currentDomain, $storeData);
                    }

                    if (!empty($storeData)) {
                        return $storeData;
                    } elseif (isset(\Yii::$app->params['storeId'])) {
                        $storeData = CacheClient::get('store-data-id' . \Yii::$app->params['storeId']);
                        if (empty($storeData)) {
                            $storeData = Store::findOne(['id' => \Yii::$app->params['storeId']]);
                            CacheClient::set('store-data-id' . \Yii::$app->params['storeId'], $storeData);
                        }

                        if (!empty($storeData)) {
                            static::$currentStore = $storeData;
                            return $storeData;
                        }
                    }
                }
            } else {
                return self::getStoreById(StoreConfig::WESHOP_GLOBAL);
            }
        } else {
            return static::$currentStore;
        }
        return null;
    }

    /**
     * Get Site by path
     * @return \yii\db\ActiveRecord[]|NULL
     */
    public static function getSite() {
        $url = Url::current([], true);
        $storeData = self::getStore();

        $currSiteData = [];
        if (!empty($storeData)) {
            $siteData = self::getByStoreId($storeData->id);

            if (!empty($siteData))
                foreach ($siteData as $site) {
                    $domain = str_replace(".html", "", $site->domain);
                    $pos = strpos($url, $domain);
                    if ($pos !== false) {
                        $exits = strpos($site->domain, '.html');
                        if ($exits !== false) {
                            return $site;
                        } else {
                            $currSiteData = $site;
                        }
                    }
                }
            return $currSiteData;
        }
    }

    /**
     * Get Store by id
     */
    public static function getStoreById($id) {
        $storeData = CacheClient::get('store-data-id' . $id);
        if (empty($storeData)) {
            $storeData = Store::find()->andWhere(['id' => $id])->one();
            CacheClient::set('store-data-id' . $id, $storeData);
        }
        return $storeData;
    }

    public static function getStoreBySiteId($siteId) {
        $siteData = CacheClient::get('site-data-id' . $siteId);
        if (empty($siteData)) {
            $siteData = Site::findOne(['id' => $siteId]);
            CacheClient::set('site-data-id' . $siteId, $siteData);
        }
        if (isset($siteData->StoreId)) {
            return $siteData->StoreId;
        }
        return 0;
    }

    public static function getStoreByCountry($countryId) {
        $storeData = CacheClient::get('store-data-countryId' . $countryId);
        if (empty($storeData)) {
            $storeData = Store::find()->where(["SystemCountryId" => $countryId])->one();
            CacheClient::set('store-data-countryId' . $countryId, $storeData);
        }
        return $storeData;
    }

}
