<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_unit_of_messure".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property integer $DisplayOrder
 *
 * @property CategoryCustomPolicy[] $categoryCustomPolicies
 * @property CategoryServicePolicy[] $categoryServicePolicies
 * @property OrderItem[] $orderItems
 * @property PosOrderRequestItems[] $posOrderRequestItems
 * @property PurchaseOrderItem[] $purchaseOrderItems
 * @property PurchaseOrderItemRevision[] $purchaseOrderItemRevisions
 * @property ShipmentBulkAirbill[] $shipmentBulkAirbills
 * @property ShipmentBulkAirbillCategoryMapping[] $shipmentBulkAirbillCategoryMappings
 * @property ShipmentBulkBox[] $shipmentBulkBoxes
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property WarehouseLocationBox[] $warehouseLocationBoxes
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class SystemUnitOfMessure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_unit_of_messure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DisplayOrder'], 'integer'],
            [['Name', 'SystemKeyword'], 'string', 'max' => 100],
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
            'SystemKeyword' => 'System Keyword',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicies()
    {
        return $this->hasMany(CategoryCustomPolicy::className(), ['SystemUnitMeasureId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryServicePolicies()
    {
        return $this->hasMany(CategoryServicePolicy::className(), ['system_unit_messure_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['UnitOfMessureId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItems()
    {
        return $this->hasMany(PosOrderRequestItems::className(), ['SystemUomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::className(), ['UnitOfMessureId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRevisions()
    {
        return $this->hasMany(PurchaseOrderItemRevision::className(), ['UnitOfMessureId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbills()
    {
        return $this->hasMany(ShipmentBulkAirbill::className(), ['UomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbillCategoryMappings()
    {
        return $this->hasMany(ShipmentBulkAirbillCategoryMapping::className(), ['UomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkBoxes()
    {
        return $this->hasMany(ShipmentBulkBox::className(), ['UomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseLocationBoxes()
    {
        return $this->hasMany(WarehouseLocationBox::className(), ['UomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['uom_id' => 'id']);
    }
}
