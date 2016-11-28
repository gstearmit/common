<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_item_log".
 *
 * @property integer $id
 * @property integer $warehouse_package_item_id
 * @property integer $EmployeeId
 * @property string $SupportedDate
 * @property string $Description
 *
 * @property OrganizationEmployee $employee
 * @property WarehousePackageItem $warehousePackageItem
 */
class WarehousePackageItemLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_item_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_package_item_id', 'EmployeeId'], 'integer'],
            [['SupportedDate'], 'safe'],
            [['Description'], 'string', 'max' => 1000],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
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
            'warehouse_package_item_id' => 'Warehouse Package Item ID',
            'EmployeeId' => 'Employee ID',
            'SupportedDate' => 'Supported Date',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItem()
    {
        return $this->hasOne(WarehousePackageItem::className(), ['id' => 'warehouse_package_item_id']);
    }
}
