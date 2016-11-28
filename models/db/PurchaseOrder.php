<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property integer $id
 * @property string $PurchaseOrderNumber
 * @property string $Description
 * @property string $OrderTime
 * @property integer $TotalItemOrder
 * @property string $TransactionCode
 * @property integer $PaymentMethodId
 * @property string $PaymentTime
 * @property integer $PaymentCardId
 * @property string $EstimatedComingDate
 * @property integer $CurrencyId
 * @property string $TotalOrderExcludeTax
 * @property string $ShippingFee
 * @property string $TotalOrder
 * @property string $TotalOrderInLocalCurrency
 * @property string $TotalOrderConvertedToLocalCurrencyByPaypal
 * @property integer $Status
 * @property integer $StoreId
 * @property integer $siteId
 * @property integer $BillToOrganizationId
 * @property integer $BillByOrganizationId
 * @property string $CurrencyRate
 * @property integer $BuyerEmployeeId
 * @property integer $IsRequestInspection
 * @property integer $WarehouseId
 * @property integer $Revision
 * @property string $LastUpdateTime
 * @property string $TrackingCode
 * @property string $PurchaseOrderCode
 * @property string $PaypalAmount
 * @property integer $viaChannelId
 * @property string $MerchantEmail
 * @property integer $isNoTrackingCode
 * @property integer $WarehouseLocalId
 * @property integer $ShippingProviderId
 *
 * @property InvoiceMapPurchase[] $invoiceMapPurchases
 * @property PurchasePaymentCard $paymentCard
 * @property Warehouse $warehouseLocal
 * @property ShippingProvider $shippingProvider
 * @property Store $store
 * @property Site $site
 * @property SystemCurrency $currency
 * @property PaymentMethod $paymentMethod
 * @property Warehouse $warehouse
 * @property Organization $billToOrganization
 * @property Organization $billByOrganization
 * @property OrganizationEmployee $buyerEmployee
 * @property PurchaseOrderItem[] $purchaseOrderItems
 * @property PurchaseOrderNote[] $purchaseOrderNotes
 * @property SystemAccountTransaction[] $systemAccountTransactions
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderTime', 'PaymentTime', 'EstimatedComingDate', 'LastUpdateTime'], 'safe'],
            [['TotalItemOrder', 'PaymentMethodId', 'PaymentCardId', 'CurrencyId', 'Status', 'StoreId', 'siteId', 'BillToOrganizationId', 'BillByOrganizationId', 'BuyerEmployeeId', 'IsRequestInspection', 'WarehouseId', 'Revision', 'viaChannelId', 'isNoTrackingCode', 'WarehouseLocalId', 'ShippingProviderId'], 'integer'],
            [['TotalOrderExcludeTax', 'ShippingFee', 'TotalOrder', 'TotalOrderInLocalCurrency', 'TotalOrderConvertedToLocalCurrencyByPaypal', 'CurrencyRate', 'PaypalAmount'], 'number'],
            [['PurchaseOrderNumber', 'Description', 'TrackingCode', 'MerchantEmail'], 'string', 'max' => 255],
            [['TransactionCode'], 'string', 'max' => 50],
            [['PurchaseOrderCode'], 'string', 'max' => 100],
            [['PaymentCardId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchasePaymentCard::className(), 'targetAttribute' => ['PaymentCardId' => 'id']],
            [['WarehouseLocalId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseLocalId' => 'id']],
            [['ShippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['ShippingProviderId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['PaymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethod::className(), 'targetAttribute' => ['PaymentMethodId' => 'id']],
            [['WarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseId' => 'id']],
            [['BillToOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['BillToOrganizationId' => 'id']],
            [['BillByOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['BillByOrganizationId' => 'id']],
            [['BuyerEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['BuyerEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PurchaseOrderNumber' => 'Purchase Order Number',
            'Description' => 'Description',
            'OrderTime' => 'Order Time',
            'TotalItemOrder' => 'Total Item Order',
            'TransactionCode' => 'Transaction Code',
            'PaymentMethodId' => 'Payment Method ID',
            'PaymentTime' => 'Payment Time',
            'PaymentCardId' => 'Payment Card ID',
            'EstimatedComingDate' => 'Estimated Coming Date',
            'CurrencyId' => 'Currency ID',
            'TotalOrderExcludeTax' => 'Total Order Exclude Tax',
            'ShippingFee' => 'Shipping Fee',
            'TotalOrder' => 'Total Order',
            'TotalOrderInLocalCurrency' => 'Total Order In Local Currency',
            'TotalOrderConvertedToLocalCurrencyByPaypal' => 'Total Order Converted To Local Currency By Paypal',
            'Status' => 'Status',
            'StoreId' => 'Store ID',
            'siteId' => 'Site ID',
            'BillToOrganizationId' => 'Bill To Organization ID',
            'BillByOrganizationId' => 'Bill By Organization ID',
            'CurrencyRate' => 'Currency Rate',
            'BuyerEmployeeId' => 'Buyer Employee ID',
            'IsRequestInspection' => 'Is Request Inspection',
            'WarehouseId' => 'Warehouse ID',
            'Revision' => 'Revision',
            'LastUpdateTime' => 'Last Update Time',
            'TrackingCode' => 'Tracking Code',
            'PurchaseOrderCode' => 'Purchase Order Code',
            'PaypalAmount' => 'Paypal Amount',
            'viaChannelId' => 'Via Channel ID',
            'MerchantEmail' => 'Merchant Email',
            'isNoTrackingCode' => 'Is No Tracking Code',
            'WarehouseLocalId' => 'Warehouse Local ID',
            'ShippingProviderId' => 'Shipping Provider ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchases()
    {
        return $this->hasMany(InvoiceMapPurchase::className(), ['purchase_order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentCard()
    {
        return $this->hasOne(PurchasePaymentCard::className(), ['id' => 'PaymentCardId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocal()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseLocalId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'ShippingProviderId']);
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
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
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethod::className(), ['id' => 'PaymentMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillToOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'BillToOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillByOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'BillByOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyerEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'BuyerEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::className(), ['PurchaseOrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderNotes()
    {
        return $this->hasMany(PurchaseOrderNote::className(), ['PurchaseOrderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['PurchaseOrderRefId' => 'id']);
    }
}
