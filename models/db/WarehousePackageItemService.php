<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_item_service".
 *
 * @property integer $id
 * @property integer $warehouse_option_group_id
 * @property integer $warehouse_option_setting_id
 * @property integer $warehouse_package_item_id
 * @property string $created_time
 * @property string $fee_charged
 *
 * @property InvoiceMapWarehousePackageItemService[] $invoiceMapWarehousePackageItemServices
 * @property WarehousePackageSetting $warehouseOptionGroup
 * @property WarehousePackageSettingGroup $warehouseOptionSetting
 * @property WarehousePackageItem $warehousePackageItem
 */
class WarehousePackageItemService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_item_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_option_group_id', 'warehouse_option_setting_id', 'warehouse_package_item_id'], 'integer'],
            [['created_time'], 'safe'],
            [['fee_charged'], 'number'],
            [['warehouse_option_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['warehouse_option_group_id' => 'id']],
            [['warehouse_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingGroup::className(), 'targetAttribute' => ['warehouse_option_setting_id' => 'id']],
            [['warehouse_package_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageItem::className(), 'targetAttribute' => ['warehouse_package_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_option_group_id' => 'Warehouse Option Group ID',
            'warehouse_option_setting_id' => 'Warehouse Option Setting ID',
            'warehouse_package_item_id' => 'Warehouse Package Item ID',
            'created_time' => 'Created Time',
            'fee_charged' => 'Fee Charged',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWarehousePackageItemServices()
    {
        return $this->hasMany(InvoiceMapWarehousePackageItemService::className(), ['warehouse_package_item_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionGroup()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'warehouse_option_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionSetting()
    {
        return $this->hasOne(WarehousePackageSettingGroup::className(), ['id' => 'warehouse_option_setting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItem()
    {
        return $this->hasOne(WarehousePackageItem::className(), ['id' => 'warehouse_package_item_id']);
    }
}
