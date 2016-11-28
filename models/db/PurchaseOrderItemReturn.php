<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_return".
 *
 * @property integer $id
 * @property integer $WarehousePackageReturnId
 * @property integer $PurchaseOrderItemId
 * @property integer $Quantity
 * @property string $description
 *
 * @property PurchaseOrderItem $purchaseOrderItem
 * @property WarehousePackageReturn $warehousePackageReturn
 */
class PurchaseOrderItemReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WarehousePackageReturnId', 'PurchaseOrderItemId', 'Quantity'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['PurchaseOrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItem::className(), 'targetAttribute' => ['PurchaseOrderItemId' => 'id']],
            [['WarehousePackageReturnId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageReturn::className(), 'targetAttribute' => ['WarehousePackageReturnId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'WarehousePackageReturnId' => 'Warehouse Package Return ID',
            'PurchaseOrderItemId' => 'Purchase Order Item ID',
            'Quantity' => 'Quantity',
            'description' => 'Description',
        ];
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
    public function getWarehousePackageReturn()
    {
        return $this->hasOne(WarehousePackageReturn::className(), ['id' => 'WarehousePackageReturnId']);
    }
}
