<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_account_transaction".
 *
 * @property integer $id
 * @property integer $SystemAccountId
 * @property string $TransactionCode
 * @property string $Note
 * @property string $CreatedDate
 * @property string $CreditAmountInLocalCurrency
 * @property string $DebitAmountInLocalCurrency
 * @property integer $PaymentMethodProviderId
 * @property integer $OrderRefId
 * @property integer $PurchaseOrderRefId
 * @property string $OrderInvoiceNumber
 * @property string $PurchaseOrderInvoiceNumber
 * @property integer $TypeTransaction
 * @property integer $Status
 * @property integer $CustomerId
 * @property integer $CheckByEmployeeId
 * @property string $CheckDate
 * @property integer $CurrencyId
 * @property double $CurrencyRate
 * @property string $OriginalAmount
 *
 * @property Invoice[] $invoices
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
 * @property OrganizationEmployee $checkByEmployee
 * @property SystemCurrency $currency
 * @property Customer $customer
 * @property PaymentMethodProvider $paymentMethodProvider
 * @property Order $orderRef
 * @property PurchaseOrder $purchaseOrderRef
 * @property SystemAccount $systemAccount
 * @property SystemAccountTransactionVoucher[] $systemAccountTransactionVouchers
 */
class SystemAccountTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_account_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SystemAccountId', 'PaymentMethodProviderId', 'OrderRefId', 'PurchaseOrderRefId', 'TypeTransaction', 'Status', 'CustomerId', 'CheckByEmployeeId', 'CurrencyId'], 'integer'],
            [['CreatedDate', 'CheckDate'], 'safe'],
            [['CreditAmountInLocalCurrency', 'DebitAmountInLocalCurrency', 'CurrencyRate', 'OriginalAmount'], 'number'],
            [['TransactionCode', 'OrderInvoiceNumber', 'PurchaseOrderInvoiceNumber'], 'string', 'max' => 50],
            [['Note'], 'string', 'max' => 300],
            [['CheckByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CheckByEmployeeId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['PaymentMethodProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentMethodProvider::className(), 'targetAttribute' => ['PaymentMethodProviderId' => 'id']],
            [['OrderRefId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderRefId' => 'id']],
            [['PurchaseOrderRefId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['PurchaseOrderRefId' => 'id']],
            [['SystemAccountId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccount::className(), 'targetAttribute' => ['SystemAccountId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'SystemAccountId' => 'System Account ID',
            'TransactionCode' => 'Transaction Code',
            'Note' => 'Note',
            'CreatedDate' => 'Created Date',
            'CreditAmountInLocalCurrency' => 'Credit Amount In Local Currency',
            'DebitAmountInLocalCurrency' => 'Debit Amount In Local Currency',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'OrderRefId' => 'Order Ref ID',
            'PurchaseOrderRefId' => 'Purchase Order Ref ID',
            'OrderInvoiceNumber' => 'Order Invoice Number',
            'PurchaseOrderInvoiceNumber' => 'Purchase Order Invoice Number',
            'TypeTransaction' => 'Type Transaction',
            'Status' => 'Status',
            'CustomerId' => 'Customer ID',
            'CheckByEmployeeId' => 'Check By Employee ID',
            'CheckDate' => 'Check Date',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'OriginalAmount' => 'Original Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['SystemAccountTransactionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerMemberships()
    {
        return $this->hasMany(InvoiceMapCustomerMembership::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerOthers()
    {
        return $this->hasMany(InvoiceMapCustomerOther::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrders()
    {
        return $this->hasMany(InvoiceMapOrder::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItems()
    {
        return $this->hasMany(InvoiceMapOrderItem::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItemRefunds()
    {
        return $this->hasMany(InvoiceMapOrderItemRefund::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchases()
    {
        return $this->hasMany(InvoiceMapPurchase::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItems()
    {
        return $this->hasMany(InvoiceMapPurchaseItem::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapPurchaseItemRefunds()
    {
        return $this->hasMany(InvoiceMapPurchaseItemRefund::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapRequestShipments()
    {
        return $this->hasMany(InvoiceMapRequestShipment::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipments()
    {
        return $this->hasMany(InvoiceMapShipment::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShipmentBulks()
    {
        return $this->hasMany(InvoiceMapShipmentBulk::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapShippingProviderOthers()
    {
        return $this->hasMany(InvoiceMapShippingProviderOther::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWahousePackageServices()
    {
        return $this->hasMany(InvoiceMapWahousePackageService::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWarehousePackageItemServices()
    {
        return $this->hasMany(InvoiceMapWarehousePackageItemService::className(), ['system_account_transaction_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CheckByEmployeeId']);
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodProvider()
    {
        return $this->hasOne(PaymentMethodProvider::className(), ['id' => 'PaymentMethodProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRef()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderRefId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderRef()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'PurchaseOrderRefId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccount()
    {
        return $this->hasOne(SystemAccount::className(), ['id' => 'SystemAccountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVouchers()
    {
        return $this->hasMany(SystemAccountTransactionVoucher::className(), ['SystemAccountTransactionId' => 'id']);
    }
}
