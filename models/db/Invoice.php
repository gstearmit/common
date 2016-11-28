<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $InvoiceStatus
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property integer $CustomerId
 * @property integer $TypeInvoice
 * @property string $BillName
 * @property string $BillEmail
 * @property string $BillPhone
 * @property string $BillMobilePhone
 * @property string $BillAddress
 * @property string $BillZipCode
 * @property string $BillDistrict
 * @property string $BillProvince
 * @property string $BillCountry
 * @property string $SuiteNumber
 * @property string $RefOrderNumber
 * @property integer $RefOrderObjectTypeId
 * @property string $RefOrderTime
 * @property string $RefOrderProcessTime
 * @property string $RefOrderProcessBy
 * @property string $AirwayBillNumber
 * @property integer $ShipInBoxes
 * @property integer $SizeBoxes
 * @property integer $PackagesConsolidated
 * @property string $DeclarationValue
 * @property string $BillWeight
 * @property integer $WeightUnit
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property integer $SystemAccountTransactionId
 * @property string $LastPaidTime
 * @property string $Note
 * @property string $TotalExclTax
 * @property string $InvoiceTax
 * @property string $TotalInclTax
 * @property string $CurrencyName
 * @property string $CurrencyRate
 * @property string $TotalInLocalCurrency
 * @property string $TotalPaidAmount
 * @property string $RemainAmount
 * @property integer $TotalQuantityItems
 * @property integer $NumberOfLines
 * @property integer $ManageEmployeeId
 * @property integer $ManageOrganizationId
 * @property integer $StoreId
 * @property integer $SiteId
 * @property string $ShipName
 * @property string $ShipEmail
 * @property string $ShipPhone
 * @property string $ShipMobilePhone
 * @property string $ShipAddress
 * @property string $ShipZipCode
 * @property string $ShipDistrict
 * @property string $ShipProvince
 * @property string $ShipCountry
 * @property string $DueDate
 * @property string $PaymentTerm
 *
 * @property Customer $customer
 * @property OrganizationEmployee $manageEmployee
 * @property Organization $manageOrganization
 * @property Store $store
 * @property SystemAccountTransaction $systemAccountTransaction
 * @property InvoiceItem[] $invoiceItems
 * @property InvoiceMapAuctionInfos[] $invoiceMapAuctionInfos
 * @property InvoiceMapCustomerMembership[] $invoiceMapCustomerMemberships
 * @property InvoiceMapCustomerOther[] $invoiceMapCustomerOthers
 * @property InvoiceMapOrder[] $invoiceMapOrders
 * @property InvoiceMapOrderItem[] $invoiceMapOrderItems
 * @property InvoiceMapOrderItemRefund[] $invoiceMapOrderItemRefunds
 * @property InvoiceMapPurchase[] $invoiceMapPurchases
 * @property InvoiceMapPurchaseItem[] $invoiceMapPurchaseItems
 * @property InvoiceMapPurchaseItemRefund[] $invoiceMapPurchaseItemRefunds
 * @property InvoiceMapRequestShipment[] $invoiceMapRequestShipments
 * @property InvoiceMapShipment[] $invoiceMapShipments
 * @property InvoiceMapShipmentBulk[] $invoiceMapShipmentBulks
 * @property InvoiceMapShippingProviderOther[] $invoiceMapShippingProviderOthers
 * @property InvoiceMapWahousePackageService[] $invoiceMapWahousePackageServices
 * @property InvoiceMapWarehousePackageItemService[] $invoiceMapWarehousePackageItemServices
 * @property InvoiceProforma[] $invoiceProformas
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InvoiceStatus', 'CustomerId', 'TypeInvoice', 'RefOrderObjectTypeId', 'ShipInBoxes', 'SizeBoxes', 'PackagesConsolidated', 'WeightUnit', 'PaymentStatus', 'SystemAccountTransactionId', 'TotalQuantityItems', 'NumberOfLines', 'ManageEmployeeId', 'ManageOrganizationId', 'StoreId', 'SiteId'], 'integer'],
            [['CreateTime', 'UpdateTime', 'RefOrderTime', 'RefOrderProcessTime', 'LastPaidTime', 'DueDate'], 'safe'],
            [['DeclarationValue', 'BillWeight', 'TotalExclTax', 'InvoiceTax', 'TotalInclTax', 'CurrencyRate', 'TotalInLocalCurrency', 'TotalPaidAmount', 'RemainAmount'], 'number'],
            [['BillName', 'ShipName'], 'string', 'max' => 220],
            [['BillEmail', 'ShipEmail'], 'string', 'max' => 100],
            [['BillPhone', 'BillMobilePhone', 'BillDistrict', 'BillProvince', 'BillCountry', 'SuiteNumber', 'RefOrderNumber', 'PaymentMethod', 'ShipPhone', 'ShipMobilePhone'], 'string', 'max' => 50],
            [['BillAddress', 'ShipAddress'], 'string', 'max' => 500],
            [['BillZipCode', 'ShipZipCode', 'ShipCountry'], 'string', 'max' => 10],
            [['RefOrderProcessBy', 'AirwayBillNumber', 'PaymentToken', 'PaymentTransaction', 'PaymentTerm'], 'string', 'max' => 255],
            [['Note'], 'string', 'max' => 1000],
            [['CurrencyName'], 'string', 'max' => 11],
            [['ShipDistrict', 'ShipProvince'], 'string', 'max' => 20],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['ManageEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ManageEmployeeId' => 'id']],
            [['ManageOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['ManageOrganizationId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['SystemAccountTransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['SystemAccountTransactionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'InvoiceStatus' => 'Invoice Status',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'CustomerId' => 'Customer ID',
            'TypeInvoice' => 'Type Invoice',
            'BillName' => 'Bill Name',
            'BillEmail' => 'Bill Email',
            'BillPhone' => 'Bill Phone',
            'BillMobilePhone' => 'Bill Mobile Phone',
            'BillAddress' => 'Bill Address',
            'BillZipCode' => 'Bill Zip Code',
            'BillDistrict' => 'Bill District',
            'BillProvince' => 'Bill Province',
            'BillCountry' => 'Bill Country',
            'SuiteNumber' => 'Suite Number',
            'RefOrderNumber' => 'Ref Order Number',
            'RefOrderObjectTypeId' => 'Ref Order Object Type ID',
            'RefOrderTime' => 'Ref Order Time',
            'RefOrderProcessTime' => 'Ref Order Process Time',
            'RefOrderProcessBy' => 'Ref Order Process By',
            'AirwayBillNumber' => 'Airway Bill Number',
            'ShipInBoxes' => 'Ship In Boxes',
            'SizeBoxes' => 'Size Boxes',
            'PackagesConsolidated' => 'Packages Consolidated',
            'DeclarationValue' => 'Declaration Value',
            'BillWeight' => 'Bill Weight',
            'WeightUnit' => 'Weight Unit',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'SystemAccountTransactionId' => 'System Account Transaction ID',
            'LastPaidTime' => 'Last Paid Time',
            'Note' => 'Note',
            'TotalExclTax' => 'Total Excl Tax',
            'InvoiceTax' => 'Invoice Tax',
            'TotalInclTax' => 'Total Incl Tax',
            'CurrencyName' => 'Currency Name',
            'CurrencyRate' => 'Currency Rate',
            'TotalInLocalCurrency' => 'Total In Local Currency',
            'TotalPaidAmount' => 'Total Paid Amount',
            'RemainAmount' => 'Remain Amount',
            'TotalQuantityItems' => 'Total Quantity Items',
            'NumberOfLines' => 'Number Of Lines',
            'ManageEmployeeId' => 'Manage Employee ID',
            'ManageOrganizationId' => 'Manage Organization ID',
            'StoreId' => 'Store ID',
            'SiteId' => 'Site ID',
            'ShipName' => 'Ship Name',
            'ShipEmail' => 'Ship Email',
            'ShipPhone' => 'Ship Phone',
            'ShipMobilePhone' => 'Ship Mobile Phone',
            'ShipAddress' => 'Ship Address',
            'ShipZipCode' => 'Ship Zip Code',
            'ShipDistrict' => 'Ship District',
            'ShipProvince' => 'Ship Province',
            'ShipCountry' => 'Ship Country',
            'DueDate' => 'Due Date',
            'PaymentTerm' => 'Payment Term',
        ];
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'SystemAccountTransactionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['InvoiceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapAuctionInfos()
    {
        return $this->hasMany(InvoiceMapAuctionInfos::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerMemberships()
    {
        return $this->hasMany(InvoiceMapCustomerMembership::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerOthers()
    {
        return $this->hasMany(InvoiceMapCustomerOther::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrders()
    {
        return $this->hasMany(InvoiceMapOrder::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItems()
    {
        return $this->hasMany(InvoiceMapOrderItem::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItemRefunds()
    {
        return $this->hasMany(InvoiceMapOrderItemRefund::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchases()
    {
        return $this->hasMany(InvoiceMapPurchase::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItems()
    {
        return $this->hasMany(InvoiceMapPurchaseItem::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItemRefunds()
    {
        return $this->hasMany(InvoiceMapPurchaseItemRefund::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapRequestShipments()
    {
        return $this->hasMany(InvoiceMapRequestShipment::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipments()
    {
        return $this->hasMany(InvoiceMapShipment::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipmentBulks()
    {
        return $this->hasMany(InvoiceMapShipmentBulk::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShippingProviderOthers()
    {
        return $this->hasMany(InvoiceMapShippingProviderOther::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWahousePackageServices()
    {
        return $this->hasMany(InvoiceMapWahousePackageService::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWarehousePackageItemServices()
    {
        return $this->hasMany(InvoiceMapWarehousePackageItemService::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProformas()
    {
        return $this->hasMany(InvoiceProforma::className(), ['InvoiceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['InvoiceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['InvoiceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['InvoiceId' => 'id']);
    }
}
