<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_return_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $DisplayOrder
 *
 * @property WarehousePackageReturn[] $warehousePackageReturns
 */
class PurchaseOrderItemReturnType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_return_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'DisplayOrder'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['Description'], 'string', 'max' => 255],
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
            'Description' => 'Description',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageReturns()
    {
        return $this->hasMany(WarehousePackageReturn::className(), ['reasonReturnTypeId' => 'id']);
    }
}
