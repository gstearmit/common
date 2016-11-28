<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "store".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Url
 * @property integer $SslEnabled
 * @property string $SecureUrl
 * @property string $Hosts
 * @property integer $DisplayOrder
 * @property integer $ManageByOrganizationId
 * @property integer $CurrencyId
 * @property integer $SystemCountryId
 * @property integer $LanguageId
 * @property string $bidMinAmountLocal
 * @property string $chargeOutbid
 * @property string $minTopup
 * @property string $maxTopup
 * @property string $minWithdraw
 * @property string $maxWithdraw
 * @property string $baseUploadUrl
 * @property string $freeLocalShippingMax
 * @property integer $baseRoundWeight
 * @property integer $minPayWeight
 * @property integer $SystemWeightId
 * @property string $Address
 *
 * @property Address[] $addresses
 * @property Administrator[] $administrators
 * @property Affiliate[] $affiliates
 * @property AuctionInfos[] $auctionInfos
 * @property Banner[] $banners
 * @property Category[] $categories
 * @property CategoryCustomPolicy[] $categoryCustomPolicies
 * @property CategoryPricePolicyWeightSetting[] $categoryPricePolicyWeightSettings
 * @property Cmspage[] $cmspages
 * @property CouponLog[] $couponLogs
 * @property Customer[] $customers
 * @property CustomerClaim[] $customerClaims
 * @property CustomerClaimType[] $customerClaimTypes
 * @property CustomerFollowed[] $customerFolloweds
 * @property CustomerHelpdesk[] $customerHelpdesks
 * @property Discount[] $discounts
 * @property DiscountUsageHistory[] $discountUsageHistories
 * @property EmailAccount[] $emailAccounts
 * @property EmailTemplate[] $emailTemplates
 * @property Invoice[] $invoices
 * @property ItemCrawl[] $itemCrawls
 * @property Language[] $languages
 * @property Manufacturer[] $manufacturers
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property MembershipPackages[] $membershipPackages
 * @property MembershipPackagesDetail[] $membershipPackagesDetails
 * @property Merchant[] $merchants
 * @property News[] $news
 * @property Newscategories[] $newscategories
 * @property Order[] $orders
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderItemRefund[] $orderItemRefunds
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 * @property OrderService[] $orderServices
 * @property Partner[] $partners
 * @property PaymentProvider[] $paymentProviders
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosOrderRequest[] $posOrderRequests0
 * @property PosSetting[] $posSettings
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 * @property PurchaseOrder[] $purchaseOrders
 * @property RequestPackages[] $requestPackages
 * @property RequestShipment[] $requestShipments
 * @property SaleCommissionSetting[] $saleCommissionSettings
 * @property SaleTeam[] $saleTeams
 * @property SeoLanding[] $seoLandings
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShippingLog[] $shippingLogs
 * @property ShippingOptionGroup[] $shippingOptionGroups
 * @property ShippingOptionSetting[] $shippingOptionSettings
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property ShippingPackageLocal[] $shippingPackageLocals
 * @property ShippingProvider[] $shippingProviders
 * @property ShoppingCartItem[] $shoppingCartItems
 * @property Site[] $sites
 * @property Organization $manageByOrganization
 * @property SystemCurrency $currency
 * @property SystemCountry $systemCountry
 * @property Language $language
 * @property SystemWeightUnit $systemWeight
 * @property SystemAccount[] $systemAccounts
 * @property SystemAccountTransactionVoucher[] $systemAccountTransactionVouchers
 * @property Transaction[] $transactions
 * @property TransactionAccount[] $transactionAccounts
 * @property TransactionAccountSystem[] $transactionAccountSystems
 * @property TransactionExternal[] $transactionExternals
 * @property TransactionExternalVoucher[] $transactionExternalVouchers
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionQueueProcessedListAudit[] $transactionQueueProcessedListAudits
 * @property TransactionRefundDelegate[] $transactionRefundDelegates
 * @property TransactionVoucher[] $transactionVouchers
 * @property Warehouse[] $warehouses
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageService[] $warehousePackageServices
 * @property WarehousePackageSetting[] $warehousePackageSettings
 * @property WarehousePackageSettingGroup[] $warehousePackageSettingGroups
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class Store extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SslEnabled', 'DisplayOrder', 'ManageByOrganizationId', 'CurrencyId', 'SystemCountryId', 'LanguageId', 'baseRoundWeight', 'minPayWeight', 'SystemWeightId'], 'integer'],
            [['bidMinAmountLocal', 'chargeOutbid', 'minTopup', 'maxTopup', 'minWithdraw', 'maxWithdraw', 'freeLocalShippingMax'], 'number'],
            [['Name', 'Url', 'SecureUrl', 'baseUploadUrl'], 'string', 'max' => 400],
            [['Hosts'], 'string', 'max' => 1000],
            [['Address'], 'string', 'max' => 500],
            [['ManageByOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['ManageByOrganizationId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['SystemCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['SystemCountryId' => 'id']],
            [['LanguageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['LanguageId' => 'id']],
            [['SystemWeightId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Url' => 'Url',
            'SslEnabled' => 'Ssl Enabled',
            'SecureUrl' => 'Secure Url',
            'Hosts' => 'Hosts',
            'DisplayOrder' => 'Display Order',
            'ManageByOrganizationId' => 'Manage By Organization ID',
            'CurrencyId' => 'Currency ID',
            'SystemCountryId' => 'System Country ID',
            'LanguageId' => 'Language ID',
            'bidMinAmountLocal' => 'Bid Min Amount Local',
            'chargeOutbid' => 'Charge Outbid',
            'minTopup' => 'Min Topup',
            'maxTopup' => 'Max Topup',
            'minWithdraw' => 'Min Withdraw',
            'maxWithdraw' => 'Max Withdraw',
            'baseUploadUrl' => 'Base Upload Url',
            'freeLocalShippingMax' => 'Free Local Shipping Max',
            'baseRoundWeight' => 'Base Round Weight',
            'minPayWeight' => 'Min Pay Weight',
            'SystemWeightId' => 'System Weight ID',
            'Address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdministrators()
    {
        return $this->hasMany(Administrator::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliates()
    {
        return $this->hasMany(Affiliate::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasMany(AuctionInfos::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicies()
    {
        return $this->hasMany(CategoryCustomPolicy::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicyWeightSettings()
    {
        return $this->hasMany(CategoryPricePolicyWeightSetting::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspages()
    {
        return $this->hasMany(Cmspage::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponLogs()
    {
        return $this->hasMany(CouponLog::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaimTypes()
    {
        return $this->hasMany(CustomerClaimType::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerFolloweds()
    {
        return $this->hasMany(CustomerFollowed::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscounts()
    {
        return $this->hasMany(Discount::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountUsageHistories()
    {
        return $this->hasMany(DiscountUsageHistory::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAccounts()
    {
        return $this->hasMany(EmailAccount::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates()
    {
        return $this->hasMany(EmailTemplate::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCrawls()
    {
        return $this->hasMany(ItemCrawl::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Language::className(), ['LimitedToStores' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturers()
    {
        return $this->hasMany(Manufacturer::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackages()
    {
        return $this->hasMany(MembershipPackages::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackagesDetails()
    {
        return $this->hasMany(MembershipPackagesDetail::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchants()
    {
        return $this->hasMany(Merchant::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewscategories()
    {
        return $this->hasMany(Newscategories::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartners()
    {
        return $this->hasMany(Partner::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentProviders()
    {
        return $this->hasMany(PaymentProvider::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests0()
    {
        return $this->hasMany(PosOrderRequest::className(), ['AssigneToStoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSettings()
    {
        return $this->hasMany(PosSetting::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasMany(RequestPackages::className(), ['storeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettings()
    {
        return $this->hasMany(SaleCommissionSetting::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeams()
    {
        return $this->hasMany(SaleTeam::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoLandings()
    {
        return $this->hasMany(SeoLanding::className(), ['store' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingLogs()
    {
        return $this->hasMany(ShippingLog::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionGroups()
    {
        return $this->hasMany(ShippingOptionGroup::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettings()
    {
        return $this->hasMany(ShippingOptionSetting::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProviders()
    {
        return $this->hasMany(ShippingProvider::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCartItems()
    {
        return $this->hasMany(ShoppingCartItem::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageByOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'ManageByOrganizationId']);
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
    public function getSystemCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'SystemCountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'LanguageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeight()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'SystemWeightId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccounts()
    {
        return $this->hasMany(SystemAccount::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVouchers()
    {
        return $this->hasMany(SystemAccountTransactionVoucher::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccounts()
    {
        return $this->hasMany(TransactionAccount::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccountSystems()
    {
        return $this->hasMany(TransactionAccountSystem::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternals()
    {
        return $this->hasMany(TransactionExternal::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternalVouchers()
    {
        return $this->hasMany(TransactionExternalVoucher::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedListAudits()
    {
        return $this->hasMany(TransactionQueueProcessedListAudit::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRefundDelegates()
    {
        return $this->hasMany(TransactionRefundDelegate::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionVouchers()
    {
        return $this->hasMany(TransactionVoucher::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServices()
    {
        return $this->hasMany(WarehousePackageService::className(), ['StoreId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettings()
    {
        return $this->hasMany(WarehousePackageSetting::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingGroups()
    {
        return $this->hasMany(WarehousePackageSettingGroup::className(), ['store_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['store_id' => 'id']);
    }
}
