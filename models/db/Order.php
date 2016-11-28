<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $siteId
 * @property integer $type
 * @property string $buyerEmail
 * @property string $buyerName
 * @property string $buyerPhone
 * @property string $buyerAddress
 * @property integer $buyerCountryId
 * @property integer $buyerProvinceId
 * @property integer $buyerDistrictId
 * @property string $buyerPostCode
 * @property string $receiverEmail
 * @property string $receiverName
 * @property string $receiverPhone
 * @property string $receiverAddress
 * @property integer $receiverCountryId
 * @property integer $receiverCityId
 * @property integer $receiverDistrictId
 * @property string $receiverPostCode
 * @property string $paymentMethod
 * @property integer $paymentMethodProviderId
 * @property string $paymentType
 * @property string $paymentToken
 * @property integer $paymentTokenCheckType
 * @property integer $refundStatus
 * @property integer $paymentStatus
 * @property integer $shippingStatus
 * @property string $shipmentPrice
 * @property string $createTime
 * @property string $updateTime
 * @property integer $remove
 * @property integer $complete
 * @property string $note
 * @property double $weight
 * @property string $discountAmount
 * @property string $discountPercent
 * @property string $totalPrice
 * @property string $finalPrice
 * @property string $ladingId
 * @property string $buyerWardId
 * @property string $receiverWardId
 * @property string $couponCode
 * @property string $couponTime
 * @property string $supportEmail
 * @property integer $supportStatus
 * @property string $complaint
 * @property integer $CustomerId
 * @property integer $BillingAddressId
 * @property integer $ShippingAddressId
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $OrderSubtotalExclTax
 * @property string $OrderTax
 * @property string $OrderSubtotalInclTax
 * @property string $OrderShipingAmount
 * @property string $OrderShippingInclTax
 * @property string $OrderFeeServiceAmount
 * @property string $OrderCustomFee
 * @property string $OrderCustomAdditionFee
 * @property string $PaymentAdditionalFeeInclTax
 * @property string $AdditionFeeAmount
 * @property string $AdditionFeeLocalAmount
 * @property string $AdditionFeePaidAmount
 * @property string $ShipmentLocalPerUnit
 * @property string $ShipmentLocalAmount
 * @property string $OrderTotal
 * @property string $OrderTotalInLocalCurrency
 * @property string $OrderTotalInLocalCurrencyDisplay
 * @property string $OrderTotalInLocalCurrencyFinal
 * @property string $TotalPaidAmount
 * @property string $TotalWalletPaidPrimaryAmount
 * @property string $TotalWalletPaidPromotionAmount
 * @property string $TotalWalletPaidPrimaryAmountFee
 * @property string $TotalWalletPaidPromotionAmountFee
 * @property string $PromotionPointToWallet
 * @property string $LastPaidTime
 * @property string $RemainAmount
 * @property string $ShipmentMethod
 * @property string $LastShipmentTime
 * @property integer $AffiliateId
 * @property string $CustomerIp
 * @property integer $ManageOrganizationId
 * @property integer $ManageDepartmentId
 * @property integer $ManageSaleTeamId
 * @property integer $ManageEmployeeId
 * @property integer $ManageApprovedByEmployeeId
 * @property integer $ManageApprovedStatus
 * @property string $RefundedAmount
 * @property integer $FileSentToCustomerId
 * @property integer $FileStoreId
 * @property string $BuyerFirstName
 * @property string $BuyerLastName
 * @property string $ReceiveFirstName
 * @property string $ReceiveLastName
 * @property integer $IsEmailSent
 * @property integer $IsSmsSent
 * @property integer $SourceId
 * @property integer $CampSourceId
 * @property integer $LastUpdateByEmployeeId
 * @property integer $IsQuotation
 * @property integer $Quotation_status
 * @property integer $OrderStatus
 * @property integer $PurchaseStatus
 * @property string $BankName
 * @property integer $IsRequestInspection
 * @property string $Quotation_Note
 * @property integer $ShipmentOptionsStatus
 * @property string $vat
 * @property integer $totalquantity
 * @property string $binCode
 * @property integer $customerOrderConfirm
 * @property integer $customerPaymentConfirm
 * @property string $supporterNote
 * @property integer $supportPaymentConfirm
 * @property string $supportTime
 * @property integer $purchaseConfirm
 * @property integer $isNewOrder
 * @property string $orderItemIds
 * @property string $orderItemCategoryIds
 * @property integer $discountId
 * @property string $refundedPaidAmount
 * @property boolean $isAuction
 * @property integer $stockinStatus
 * @property integer $stockoutStatus
 * @property integer $orderLevel
 * @property integer $operatorCheck
 * @property integer $storeId
 * @property string $totalPoint
 * @property string $AdditionFeeTotalLocalAmount
 * @property string $AdditionFeePaidLocalAmount
 * @property string $HistoryToken
 * @property integer $PurchaseEmployeeId
 * @property integer $PosSettingId
 * @property string $TrackingCodeToCustomer
 * @property string $SecurityCodeToCustomer
 * @property string $bcardNo
 * @property string $bcardAddTime
 * @property integer $isLogin
 *
 * @property CallLog[] $callLogs
 * @property CouponLog[] $couponLogs
 * @property CustomerClaim[] $customerClaims
 * @property CustomerCouponCodeUsed[] $customerCouponCodeUseds
 * @property CustomerGift[] $customerGifts
 * @property CustomerPointItems[] $customerPointItems
 * @property DiscountUsageHistory[] $discountUsageHistories
 * @property InvoiceMapOrder[] $invoiceMapOrders
 * @property Site $site
 * @property SystemCountry $buyerCountry
 * @property SystemStateProvince $buyerProvince
 * @property SystemDistrict $buyerDistrict
 * @property SystemCountry $receiverCountry
 * @property SystemStateProvince $receiverCity
 * @property SystemDistrict $receiverDistrict
 * @property SystemCurrency $currency
 * @property Organization $manageOrganization
 * @property OrganizationDepartment $manageDepartment
 * @property SaleTeam $manageSaleTeam
 * @property Customer $customer
 * @property OrganizationEmployee $manageApprovedByEmployee
 * @property FileUpload $fileSentToCustomer
 * @property FileUpload $fileStore
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Discount $discount
 * @property Store $store
 * @property OrganizationEmployee $purchaseEmployee
 * @property PosSetting $posSetting
 * @property Address $billingAddress
 * @property Address $shippingAddress
 * @property Affiliate $affiliate
 * @property Campaign $campSource
 * @property OrganizationEmployee $lastUpdateByEmployee
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderItem[] $orderItems
 * @property OrderNote[] $orderNotes
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 * @property OrderService[] $orderServices
 * @property OrderSupportLog[] $orderSupportLogs
 * @property QueuedEmail[] $queuedEmails
 * @property SaleCommissionSettingDetail[] $saleCommissionSettingDetails
 * @property Shipment[] $shipments
 * @property SystemAccountTransaction[] $systemAccountTransactions
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siteId', 'type', 'buyerCountryId', 'buyerProvinceId', 'buyerDistrictId', 'receiverCountryId', 'receiverCityId', 'receiverDistrictId', 'paymentMethodProviderId', 'paymentTokenCheckType', 'refundStatus', 'paymentStatus', 'shippingStatus', 'remove', 'complete', 'supportStatus', 'CustomerId', 'BillingAddressId', 'ShippingAddressId', 'CurrencyId', 'AffiliateId', 'ManageOrganizationId', 'ManageDepartmentId', 'ManageSaleTeamId', 'ManageEmployeeId', 'ManageApprovedByEmployeeId', 'ManageApprovedStatus', 'FileSentToCustomerId', 'FileStoreId', 'IsEmailSent', 'IsSmsSent', 'SourceId', 'CampSourceId', 'LastUpdateByEmployeeId', 'IsQuotation', 'Quotation_status', 'OrderStatus', 'PurchaseStatus', 'IsRequestInspection', 'ShipmentOptionsStatus', 'totalquantity', 'customerOrderConfirm', 'customerPaymentConfirm', 'supportPaymentConfirm', 'purchaseConfirm', 'isNewOrder', 'discountId', 'stockinStatus', 'stockoutStatus', 'orderLevel', 'operatorCheck', 'storeId', 'PurchaseEmployeeId', 'PosSettingId', 'isLogin'], 'integer'],
            [['shipmentPrice', 'weight', 'discountAmount', 'discountPercent', 'totalPrice', 'finalPrice', 'CurrencyRate', 'OrderSubtotalExclTax', 'OrderTax', 'OrderSubtotalInclTax', 'OrderShipingAmount', 'OrderShippingInclTax', 'OrderFeeServiceAmount', 'OrderCustomFee', 'OrderCustomAdditionFee', 'PaymentAdditionalFeeInclTax', 'AdditionFeeAmount', 'AdditionFeeLocalAmount', 'AdditionFeePaidAmount', 'ShipmentLocalPerUnit', 'ShipmentLocalAmount', 'OrderTotal', 'OrderTotalInLocalCurrency', 'OrderTotalInLocalCurrencyDisplay', 'OrderTotalInLocalCurrencyFinal', 'TotalPaidAmount', 'TotalWalletPaidPrimaryAmount', 'TotalWalletPaidPromotionAmount', 'TotalWalletPaidPrimaryAmountFee', 'TotalWalletPaidPromotionAmountFee', 'PromotionPointToWallet', 'RemainAmount', 'RefundedAmount', 'refundedPaidAmount', 'totalPoint', 'AdditionFeeTotalLocalAmount', 'AdditionFeePaidLocalAmount'], 'number'],
            [['createTime', 'updateTime', 'couponTime', 'LastPaidTime', 'LastShipmentTime', 'supportTime', 'bcardAddTime'], 'safe'],
            [['note', 'vat', 'supporterNote', 'HistoryToken'], 'string'],
            [['isAuction'], 'boolean'],
            [['buyerEmail', 'receiverEmail', 'BankName'], 'string', 'max' => 100],
            [['buyerName', 'buyerAddress', 'receiverName', 'receiverAddress'], 'string', 'max' => 220],
            [['buyerPhone', 'receiverPhone', 'paymentMethod', 'paymentType', 'ladingId', 'couponCode', 'supportEmail', 'ShipmentMethod', 'CustomerIp', 'BuyerFirstName', 'BuyerLastName', 'ReceiveFirstName', 'ReceiveLastName', 'binCode'], 'string', 'max' => 50],
            [['buyerPostCode', 'receiverPostCode', 'Quotation_Note', 'orderItemCategoryIds', 'TrackingCodeToCustomer', 'SecurityCodeToCustomer'], 'string', 'max' => 255],
            [['paymentToken', 'orderItemIds'], 'string', 'max' => 1000],
            [['buyerWardId', 'receiverWardId'], 'string', 'max' => 10],
            [['complaint'], 'string', 'max' => 200],
            [['bcardNo'], 'string', 'max' => 500],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['buyerCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['buyerCountryId' => 'id']],
            [['buyerProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['buyerProvinceId' => 'id']],
            [['buyerDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['buyerDistrictId' => 'id']],
            [['receiverCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['receiverCountryId' => 'id']],
            [['receiverCityId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['receiverCityId' => 'id']],
            [['receiverDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['receiverDistrictId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['ManageOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['ManageOrganizationId' => 'id']],
            [['ManageDepartmentId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationDepartment::className(), 'targetAttribute' => ['ManageDepartmentId' => 'id']],
            [['ManageSaleTeamId'], 'exist', 'skipOnError' => true, 'targetClass' => SaleTeam::className(), 'targetAttribute' => ['ManageSaleTeamId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['ManageApprovedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ManageApprovedByEmployeeId' => 'id']],
            [['FileSentToCustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => FileUpload::className(), 'targetAttribute' => ['FileSentToCustomerId' => 'id']],
            [['FileStoreId'], 'exist', 'skipOnError' => true, 'targetClass' => FileUpload::className(), 'targetAttribute' => ['FileStoreId' => 'id']],
            [['paymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['paymentMethodProviderId' => 'id']],
            [['discountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['discountId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['PurchaseEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['PurchaseEmployeeId' => 'id']],
            [['PosSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => PosSetting::className(), 'targetAttribute' => ['PosSettingId' => 'id']],
            [['BillingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['BillingAddressId' => 'id']],
            [['ShippingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => Address::className(), 'targetAttribute' => ['ShippingAddressId' => 'id']],
            [['AffiliateId'], 'exist', 'skipOnError' => true, 'targetClass' => Affiliate::className(), 'targetAttribute' => ['AffiliateId' => 'id']],
            [['CampSourceId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['CampSourceId' => 'id']],
            [['LastUpdateByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['LastUpdateByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siteId' => 'Site ID',
            'type' => 'Type',
            'buyerEmail' => 'Buyer Email',
            'buyerName' => 'Buyer Name',
            'buyerPhone' => 'Buyer Phone',
            'buyerAddress' => 'Buyer Address',
            'buyerCountryId' => 'Buyer Country ID',
            'buyerProvinceId' => 'Buyer Province ID',
            'buyerDistrictId' => 'Buyer District ID',
            'buyerPostCode' => 'Buyer Post Code',
            'receiverEmail' => 'Receiver Email',
            'receiverName' => 'Receiver Name',
            'receiverPhone' => 'Receiver Phone',
            'receiverAddress' => 'Receiver Address',
            'receiverCountryId' => 'Receiver Country ID',
            'receiverCityId' => 'Receiver City ID',
            'receiverDistrictId' => 'Receiver District ID',
            'receiverPostCode' => 'Receiver Post Code',
            'paymentMethod' => 'Payment Method',
            'paymentMethodProviderId' => 'Payment Method Provider ID',
            'paymentType' => 'Payment Type',
            'paymentToken' => 'Payment Token',
            'paymentTokenCheckType' => 'Payment Token Check Type',
            'refundStatus' => 'Refund Status',
            'paymentStatus' => 'Payment Status',
            'shippingStatus' => 'Shipping Status',
            'shipmentPrice' => 'Shipment Price',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'remove' => 'Remove',
            'complete' => 'Complete',
            'note' => 'Note',
            'weight' => 'Weight',
            'discountAmount' => 'Discount Amount',
            'discountPercent' => 'Discount Percent',
            'totalPrice' => 'Total Price',
            'finalPrice' => 'Final Price',
            'ladingId' => 'Lading ID',
            'buyerWardId' => 'Buyer Ward ID',
            'receiverWardId' => 'Receiver Ward ID',
            'couponCode' => 'Coupon Code',
            'couponTime' => 'Coupon Time',
            'supportEmail' => 'Support Email',
            'supportStatus' => 'Support Status',
            'complaint' => 'Complaint',
            'CustomerId' => 'Customer ID',
            'BillingAddressId' => 'Billing Address ID',
            'ShippingAddressId' => 'Shipping Address ID',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'OrderSubtotalExclTax' => 'Order Subtotal Excl Tax',
            'OrderTax' => 'Order Tax',
            'OrderSubtotalInclTax' => 'Order Subtotal Incl Tax',
            'OrderShipingAmount' => 'Order Shiping Amount',
            'OrderShippingInclTax' => 'Order Shipping Incl Tax',
            'OrderFeeServiceAmount' => 'Order Fee Service Amount',
            'OrderCustomFee' => 'Order Custom Fee',
            'OrderCustomAdditionFee' => 'Order Custom Addition Fee',
            'PaymentAdditionalFeeInclTax' => 'Payment Additional Fee Incl Tax',
            'AdditionFeeAmount' => 'Addition Fee Amount',
            'AdditionFeeLocalAmount' => 'Addition Fee Local Amount',
            'AdditionFeePaidAmount' => 'Addition Fee Paid Amount',
            'ShipmentLocalPerUnit' => 'Shipment Local Per Unit',
            'ShipmentLocalAmount' => 'Shipment Local Amount',
            'OrderTotal' => 'Order Total',
            'OrderTotalInLocalCurrency' => 'Order Total In Local Currency',
            'OrderTotalInLocalCurrencyDisplay' => 'Order Total In Local Currency Display',
            'OrderTotalInLocalCurrencyFinal' => 'Order Total In Local Currency Final',
            'TotalPaidAmount' => 'Total Paid Amount',
            'TotalWalletPaidPrimaryAmount' => 'Total Wallet Paid Primary Amount',
            'TotalWalletPaidPromotionAmount' => 'Total Wallet Paid Promotion Amount',
            'TotalWalletPaidPrimaryAmountFee' => 'Total Wallet Paid Primary Amount Fee',
            'TotalWalletPaidPromotionAmountFee' => 'Total Wallet Paid Promotion Amount Fee',
            'PromotionPointToWallet' => 'Promotion Point To Wallet',
            'LastPaidTime' => 'Last Paid Time',
            'RemainAmount' => 'Remain Amount',
            'ShipmentMethod' => 'Shipment Method',
            'LastShipmentTime' => 'Last Shipment Time',
            'AffiliateId' => 'Affiliate ID',
            'CustomerIp' => 'Customer Ip',
            'ManageOrganizationId' => 'Manage Organization ID',
            'ManageDepartmentId' => 'Manage Department ID',
            'ManageSaleTeamId' => 'Manage Sale Team ID',
            'ManageEmployeeId' => 'Manage Employee ID',
            'ManageApprovedByEmployeeId' => 'Manage Approved By Employee ID',
            'ManageApprovedStatus' => 'Manage Approved Status',
            'RefundedAmount' => 'Refunded Amount',
            'FileSentToCustomerId' => 'File Sent To Customer ID',
            'FileStoreId' => 'File Store ID',
            'BuyerFirstName' => 'Buyer First Name',
            'BuyerLastName' => 'Buyer Last Name',
            'ReceiveFirstName' => 'Receive First Name',
            'ReceiveLastName' => 'Receive Last Name',
            'IsEmailSent' => 'Is Email Sent',
            'IsSmsSent' => 'Is Sms Sent',
            'SourceId' => 'Source ID',
            'CampSourceId' => 'Camp Source ID',
            'LastUpdateByEmployeeId' => 'Last Update By Employee ID',
            'IsQuotation' => 'Is Quotation',
            'Quotation_status' => 'Quotation Status',
            'OrderStatus' => 'Order Status',
            'PurchaseStatus' => 'Purchase Status',
            'BankName' => 'Bank Name',
            'IsRequestInspection' => 'Is Request Inspection',
            'Quotation_Note' => 'Quotation  Note',
            'ShipmentOptionsStatus' => 'Shipment Options Status',
            'vat' => 'Vat',
            'totalquantity' => 'Totalquantity',
            'binCode' => 'Bin Code',
            'customerOrderConfirm' => 'Customer Order Confirm',
            'customerPaymentConfirm' => 'Customer Payment Confirm',
            'supporterNote' => 'Supporter Note',
            'supportPaymentConfirm' => 'Support Payment Confirm',
            'supportTime' => 'Support Time',
            'purchaseConfirm' => 'Purchase Confirm',
            'isNewOrder' => 'Is New Order',
            'orderItemIds' => 'Order Item Ids',
            'orderItemCategoryIds' => 'Order Item Category Ids',
            'discountId' => 'Discount ID',
            'refundedPaidAmount' => 'Refunded Paid Amount',
            'isAuction' => 'Is Auction',
            'stockinStatus' => 'Stockin Status',
            'stockoutStatus' => 'Stockout Status',
            'orderLevel' => 'Order Level',
            'operatorCheck' => 'Operator Check',
            'storeId' => 'Store ID',
            'totalPoint' => 'Total Point',
            'AdditionFeeTotalLocalAmount' => 'Addition Fee Total Local Amount',
            'AdditionFeePaidLocalAmount' => 'Addition Fee Paid Local Amount',
            'HistoryToken' => 'History Token',
            'PurchaseEmployeeId' => 'Purchase Employee ID',
            'PosSettingId' => 'Pos Setting ID',
            'TrackingCodeToCustomer' => 'Tracking Code To Customer',
            'SecurityCodeToCustomer' => 'Security Code To Customer',
            'bcardNo' => 'Bcard No',
            'bcardAddTime' => 'Bcard Add Time',
            'isLogin' => 'Is Login',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallLogs()
    {
        return $this->hasMany(CallLog::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponLogs()
    {
        return $this->hasMany(CouponLog::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCouponCodeUseds()
    {
        return $this->hasMany(CustomerCouponCodeUsed::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGifts()
    {
        return $this->hasMany(CustomerGift::className(), ['OrderIdRef' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPointItems()
    {
        return $this->hasMany(CustomerPointItems::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountUsageHistories()
    {
        return $this->hasMany(DiscountUsageHistory::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrders()
    {
        return $this->hasMany(InvoiceMapOrder::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'buyerCountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'buyerProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'buyerDistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'receiverCountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverCity()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'receiverCityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'receiverDistrictId']);
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
    public function getManageSaleTeam()
    {
        return $this->hasOne(SaleTeam::className(), ['id' => 'ManageSaleTeamId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageApprovedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ManageApprovedByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileSentToCustomer()
    {
        return $this->hasOne(FileUpload::className(), ['id' => 'FileSentToCustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileStore()
    {
        return $this->hasOne(FileUpload::className(), ['id' => 'FileStoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'paymentMethodProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discountId']);
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
    public function getPurchaseEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'PurchaseEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSetting()
    {
        return $this->hasOne(PosSetting::className(), ['id' => 'PosSettingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'BillingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'ShippingAddressId']);
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
    public function getCampSource()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'CampSourceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLastUpdateByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'LastUpdateByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNotes()
    {
        return $this->hasMany(OrderNote::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSupportLogs()
    {
        return $this->hasMany(OrderSupportLog::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueuedEmails()
    {
        return $this->hasMany(QueuedEmail::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettingDetails()
    {
        return $this->hasMany(SaleCommissionSettingDetail::className(), ['OrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['orderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['OrderRefId' => 'id']);
    }
}
