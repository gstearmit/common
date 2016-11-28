<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $itemCategoryId
 * @property string $sku
 * @property string $link
 * @property string $Name
 * @property string $sellerId
 * @property integer $quantity
 * @property integer $maxQuantity
 * @property double $weight
 * @property string $note
 * @property string $specifics
 * @property string $description
 * @property string $image
 * @property string $sourceId
 * @property integer $orderId
 * @property string $ParentSku
 * @property integer $ProductId
 * @property string $PriceInclTax
 * @property string $PriceExclTax
 * @property string $DiscountPercentInclTax
 * @property string $DiscountAmountInclTax
 * @property string $UnitPriceInclTax
 * @property string $UnitPriceExclTax
 * @property string $ItemWeight
 * @property string $ItemSubtotalExclTax
 * @property string $ItemTaxRate
 * @property string $ItemTax
 * @property string $ItemSubtotalInclTax
 * @property string $ItemLocalShippingAmount
 * @property string $ItemInternationalShippingAmount
 * @property string $ItemDomesticShippingAmount
 * @property string $ItemServiceRate
 * @property string $ItemFeeServiceAmount
 * @property string $ItemCustomFee
 * @property string $ItemCustomAdditionFee
 * @property string $PaymentAdditionalFeeInclTax
 * @property string $AdditionFeeAmount
 * @property string $AdditionFeeLocalAmount
 * @property string $AdditionFeePaidAmount
 * @property string $AdditionFeeNote
 * @property string $AdditionFeeConfirmedDate
 * @property integer $AdditionFeeFreferPaymentMethod
 * @property integer $AdditionConfirmedByEmployeeId
 * @property integer $AdditionFeeConfirmedByCustomerStatus
 * @property string $OrderItemTotal
 * @property string $OrderItemTotalDisplay
 * @property double $ExRate
 * @property string $TotalAmountInLocalCurrency
 * @property string $TotalAmountInLocalCurrencyDisplay
 * @property integer $RefundedStatus
 * @property string $RefundedAmount
 * @property string $PurchaseOrderNumber
 * @property integer $TrackingShipingId
 * @property integer $WarehouseId
 * @property integer $PurchaseOrderItemId
 * @property integer $ShippingStatus
 * @property integer $IsRequestInspection
 * @property integer $UnitOfMessureId
 * @property integer $AdditionFeeRequestStatus
 * @property integer $CustomerId
 * @property integer $Type
 * @property string $Quotation_Note
 * @property string $Quotation_Time
 * @property integer $Quotation_Supporter
 * @property integer $purchaseConfirm
 * @property integer $siteId
 * @property string $refundedPaidAmount
 * @property string $itemEndTime
 * @property integer $purchaseFailStatus
 * @property string $purchaseFailReason
 * @property string $totalItemPoint
 * @property integer $currencyId
 * @property string $AdditionFeeTotalLocalAmount
 * @property string $AdditionFeePaidLocalAmount
 * @property integer $ApproveStatus
 * @property string $ApproveNote
 * @property string $ApproveTime
 * @property integer $NumberOfRefund
 * @property integer $IsClaim
 *
 * @property CustomerHelpdesk[] $customerHelpdesks
 * @property InvoiceMapOrderItem[] $invoiceMapOrderItems
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property Order $order
 * @property Product $product
 * @property Warehouse $warehouse
 * @property PurchaseOrderItem $purchaseOrderItem
 * @property SystemUnitOfMessure $unitOfMessure
 * @property Customer $customer
 * @property OrganizationEmployee $quotationSupporter
 * @property Site $site
 * @property SystemCurrency $currency
 * @property OrderItemFeeService[] $orderItemFeeServices
 * @property OrderItemRefund[] $orderItemRefunds
 * @property OrderItemTracking[] $orderItemTrackings
 * @property OrderServiceDetailPackage[] $orderServiceDetailPackages
 * @property ShippingLog[] $shippingLogs
 * @property WarehousePackageItem[] $warehousePackageItems
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemCategoryId', 'quantity', 'maxQuantity', 'orderId', 'ProductId', 'AdditionFeeFreferPaymentMethod', 'AdditionConfirmedByEmployeeId', 'AdditionFeeConfirmedByCustomerStatus', 'RefundedStatus', 'TrackingShipingId', 'WarehouseId', 'PurchaseOrderItemId', 'ShippingStatus', 'IsRequestInspection', 'UnitOfMessureId', 'AdditionFeeRequestStatus', 'CustomerId', 'Type', 'Quotation_Supporter', 'purchaseConfirm', 'siteId', 'purchaseFailStatus', 'currencyId', 'ApproveStatus', 'NumberOfRefund', 'IsClaim'], 'integer'],
            [['weight', 'PriceInclTax', 'PriceExclTax', 'DiscountPercentInclTax', 'DiscountAmountInclTax', 'UnitPriceInclTax', 'UnitPriceExclTax', 'ItemWeight', 'ItemSubtotalExclTax', 'ItemTaxRate', 'ItemTax', 'ItemSubtotalInclTax', 'ItemLocalShippingAmount', 'ItemInternationalShippingAmount', 'ItemDomesticShippingAmount', 'ItemServiceRate', 'ItemFeeServiceAmount', 'ItemCustomFee', 'ItemCustomAdditionFee', 'PaymentAdditionalFeeInclTax', 'AdditionFeeAmount', 'AdditionFeeLocalAmount', 'AdditionFeePaidAmount', 'OrderItemTotal', 'OrderItemTotalDisplay', 'ExRate', 'TotalAmountInLocalCurrency', 'TotalAmountInLocalCurrencyDisplay', 'RefundedAmount', 'refundedPaidAmount', 'totalItemPoint', 'AdditionFeeTotalLocalAmount', 'AdditionFeePaidLocalAmount'], 'number'],
            [['image'], 'string'],
            [['AdditionFeeConfirmedDate', 'Quotation_Time', 'itemEndTime', 'ApproveTime'], 'safe'],
            [['sku', 'ParentSku', 'PurchaseOrderNumber'], 'string', 'max' => 50],
            [['link', 'Name', 'sourceId'], 'string', 'max' => 500],
            [['sellerId', 'note', 'specifics', 'description', 'AdditionFeeNote', 'Quotation_Note', 'purchaseFailReason', 'ApproveNote'], 'string', 'max' => 255],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['WarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseId' => 'id']],
            [['PurchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['PurchaseOrderItemId' => 'id']],
            [['UnitOfMessureId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UnitOfMessureId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['Quotation_Supporter'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['Quotation_Supporter' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['currencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['currencyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemCategoryId' => 'Item Category ID',
            'sku' => 'Sku',
            'link' => 'Link',
            'Name' => 'Name',
            'sellerId' => 'Seller ID',
            'quantity' => 'Quantity',
            'maxQuantity' => 'Max Quantity',
            'weight' => 'Weight',
            'note' => 'Note',
            'specifics' => 'Specifics',
            'description' => 'Description',
            'image' => 'Image',
            'sourceId' => 'Source ID',
            'orderId' => 'Order ID',
            'ParentSku' => 'Parent Sku',
            'ProductId' => 'Product ID',
            'PriceInclTax' => 'Price Incl Tax',
            'PriceExclTax' => 'Price Excl Tax',
            'DiscountPercentInclTax' => 'Discount Percent Incl Tax',
            'DiscountAmountInclTax' => 'Discount Amount Incl Tax',
            'UnitPriceInclTax' => 'Unit Price Incl Tax',
            'UnitPriceExclTax' => 'Unit Price Excl Tax',
            'ItemWeight' => 'Item Weight',
            'ItemSubtotalExclTax' => 'Item Subtotal Excl Tax',
            'ItemTaxRate' => 'Item Tax Rate',
            'ItemTax' => 'Item Tax',
            'ItemSubtotalInclTax' => 'Item Subtotal Incl Tax',
            'ItemLocalShippingAmount' => 'Item Local Shipping Amount',
            'ItemInternationalShippingAmount' => 'Item International Shipping Amount',
            'ItemDomesticShippingAmount' => 'Item Domestic Shipping Amount',
            'ItemServiceRate' => 'Item Service Rate',
            'ItemFeeServiceAmount' => 'Item Fee Service Amount',
            'ItemCustomFee' => 'Item Custom Fee',
            'ItemCustomAdditionFee' => 'Item Custom Addition Fee',
            'PaymentAdditionalFeeInclTax' => 'Payment Additional Fee Incl Tax',
            'AdditionFeeAmount' => 'Addition Fee Amount',
            'AdditionFeeLocalAmount' => 'Addition Fee Local Amount',
            'AdditionFeePaidAmount' => 'Addition Fee Paid Amount',
            'AdditionFeeNote' => 'Addition Fee Note',
            'AdditionFeeConfirmedDate' => 'Addition Fee Confirmed Date',
            'AdditionFeeFreferPaymentMethod' => 'Addition Fee Frefer Payment Method',
            'AdditionConfirmedByEmployeeId' => 'Addition Confirmed By Employee ID',
            'AdditionFeeConfirmedByCustomerStatus' => 'Addition Fee Confirmed By Customer Status',
            'OrderItemTotal' => 'Order Item Total',
            'OrderItemTotalDisplay' => 'Order Item Total Display',
            'ExRate' => 'Ex Rate',
            'TotalAmountInLocalCurrency' => 'Total Amount In Local Currency',
            'TotalAmountInLocalCurrencyDisplay' => 'Total Amount In Local Currency Display',
            'RefundedStatus' => 'Refunded Status',
            'RefundedAmount' => 'Refunded Amount',
            'PurchaseOrderNumber' => 'Purchase Order Number',
            'TrackingShipingId' => 'Tracking Shiping ID',
            'WarehouseId' => 'Warehouse ID',
            'PurchaseOrderItemId' => 'Purchase Order Item ID',
            'ShippingStatus' => 'Shipping Status',
            'IsRequestInspection' => 'Is Request Inspection',
            'UnitOfMessureId' => 'Unit Of Messure ID',
            'AdditionFeeRequestStatus' => 'Addition Fee Request Status',
            'CustomerId' => 'Customer ID',
            'Type' => 'Type',
            'Quotation_Note' => 'Quotation  Note',
            'Quotation_Time' => 'Quotation  Time',
            'Quotation_Supporter' => 'Quotation  Supporter',
            'purchaseConfirm' => 'Purchase Confirm',
            'siteId' => 'Site ID',
            'refundedPaidAmount' => 'Refunded Paid Amount',
            'itemEndTime' => 'Item End Time',
            'purchaseFailStatus' => 'Purchase Fail Status',
            'purchaseFailReason' => 'Purchase Fail Reason',
            'totalItemPoint' => 'Total Item Point',
            'currencyId' => 'Currency ID',
            'AdditionFeeTotalLocalAmount' => 'Addition Fee Total Local Amount',
            'AdditionFeePaidLocalAmount' => 'Addition Fee Paid Local Amount',
            'ApproveStatus' => 'Approve Status',
            'ApproveNote' => 'Approve Note',
            'ApproveTime' => 'Approve Time',
            'NumberOfRefund' => 'Number Of Refund',
            'IsClaim' => 'Is Claim',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['orderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapOrderItems()
    {
        return $this->hasMany(InvoiceMapOrderItem::className(), ['order_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['OrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'ProductId']);
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
    public function getPurchaseOrderItem()
    {
        return $this->hasOne(PurchaseOrderItem::className(), ['id' => 'PurchaseOrderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitOfMessure()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'UnitOfMessureId']);
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
    public function getQuotationSupporter()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'Quotation_Supporter']);
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
        return $this->hasOne(SystemCurrency::className(), ['id' => 'currencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemFeeServices()
    {
        return $this->hasMany(OrderItemFeeService::className(), ['order_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['OrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemTrackings()
    {
        return $this->hasMany(OrderItemTracking::className(), ['orderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServiceDetailPackages()
    {
        return $this->hasMany(OrderServiceDetailPackage::className(), ['order_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingLogs()
    {
        return $this->hasMany(ShippingLog::className(), ['OrderItemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['orderItemId' => 'id']);
    }
}
