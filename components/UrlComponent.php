<?php

namespace common\components;

use common\models\db\CustomerFollowed;
use common\models\db\Store;
use common\models\enu\ObjectType;
use common\models\enu\SiteConfig;
use common\models\enu\StoreConfig;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use Yii;

class UrlComponent
{
    public static function walletTopupSuccess($id){
    	return Url::base(true) . '/wallet/paymenttopup.html?id='.$id;
    }
    
    static function objectUrl($objectType, $objectName, $objectId = null)
    {
        switch ($objectType) {
            case ObjectType::ebay_item:
                return static::item($objectName, $objectId);                
            case ObjectType::ebay_seller:
                return static::seller($objectName);                
            case ObjectType::order:
                return static::order_info($objectId);                
            default:
                return '';                
        }
    }
    public static function allCategory()
    {
    	return Url::base() . '/categoryall.html';
    }
    public static function allEbayCategory()
    {
        return Url::base() . '/ebay-all-categories.html';
    }
    public static function allAmazonCategory()
    {
        return Url::base() . '/amazon-all-categories.html';
    }
    public static function landingAddressUs()
    {
    	return Url::base() . '/address-us.html';
    }
    public static function notfound()
    {
        return Url::base() . '/404.html';
    }

    public static function info($id)
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        return $domain . '/order-' . $id . '/bill.html';
    }

    /**
     *
     * @return string
     */
    public static function logout()
    {
        return "auth/logout.html";
    }

    public static function walletUrl($extend)
    {
        return Url::base() . '/wallet/topup.html';
    }

    public static function userUrl($extend)
    {
        return Url::base() . '/user/' . $extend;
    }

    public static function login()
    {
        return Url::base() . '/login.html';
    }

    public static function payment($id)
    {
        return Url::base() . '/order-' . $id . '/payment.html';
    }

    public static function payment_mail($id)
    {
        return 'order-' . $id . '/payment.html';
    }

    public static function bill($id)
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        return $domain . '/order-' . $id . '/bill.html';
    }

    public static function bill_mail($id)
    {
        return 'order-' . $id . '/bill.html';
    }
    public static function bill_topup($token)
    {
        return 'account/detailtopup.html?token='.$token;
    }
    public static function addfee_mail($id)
    {
    	return 'addfee-' . $id . '/bill.html';
    }

    public static function register()
    {
        return Url::base() . '/register.html';
    }

    public static function auth($authClient = 'facebook')
    {
        return Url::base() . '/weshop/login/auth?authclient=' . $authClient;
    }

    public static function step3_bill($id)
    {
        return '/order-' . $id . '/bill.html';
    }
	
    public static function step3_addfee($id)
    {
    	return '/addfee-' . $id . '/bill.html';
    }
    
    public static function step_pending($id)
    {
        return '/order-' . $id . '/pending.html';
    }

    public static function tracking_order($id)
    {
        return '/order-' . $id . '/tracking.html';
    }

    public static function auctionsuccess()
    {
        return Url::base(true) . '/ebay/item/auctionsuccess';
    }

    public static function tracking_orderitem($id)
    {
        return '/order-' . $id . '/trakingitem.html';
    }

    /**
     * Trang báo giá
     * @param type $link
     * @return type
     */
    public static function quotes($link = null)
    {
        return Url::base() . "/request.html";
    }

    /**
     * Trang thông tin báo giá đã đặt hàng
     * @param type $id
     * @return type
     */
    public static function quotes_detail()
    {
        return Url::base() . "/resquest/quotes.html";
    }

    /**
     * Dùng để chuyển hướng link sản phẩm
     * @param type $link
     * @return type
     */
    public static function detail($link)
    {
        $link = base64_encode($link);
        return "redirect/item.html?link=" . $link;
    }

    /**
     * detail global khi các site chưa có port riêng
     * @param type $id
     * @param type $name
     * @param type $query
     * @return type
     */
    public static function item_detail_global($id, $name, $query = null)
    {
        return "item/" . TextUtility::removeMarks($name) . "-" . $id . '.html' . (empty($query) ? '' : $query);
    }

    public static function seller($name, $siteId = SiteConfig::EBAY_VN)
    {
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base() . '/ebay/seller/' . $name . '.html';
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base() . '/amazon/seller/' . $name . '.html';
                break;
            default:
                $url = Url::base() . '/nguoi-ban/' . $name . '.html';
                break;
        }
        return $url;
    }

    public static function item($name, $id, $siteId = SiteConfig::WESHOP_EBAY, $storeId = StoreConfig::WESHOP_GLOBAL)
    {
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base(true) . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base(true) . '/amazon/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
            default:
                $url = Url::base(true) . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
        }
        return $url;
    }

    public static function item_mail($name, $id)
    {
        return 'san-pham/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    public static function listOrderWallet()
    {
        return 'wallet/listwallet';
    }

    public static function search($keyword, $catIds = null, $siteId = SiteConfig::EBAY_VN)
    {
        $catParams = !empty($catIds) ? '?categoryIds[]=' . strval($catIds) : '';
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base() . '/search/' . urlencode($keyword) . '.html' . $catParams;
                break;
            default:
                $url = Url::base() . '/tim-kiem/' . urlencode($keyword) . '.html' . $catParams;
                break;
        }
        return $url;
    }

    public static function category($name, $id)
    {
        return Url::base() . '/danh-muc/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    public static function auction($name, $id)
    {
        return static::item($name, $id);
        return Url::base() . '/auction/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    /**
     * item detail
     * @param type $id
     * @param type $name
     * @param type $query
     * @return type
     */
    public static function item_detail($id, $name, $siteId = SiteConfig::WESHOP_EBAY, $storeId = StoreConfig::WESHOP_GLOBAL)
    {
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base(true) . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base(true) . '/amazon/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
            default:
                $url = Url::base(true) . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
                break;
        }
        return $url;
    }

    /**
     * landing detail
     * @param type $id
     * @param type $name
     * @param type $query
     * @return type
     */
    public static function landing_detail($id, $name, $query = null)
    {
        return "landing/" . TextUtility::removeMarks($name) . "-" . $id . '.html' . (empty($query) ? '' : $query);
    }
	
    public static function landing_deals($hostName, $id, $name){
    	return $hostName."/landing-deals/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }
    public static function landing_product($hostName, $id, $name){
    	return $hostName."/landing-product/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }
    
    // item description
    public static function item_description($id, $siteId = SiteConfig::WESHOP_EBAY)
    {

        $url = Url::base(true) . "product-description-" . $id . '.html';
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base(true) . "/ebay/product-description-" . $id . '.html';
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base(true) . "/amazon/product-description-" . $id . '.html';
                break;
            default:
                $url = Url::base(true) . "/product-description-" . $id . '.html';
                break;
        }
        return $url;

    }

    // item description
    public static function item_description_frame($id, $siteId = SiteConfig::WESHOP_EBAY)
    {
        if ($siteId == SiteConfig::WESHOP_EBAY)
            return "ebay/product-description-" . $id . '.html';
        else
            return "product-description-" . $id . '.html';

    }

    /**
     * Search
     * @param type $keyword
     * @return type
     */
    public static function search_global($keyword)
    {
        return "s/" . (empty($keyword) ? 'weshop' : $keyword) . ".html";
    }

    /**
     * Danh mục
     * @param type $id
     * @param type $name
     * @return type
     */
    public static function browse($id, $name, $siteId = SiteConfig::EBAY_VN)
    {
        $url = Url::base(true) . "/danh-muc/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base(true) . "/ebay/category/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base(true) . "/amazon/category/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
                break;
            default:
                $url = Url::base(true) . "/danh-muc/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
                break;
        }
        return $url;
    }

    /**
     * Trang toàn bộ danh mục
     * @return string
     */
    public static function categories()
    {
        return Url::base() . "/danh-muc.html";
    }

    /**
     * Trang toàn bộ thông báo
     * @return string
     */
    public static function notification()
    {
        return Url::base() . "/user/notification";
    }

    /**
     * Trang check out steep 1
     * @return string
     */
    public static function order_steep_one()
    {
        return Url::base() . "/carts.html";
    }

    /**
     * Trang check out steep 2
     * @param type $orderId
     * @return type
     */
    public static function order_steep_two($orderId)
    {
        return "order-" . $orderId . "/payment.html";
    }

    /**
     * Trang check out steep 3, mặc định là trang thông báo thông tin đơn hàng
     * @param type $orderId
     * @param type $condition
     * @return string
     */
    public static function order_steep_three($orderId, $condition = null)
    {
        /* Trang thông báo  */
        $link = "order-" . $orderId . "/support.html";
        switch ($condition) {
            case "support":
                /* Hỗ trợ thanh toán */
                $link .= "?support=true";
                break;
        }
        return $link;
    }

    public static function order_feemore($orderId)
    {
        /* Trang thông báo  */
        $link = "order-" . $orderId . "/feemore.html?feemore=true";
        return $link;
    }

    /**
     * Trang đón nhận thanh toán thành công ngân lượng
     * @param type $orderId
     * @return type
     */
    public static function order_check_payment($orderId)
    {
        return "order-" . $orderId . "/check.html";
    }

    /**
     * Trang chi tiết đơn hàng
     * @param type $orderId
     * @return type
     */
    public static function order_info($orderId)
    {
        return static::info($orderId);
    }

    /**
     * Trang user
     * @return string
     */
    public static function user_info()
    {
        return "user.html";
    }

    /**
     * Trang danh sách đơn hàng
     * @return string
     */
    public static function user_order()
    {
        return "user/order.html";
    }

    /**
     * Trang danh mục tin tổng hợp
     * @return string
     */
    public static function tin_th()
    {
        return "n/tin-tong-hop.html";
    }

    /**
     * Trang danh mục tin tổng hợp
     * @return string
     */
    public static function cs_qd()
    {
        return "n/chinh-sach-quy-dinh.html";
    }

    /**
     * Bảng giá dịch vụ
     * @return type
     */
    public static function ud_gia()
    {
        return self::news_detail('chinh-sach-gia');
    }

    /**
     * Quy chế hoạt động
     * @return type
     */
    public static function qc_hd()
    {
        return self::news_detail('quy-che-hoat-dong');
    }

    /**
     * all website
     * @return type
     */
    public static function website()
    {
        return "website.html";
    }

    public static function createOrder()
    {
        return "order/create";
    }

    /**
     *
     */
    public static function home($siteId = SiteConfig::WESHOP_GLOBAL)
    {
        $url = Url::base() . "/";
        switch ($siteId) {
            case SiteConfig::WESHOP_GLOBAL:
                $url = Url::base() . "/";
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base() . "/amazon.html";
                break;
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base() . "/ebay.html";
                break;
            default:
                $url = Url::base() . "/";
                break;
        }
        return $url;
    }

    public static function all_cat($siteId = SiteConfig::EBAY_VN)
    {
        $url = Url::base() . "/";
        switch ($siteId) {
            case SiteConfig::WESHOP_EBAY:
                $url = Url::base() . "/ebay/categories.html";
                break;
            case SiteConfig::WESHOP_AMAZON:
                $url = Url::base() . "/amazon/categories.html";
                break;
            default:
                $url = Url::base() . "/";
                break;
        }
        return $url;
    }

    // Url News
    public static function news()
    {
        return Url::base() . "/news.html";
    }

    public static function news_category($id, $name)
    {
        return Url::base() . "/news/category/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    public static function news_detail($id, $name)
    {
        return Url::base() . "/news/detail/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    // Url FAQ
    public static function faq()
    {
        return Url::base() . "/faq.html";
    }

    public static function faq_category($id, $name)
    {
        return Url::base() . "/faq/category/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    public static function faq_detail($id, $name)
    {
        return Url::base() . "/faq/detail/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    // Url Help
    public static function helps()
    {
        return Url::base() . "/helps.html";
    }

    public static function helps_category($id, $name)
    {
        return Url::base() . "/helps/category/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    public static function helps_detail($id, $name)
    {
        return Url::base() . "/helps/detail/" . TextUtility::removeMarks($name) . "-" . $id . '.html';
    }

    public static function baseUrlWallet()
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvn']){
            $domain = Yii::$app->params['stotes']['weshopvnuser'];
        }
        return $domain;
    }
    
    public static function userToFront()
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        return $domain;
    }

    public static function wallet()
    {
        return Url::base() . "/wallet/listwallet";
    }

    public static function getThumbEbay($originLink, $size = 220)
    {
        if (strpos($originLink, 'ebaystatic.com') !== false || strpos($originLink, 'ebayimg.com') === false) {
            return $originLink;
        }
        $parse = explode('/', $originLink);
        $id = $parse[count($parse) - 2];
        if ((strlen($id) < 5) || (!preg_match("/^[a-zA-Z0-9]+$/", $id) == 1)) {
            return $originLink;
        }
        $size = is_int($size) ? $size : 120;
        return 'http://i.ebayimg.com/images/g/' . $id . '/s-l' . $size . '.jpg';
    }

    public static function verifyCustomer($uid, $token)
    {
        return Url::base(true) . "/verify/" . $uid . "-" . $token . '.html';
    }

    public static function setNewPassword($uid, $token)
    {
        return Url::base(true) . "/reset-password/" . $uid . "-" . $token . '.html';
    }

    public static function forgotPassword()
    {
        return Url::base(true) . '/forgot-password.html';
    }

    public static function w_shipping()
    {
        return Url::base() . '/shipping.html';
    }

    public static function w_shopping_cart()
    {
        return Url::base() . '/shoppingcarts.html';
    }

    // Weshop global
    public static function messageDetail($id, $name)
    {
    	return Url::base() . '/account/message/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }
    public static function messageRead($id)
    {
    	return Url::base() . '/message/read-' . $id . '.html';
    }
    public static function brandsWeshop()
    {
        return Url::base() . '/brands.html';
    }
    public static function weshopBenefit()
    {
        return Url::base() . '/about-us.html';
    }
    public static function weshopServicePricing()
    {
    	return Url::base() . '/service-pricing.html';
    }
    public static function pasteLinkStep1Weshop($url = null)
    {
        if(!empty($url)){
            return Url::base() . '/paste-link.html?rel='.$url;
        }
    	return Url::base() . '/paste-link.html';
    }
    
    public static function pasteLinkStep2Weshop()
    {
    	return Url::base() . '/paste-link-result.html';
    }
	
    // Weshop global ebay
    public static function indexEbay()
    {
        return Url::base() . '/ebay.html';
    }

    public static function detailEbay($id, $name)
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        return $domain . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    public static function detailSourceEbay($id, $name)
    {
        return Url::base(true) . '/ebay/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    public static function sellerEbay($id)
    {
        return Url::base() . '/ebay/seller/' . $id . '.html';
    }

    public static function categorysEbay()
    {
        return Url::base() . '/ebay/categories.html';
    }

    public static function dailyDealsEbay()
    {
        return Url::base() . '/ebay/daily-deals.html';
    }

    // Weshop global amazon
    public static function indexAmazon()
    {
        return Url::base() . '/amazon.html';
    }

    public static function detailAmazon($id, $name)
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        return $domain . '/amazon/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }

    public static function detailSourceAmazon($id, $name)
    {
        return Url::base(true) . '/amazon/item/' . TextUtility::getUrlAlias($name) . '-' . $id . '.html';
    }


    public static function current(array $params = [], $scheme = false)
    {
        $currentParams = \Yii::$app->getRequest()->getQueryParams();
        $currentParams[0] = '/' . \Yii::$app->controller->getRoute();
        $route = ArrayHelper::merge($currentParams, $params);
        return BaseUrl::toRoute($route, $scheme);
    }

    static function WeshopAccountUrl($url)
    {
        return Url::base(true) . '/account/' . $url;
    }

    public static function followObjectUrl($object)
    {
        switch ($object->objectType) {
            case CustomerFollowed::ebay_item:
            case CustomerFollowed::ebay_auction:
                return self::detailEbay($object->objectId, $object->name);
                break;
            case CustomerFollowed::ebay_seller:
                return self::sellerEbay($object->objectId);
                break;
            case CustomerFollowed::search:
                return Url::base(true) . '/' . $object->note;
                break;
            case CustomerFollowed::amazon_item_solr:
            case CustomerFollowed::amazon_item:
                return static::detailAmazon($object->objectId, $object->name);
                break;
        }
    }

    static function invoice($invoiceId)
    {
        return Url::toRoute('account/invoice/invoice') . '?id=' . $invoiceId;
    }

    static function proforma($invoiceId)
    {
        return Url::toRoute('account/invoice/proforma') . '?id=' . $invoiceId;
    }

    static function detectStoreId()
    {
        $domain = Url::base(true);
        if($domain == Yii::$app->params['stotes']['weshopvnuser']){
            $domain = Yii::$app->params['stotes']['weshopvn'];
        }
        $store = Store::find()->where(['Url'=>$domain])->one();
        if($store != false){
            return $store->id;
        }
        return 0;
    }
    
     public static function sourceDetailAmazon($id, $name)
    {
        return 'https://www.amazon.com/' . TextUtility::getUrlAlias($name) . '/dp/' . $id ;
    }
}
