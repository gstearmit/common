<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site".
 *
 * @property integer $id
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $createEmail
 * @property string $updateEmail
 * @property string $domain
 * @property integer $IsActive
 * @property integer $home
 * @property string $Name
 * @property integer $create
 * @property integer $complete
 * @property double $usTax
 * @property double $feeShip
 * @property double $feeMore
 * @property double $coefficient
 * @property string $SeoTitle
 * @property string $SeoDescription
 * @property string $SeoKeyword
 * @property integer $CurrencyId
 * @property integer $StoreId
 * @property string $logo
 *
 * @property Administrator[] $administrators
 * @property Affiliate[] $affiliates
 * @property AuctionInfos[] $auctionInfos
 * @property Banner[] $banners
 * @property BannerLog[] $bannerLogs
 * @property Brand[] $brands
 * @property Category[] $categories
 * @property CmsBlock[] $cmsBlocks
 * @property Cmspage[] $cmspages
 * @property CustomerClaim[] $customerClaims
 * @property CustomerFollowed[] $customerFolloweds
 * @property CustomerHelpdesk[] $customerHelpdesks
 * @property Discount[] $discounts
 * @property DiscountUsageHistory[] $discountUsageHistories
 * @property Hotdealbox[] $hotdealboxes
 * @property ItemCrawl[] $itemCrawls
 * @property Merchant[] $merchants
 * @property Order[] $orders
 * @property OrderItem[] $orderItems
 * @property Partner[] $partners
 * @property PaymentProvider[] $paymentProviders
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 * @property PurchaseOrder[] $purchaseOrders
 * @property Roles[] $roles
 * @property SeoLanding[] $seoLandings
 * @property ShippingLog[] $shippingLogs
 * @property ShippingMethod[] $shippingMethods
 * @property ShoppingCartItem[] $shoppingCartItems
 * @property Store $store
 * @property SystemCurrency $currency
 * @property SystemAccount[] $systemAccounts
 * @property SystemPointConvertSetting[] $systemPointConvertSettings
 * @property SystemPointWalletConvert[] $systemPointWalletConverts
 * @property Transaction[] $transactions
 * @property TransactionAccount[] $transactionAccounts
 * @property TransactionRequest[] $transactionRequests
 */
class Site extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime', 'IsActive', 'home', 'create', 'complete', 'CurrencyId', 'StoreId'], 'integer'],
            [['usTax', 'feeShip', 'feeMore', 'coefficient'], 'number'],
            [['createEmail', 'updateEmail'], 'string', 'max' => 50],
            [['domain', 'Name'], 'string', 'max' => 220],
            [['SeoTitle', 'SeoDescription', 'SeoKeyword', 'logo'], 'string', 'max' => 255],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'domain' => 'Domain',
            'IsActive' => 'Is Active',
            'home' => 'Home',
            'Name' => 'Name',
            'create' => 'Create',
            'complete' => 'Complete',
            'usTax' => 'Us Tax',
            'feeShip' => 'Fee Ship',
            'feeMore' => 'Fee More',
            'coefficient' => 'Coefficient',
            'SeoTitle' => 'Seo Title',
            'SeoDescription' => 'Seo Description',
            'SeoKeyword' => 'Seo Keyword',
            'CurrencyId' => 'Currency ID',
            'StoreId' => 'Store ID',
            'logo' => 'Logo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrators()
    {
        return $this->hasMany(Administrator::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliates()
    {
        return $this->hasMany(Affiliate::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasMany(AuctionInfos::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerLogs()
    {
        return $this->hasMany(BannerLog::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrands()
    {
        return $this->hasMany(Brand::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlocks()
    {
        return $this->hasMany(CmsBlock::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspages()
    {
        return $this->hasMany(Cmspage::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerFolloweds()
    {
        return $this->hasMany(CustomerFollowed::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discount::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountUsageHistories()
    {
        return $this->hasMany(DiscountUsageHistory::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotdealboxes()
    {
        return $this->hasMany(Hotdealbox::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCrawls()
    {
        return $this->hasMany(ItemCrawl::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchants()
    {
        return $this->hasMany(Merchant::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartners()
    {
        return $this->hasMany(Partner::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentProviders()
    {
        return $this->hasMany(PaymentProvider::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Roles::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoLandings()
    {
        return $this->hasMany(SeoLanding::className(), ['site' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingLogs()
    {
        return $this->hasMany(ShippingLog::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingMethods()
    {
        return $this->hasMany(ShippingMethod::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCartItems()
    {
        return $this->hasMany(ShoppingCartItem::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccounts()
    {
        return $this->hasMany(SystemAccount::className(), ['SiteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemPointConvertSettings()
    {
        return $this->hasMany(SystemPointConvertSetting::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemPointWalletConverts()
    {
        return $this->hasMany(SystemPointWalletConvert::className(), ['siteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['SiteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccounts()
    {
        return $this->hasMany(TransactionAccount::className(), ['SiteId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['SiteId' => 'id']);
    }
}
