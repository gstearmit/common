<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $fullName
 * @property string $identityNumber
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $phone
 * @property integer $gender
 * @property string $birthday
 * @property string $address
 * @property string $avatar
 * @property string $linkVerified
 * @property integer $emailVerified
 * @property string $emailVerifiedTime
 * @property string $AdminComment
 * @property integer $Deleted
 * @property string $LastIpAddress
 * @property string $LastLoginTime
 * @property integer $ManageOrganizationId
 * @property integer $ManageDepartmentId
 * @property integer $ManageEmployeeId
 * @property integer $AffiliateId
 * @property integer $VendorId
 * @property integer $IsPersonal
 * @property string $CustomerRate
 * @property string $LastOrderDate
 * @property string $Mobile
 * @property string $EmailContact
 * @property string $CompanyName
 * @property string $Job
 * @property string $Position
 * @property string $CompanyTaxCode
 * @property integer $SourceId
 * @property integer $countryId
 * @property integer $ProvinceId
 * @property integer $DistrictId
 * @property integer $TypeCustomerId
 * @property integer $LanguageId
 * @property integer $customerGroupId
 * @property integer $active
 * @property string $updateTime
 * @property string $createTime
 * @property string $access_token
 * @property boolean $receiveEmailMarketing
 * @property integer $suspended
 * @property string $authClient
 * @property string $verifyToken
 * @property string $passwordResetToken
 * @property integer $oldId
 * @property integer $storeId
 * @property string $SocialSecurityNo
 * @property string $MembershipLoyaltyNo
 *
 * @property Address[] $addresses
 * @property AuctionInfos[] $auctionInfos
 * @property AuctionTransaction[] $auctionTransactions
 * @property CallDetail[] $callDetails
 * @property CallLog[] $callLogs
 * @property CouponLog[] $couponLogs
 * @property SystemCountry $country
 * @property Language $language
 * @property CustomerGroup $customerGroup
 * @property Store $store
 * @property SystemDistrict $district
 * @property SystemStateProvince $province
 * @property OrganizationEmployee $manageEmployee
 * @property Organization $manageOrganization
 * @property OrganizationDepartment $manageDepartment
 * @property Affiliate $affiliate
 * @property CustomerActivitySite[] $customerActivitySites
 * @property CustomerCall[] $customerCalls
 * @property CustomerCampaigns[] $customerCampaigns
 * @property CustomerCard[] $customerCards
 * @property CustomerCategoryCustomPolicy[] $customerCategoryCustomPolicies
 * @property CustomerClaim[] $customerClaims
 * @property CustomerContact[] $customerContacts
 * @property CustomerCouponCode[] $customerCouponCodes
 * @property CustomerCouponCodeUsed[] $customerCouponCodeUseds
 * @property CustomerEmail[] $customerEmails
 * @property CustomerFollowed[] $customerFolloweds
 * @property CustomerGift[] $customerGifts
 * @property CustomerHelpdesk[] $customerHelpdesks
 * @property CustomerItemHistory[] $customerItemHistories
 * @property CustomerLoginHistory[] $customerLoginHistories
 * @property CustomerMembership[] $customerMemberships
 * @property CustomerNotification[] $customerNotifications
 * @property CustomerNotificationSystemRead[] $customerNotificationSystemReads
 * @property CustomerPointItems[] $customerPointItems
 * @property CustomerPointTotal[] $customerPointTotals
 * @property CustomerProductHistory[] $customerProductHistories
 * @property CustomerProductInterested[] $customerProductInteresteds
 * @property CustomerShippingPreferences[] $customerShippingPreferences
 * @property CustomerWarehousePrefer[] $customerWarehousePrefers
 * @property DiscountCustomer[] $discountCustomers
 * @property Invoice[] $invoices
 * @property InvoiceMapCustomerOther[] $invoiceMapCustomerOthers
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property NotificationSettingCustomer[] $notificationSettingCustomers
 * @property Order[] $orders
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderItem[] $orderItems
 * @property OrderItemRefund[] $orderItemRefunds
 * @property PosCustomer[] $posCustomers
 * @property ProductReview[] $productReviews
 * @property PurchaseOrderItemRefund[] $purchaseOrderItemRefunds
 * @property RequestPackages[] $requestPackages
 * @property RequestPackagesItems[] $requestPackagesItems
 * @property RequestShipment[] $requestShipments
 * @property Shipment[] $shipments
 * @property ShippingLog[] $shippingLogs
 * @property ShippingPackageLocal[] $shippingPackageLocals
 * @property ShoppingCartItem[] $shoppingCartItems
 * @property SystemAccountTransaction[] $systemAccountTransactions
 * @property SystemAccountTransactionVoucher[] $systemAccountTransactionVouchers
 * @property Transaction[] $transactions
 * @property TransactionAccount[] $transactionAccounts
 * @property TransactionExternal[] $transactionExternals
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionRefundDelegate[] $transactionRefundDelegates
 * @property TransactionRequest[] $transactionRequests
 * @property WarehousePackage[] $warehousePackages
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'emailVerified', 'Deleted', 'ManageOrganizationId', 'ManageDepartmentId', 'ManageEmployeeId', 'AffiliateId', 'VendorId', 'IsPersonal', 'SourceId', 'countryId', 'ProvinceId', 'DistrictId', 'TypeCustomerId', 'LanguageId', 'customerGroupId', 'active', 'suspended', 'oldId', 'storeId'], 'integer'],
            [['birthday', 'emailVerifiedTime', 'LastLoginTime', 'LastOrderDate', 'updateTime', 'createTime'], 'safe'],
            [['CustomerRate'], 'number'],
            [['receiveEmailMarketing'], 'boolean'],
            [['firstName', 'lastName', 'email', 'SocialSecurityNo', 'MembershipLoyaltyNo'], 'string', 'max' => 100],
            [['fullName', 'AdminComment'], 'string', 'max' => 255],
            [['identityNumber', 'username', 'password', 'phone', 'LastIpAddress', 'Mobile', 'EmailContact', 'CompanyName', 'Job', 'Position', 'CompanyTaxCode', 'access_token', 'verifyToken', 'passwordResetToken'], 'string', 'max' => 50],
            [['salt'], 'string', 'max' => 25],
            [['address', 'avatar'], 'string', 'max' => 500],
            [['linkVerified'], 'string', 'max' => 220],
            [['authClient'], 'string', 'max' => 15],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['countryId' => 'id']],
            [['LanguageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['LanguageId' => 'id']],
            [['customerGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerGroup::className(), 'targetAttribute' => ['customerGroupId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['ManageEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ManageEmployeeId' => 'id']],
            [['ManageOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['ManageOrganizationId' => 'id']],
            [['ManageDepartmentId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationDepartment::className(), 'targetAttribute' => ['ManageDepartmentId' => 'id']],
            [['AffiliateId'], 'exist', 'skipOnError' => true, 'targetClass' => Affiliate::className(), 'targetAttribute' => ['AffiliateId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'fullName' => 'Full Name',
            'identityNumber' => 'Identity Number',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'salt' => 'Salt',
            'phone' => 'Phone',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'avatar' => 'Avatar',
            'linkVerified' => 'Link Verified',
            'emailVerified' => 'Email Verified',
            'emailVerifiedTime' => 'Email Verified Time',
            'AdminComment' => 'Admin Comment',
            'Deleted' => 'Deleted',
            'LastIpAddress' => 'Last Ip Address',
            'LastLoginTime' => 'Last Login Time',
            'ManageOrganizationId' => 'Manage Organization ID',
            'ManageDepartmentId' => 'Manage Department ID',
            'ManageEmployeeId' => 'Manage Employee ID',
            'AffiliateId' => 'Affiliate ID',
            'VendorId' => 'Vendor ID',
            'IsPersonal' => 'Is Personal',
            'CustomerRate' => 'Customer Rate',
            'LastOrderDate' => 'Last Order Date',
            'Mobile' => 'Mobile',
            'EmailContact' => 'Email Contact',
            'CompanyName' => 'Company Name',
            'Job' => 'Job',
            'Position' => 'Position',
            'CompanyTaxCode' => 'Company Tax Code',
            'SourceId' => 'Source ID',
            'countryId' => 'Country ID',
            'ProvinceId' => 'Province ID',
            'DistrictId' => 'District ID',
            'TypeCustomerId' => 'Type Customer ID',
            'LanguageId' => 'Language ID',
            'customerGroupId' => 'Customer Group ID',
            'active' => 'Active',
            'updateTime' => 'Update Time',
            'createTime' => 'Create Time',
            'access_token' => 'Access Token',
            'receiveEmailMarketing' => 'Receive Email Marketing',
            'suspended' => 'Suspended',
            'authClient' => 'Auth Client',
            'verifyToken' => 'Verify Token',
            'passwordResetToken' => 'Password Reset Token',
            'oldId' => 'Old ID',
            'storeId' => 'Store ID',
            'SocialSecurityNo' => 'Social Security No',
            'MembershipLoyaltyNo' => 'Membership Loyalty No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasMany(AuctionInfos::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionTransactions()
    {
        return $this->hasMany(AuctionTransaction::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallDetails()
    {
        return $this->hasMany(CallDetail::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallLogs()
    {
        return $this->hasMany(CallLog::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponLogs()
    {
        return $this->hasMany(CouponLog::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'countryId']);
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
    public function getCustomerGroup()
    {
        return $this->hasOne(CustomerGroup::className(), ['id' => 'customerGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'DistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'ProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ManageEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'ManageOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageDepartment()
    {
        return $this->hasOne(OrganizationDepartment::className(), ['id' => 'ManageDepartmentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliate()
    {
        return $this->hasOne(Affiliate::className(), ['id' => 'AffiliateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerActivitySites()
    {
        return $this->hasMany(CustomerActivitySite::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCalls()
    {
        return $this->hasMany(CustomerCall::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCampaigns()
    {
        return $this->hasMany(CustomerCampaigns::className(), ['Customer_Id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCards()
    {
        return $this->hasMany(CustomerCard::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCategoryCustomPolicies()
    {
        return $this->hasMany(CustomerCategoryCustomPolicy::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerContacts()
    {
        return $this->hasMany(CustomerContact::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCouponCodes()
    {
        return $this->hasMany(CustomerCouponCode::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCouponCodeUseds()
    {
        return $this->hasMany(CustomerCouponCodeUsed::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerEmails()
    {
        return $this->hasMany(CustomerEmail::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerFolloweds()
    {
        return $this->hasMany(CustomerFollowed::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGifts()
    {
        return $this->hasMany(CustomerGift::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerItemHistories()
    {
        return $this->hasMany(CustomerItemHistory::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerLoginHistories()
    {
        return $this->hasMany(CustomerLoginHistory::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerMemberships()
    {
        return $this->hasMany(CustomerMembership::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNotifications()
    {
        return $this->hasMany(CustomerNotification::className(), ['toCustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerNotificationSystemReads()
    {
        return $this->hasMany(CustomerNotificationSystemRead::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPointItems()
    {
        return $this->hasMany(CustomerPointItems::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPointTotals()
    {
        return $this->hasMany(CustomerPointTotal::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductHistories()
    {
        return $this->hasMany(CustomerProductHistory::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductInteresteds()
    {
        return $this->hasMany(CustomerProductInterested::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerShippingPreferences()
    {
        return $this->hasMany(CustomerShippingPreferences::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerWarehousePrefers()
    {
        return $this->hasMany(CustomerWarehousePrefer::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCustomers()
    {
        return $this->hasMany(DiscountCustomer::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerOthers()
    {
        return $this->hasMany(InvoiceMapCustomerOther::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationSettingCustomers()
    {
        return $this->hasMany(NotificationSettingCustomer::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomers()
    {
        return $this->hasMany(PosCustomer::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReview::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRefunds()
    {
        return $this->hasMany(PurchaseOrderItemRefund::className(), ['MerchantId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasMany(RequestPackages::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackagesItems()
    {
        return $this->hasMany(RequestPackagesItems::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['customerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingLogs()
    {
        return $this->hasMany(ShippingLog::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCartItems()
    {
        return $this->hasMany(ShoppingCartItem::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVouchers()
    {
        return $this->hasMany(SystemAccountTransactionVoucher::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccounts()
    {
        return $this->hasMany(TransactionAccount::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternals()
    {
        return $this->hasMany(TransactionExternal::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRefundDelegates()
    {
        return $this->hasMany(TransactionRefundDelegate::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['CustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['CustomerId' => 'id']);
    }
}
