<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_currency".
 *
 * @property integer $id
 * @property string $Name
 * @property string $CurrencyCode
 * @property string $CustomFormatting
 * @property integer $Published
 * @property integer $DisplayOrder
 * @property string $CreatedTime
 * @property string $UpdatedTime
 * @property string $Symbol
 * @property integer $SymbolPosition
 *
 * @property CategoryCustomPolicy[] $categoryCustomPolicies
 * @property CategoryPricePolicyWeightSetting[] $categoryPricePolicyWeightSettings
 * @property InvoiceItem[] $invoiceItems
 * @property InvoiceItemProforma[] $invoiceItemProformas
 * @property MembershipPackages[] $membershipPackages
 * @property Order[] $orders
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderItem[] $orderItems
 * @property OrderService[] $orderServices
 * @property PosOrderRequestItems[] $posOrderRequestItems
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 * @property PosOrderRequestServices[] $posOrderRequestServices
 * @property PurchaseOrder[] $purchaseOrders
 * @property RequestPackages[] $requestPackages
 * @property RequestPackagesItems[] $requestPackagesItems
 * @property RequestShipment[] $requestShipments
 * @property RequestShipmentService[] $requestShipmentServices
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShipmentBulkAirbill[] $shipmentBulkAirbills
 * @property ShipmentBulkBox[] $shipmentBulkBoxes
 * @property ShipmentBulkExpense[] $shipmentBulkExpenses
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property Site[] $sites
 * @property Store[] $stores
 * @property SystemAccountTransaction[] $systemAccountTransactions
 * @property SystemCurrencyRate[] $systemCurrencyRates
 * @property SystemCurrencyRate[] $systemCurrencyRates0
 * @property Transaction[] $transactions
 * @property TransactionExternal[] $transactionExternals
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionRefundDelegate[] $transactionRefundDelegates
 * @property TransactionRequest[] $transactionRequests
 * @property Warehouse[] $warehouses
 * @property WarehouseLocationBox[] $warehouseLocationBoxes
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackageItem[] $warehousePackageItems
 * @property WarehousePackageService[] $warehousePackageServices
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class SystemCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Published', 'DisplayOrder', 'SymbolPosition'], 'integer'],
            [['CreatedTime', 'UpdatedTime'], 'safe'],
            [['Name', 'CustomFormatting'], 'string', 'max' => 50],
            [['CurrencyCode', 'Symbol'], 'string', 'max' => 5],
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
            'CurrencyCode' => 'Currency Code',
            'CustomFormatting' => 'Custom Formatting',
            'Published' => 'Published',
            'DisplayOrder' => 'Display Order',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
            'Symbol' => 'Symbol',
            'SymbolPosition' => 'Symbol Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicies()
    {
        return $this->hasMany(CategoryCustomPolicy::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicyWeightSettings()
    {
        return $this->hasMany(CategoryPricePolicyWeightSetting::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItemProformas()
    {
        return $this->hasMany(InvoiceItemProforma::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackages()
    {
        return $this->hasMany(MembershipPackages::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['currencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItems()
    {
        return $this->hasMany(PosOrderRequestItems::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasMany(RequestPackages::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackagesItems()
    {
        return $this->hasMany(RequestPackagesItems::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbills()
    {
        return $this->hasMany(ShipmentBulkAirbill::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBoxes()
    {
        return $this->hasMany(ShipmentBulkBox::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkExpenses()
    {
        return $this->hasMany(ShipmentBulkExpense::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['system_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSites()
    {
        return $this->hasMany(Site::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCurrencyRates()
    {
        return $this->hasMany(SystemCurrencyRate::className(), ['CurrencyFromId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCurrencyRates0()
    {
        return $this->hasMany(SystemCurrencyRate::className(), ['CurrencyToId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternals()
    {
        return $this->hasMany(TransactionExternal::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRefundDelegates()
    {
        return $this->hasMany(TransactionRefundDelegate::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocationBoxes()
    {
        return $this->hasMany(WarehouseLocationBox::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServices()
    {
        return $this->hasMany(WarehousePackageService::className(), ['CurrencyId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['system_currency_id' => 'id']);
    }
}
