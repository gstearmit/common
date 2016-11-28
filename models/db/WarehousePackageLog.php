<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_log".
 *
 * @property integer $id
 * @property integer $warehouse_package_id
 * @property string $NotedTime
 * @property string $ActivityDescription
 * @property integer $NotedEmployeedId
 * @property string $TrackingCode
 *
 * @property WarehousePackage $warehousePackage
 * @property OrganizationEmployee $notedEmployeed
 */
class WarehousePackageLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_package_id', 'NotedEmployeedId'], 'integer'],
            [['NotedTime'], 'safe'],
            [['ActivityDescription'], 'string', 'max' => 1000],
            [['TrackingCode'], 'string', 'max' => 255],
            [['warehouse_package_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['warehouse_package_id' => 'id']],
            [['NotedEmployeedId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['NotedEmployeedId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_package_id' => 'Warehouse Package ID',
            'NotedTime' => 'Noted Time',
            'ActivityDescription' => 'Activity Description',
            'NotedEmployeedId' => 'Noted Employeed ID',
            'TrackingCode' => 'Tracking Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackage()
    {
        return $this->hasOne(WarehousePackage::className(), ['id' => 'warehouse_package_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotedEmployeed()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'NotedEmployeedId']);
    }
}
