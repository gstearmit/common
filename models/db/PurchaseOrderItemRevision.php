<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_revision".
 *
 * @property integer $id
 * @property integer $PurchaseOrderItemId
 * @property integer $Revision
 * @property integer $ProductId
 * @property string $ProductOriginalCode
 * @property string $ProductName
 * @property string $Description
 * @property string $Price
 * @property double $TaxRate
 * @property string $TaxAmount
 * @property string $ShipFeeAmount
 * @property string $CustomFeeAmount
 * @property string $InspectionFee
 * @property double $Weight
 * @property integer $Quantity
 * @property integer $QuantityReceived
 * @property integer $QuantityCancel
 * @property integer $QuantityBill
 * @property string $SubTotalAmount
 * @property string $TotalAmountInLocalCurreny
 * @property string $InspectionTime
 * @property integer $InspectionStatus
 * @property integer $ShippingStatus
 * @property string $TrackingCode
 * @property integer $ReturnStatus
 * @property integer $PackageId
 * @property integer $MerchantId
 * @property integer $IsRequestInspection
 * @property integer $ItemLine
 * @property integer $UnitOfMessureId
 * @property integer $ItemRevision
 * @property string $PromiseComingTime
 * @property string $ActualComingTime
 * @property string $NoteForInspection
 * @property integer $IsCancel
 * @property string $CancelReason
 * @property string $CancelDate
 *
 * @property Product $product
 * @property ShipmentBulk $package
 * @property SystemUnitOfMessure $unitOfMessure
 * @property PurchaseOrderItem $purchaseOrderItem
 */
class PurchaseOrderItemRevision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_revision';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PurchaseOrderItemId', 'Revision', 'ProductId', 'Quantity', 'QuantityReceived', 'QuantityCancel', 'QuantityBill', 'InspectionStatus', 'ShippingStatus', 'ReturnStatus', 'PackageId', 'MerchantId', 'IsRequestInspection', 'ItemLine', 'UnitOfMessureId', 'ItemRevision', 'IsCancel'], 'integer'],
            [['Price', 'TaxRate', 'TaxAmount', 'ShipFeeAmount', 'CustomFeeAmount', 'InspectionFee', 'Weight', 'SubTotalAmount', 'TotalAmountInLocalCurreny'], 'number'],
            [['InspectionTime', 'PromiseComingTime', 'ActualComingTime', 'CancelDate'], 'safe'],
            [['ProductOriginalCode', 'TrackingCode'], 'string', 'max' => 100],
            [['ProductName', 'Description', 'NoteForInspection', 'CancelReason'], 'string', 'max' => 255],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['PackageId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['PackageId' => 'id']],
            [['UnitOfMessureId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['UnitOfMessureId' => 'id']],
            [['PurchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['PurchaseOrderItemId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PurchaseOrderItemId' => 'Purchase Order Item ID',
            'Revision' => 'Revision',
            'ProductId' => 'Product ID',
            'ProductOriginalCode' => 'Product Original Code',
            'ProductName' => 'Product Name',
            'Description' => 'Description',
            'Price' => 'Price',
            'TaxRate' => 'Tax Rate',
            'TaxAmount' => 'Tax Amount',
            'ShipFeeAmount' => 'Ship Fee Amount',
            'CustomFeeAmount' => 'Custom Fee Amount',
            'InspectionFee' => 'Inspection Fee',
            'Weight' => 'Weight',
            'Quantity' => 'Quantity',
            'QuantityReceived' => 'Quantity Received',
            'QuantityCancel' => 'Quantity Cancel',
            'QuantityBill' => 'Quantity Bill',
            'SubTotalAmount' => 'Sub Total Amount',
            'TotalAmountInLocalCurreny' => 'Total Amount In Local Curreny',
            'InspectionTime' => 'Inspection Time',
            'InspectionStatus' => 'Inspection Status',
            'ShippingStatus' => 'Shipping Status',
            'TrackingCode' => 'Tracking Code',
            'ReturnStatus' => 'Return Status',
            'PackageId' => 'Package ID',
            'MerchantId' => 'Merchant ID',
            'IsRequestInspection' => 'Is Request Inspection',
            'ItemLine' => 'Item Line',
            'UnitOfMessureId' => 'Unit Of Messure ID',
            'ItemRevision' => 'Item Revision',
            'PromiseComingTime' => 'Promise Coming Time',
            'ActualComingTime' => 'Actual Coming Time',
            'NoteForInspection' => 'Note For Inspection',
            'IsCancel' => 'Is Cancel',
            'CancelReason' => 'Cancel Reason',
            'CancelDate' => 'Cancel Date',
        ];
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
    public function getPackage()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'PackageId']);
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
    public function getPurchaseOrderItem()
    {
        return $this->hasOne(PurchaseOrderItem::className(), ['id' => 'PurchaseOrderItemId']);
    }
}
