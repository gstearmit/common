<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_log".
 *
 * @property integer $id
 * @property string $CreateTime
 * @property string $Description
 * @property string $Status
 * @property string $EmployeeId
 * @property string $EmployeeName
 * @property integer $TotalQuantityPackages
 * @property string $TotalWeightPackages
 * @property integer $TotalInputPackages
 * @property integer $TotalOutputPackages
 * @property integer $TotalPackagesNoTrackingNotDefine
 * @property integer $TotalPackagesBroken
 * @property integer $TotalPackagesCanNotDelivery
 * @property integer $TotalPackagesDelivered
 * @property integer $ShipmentBulkId
 *
 * @property ShipmentBulk $shipmentBulk
 */
class ShipmentBulkLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime'], 'safe'],
            [['TotalQuantityPackages', 'TotalInputPackages', 'TotalOutputPackages', 'TotalPackagesNoTrackingNotDefine', 'TotalPackagesBroken', 'TotalPackagesCanNotDelivery', 'TotalPackagesDelivered', 'ShipmentBulkId'], 'integer'],
            [['TotalWeightPackages'], 'number'],
            [['Description'], 'string', 'max' => 500],
            [['Status'], 'string', 'max' => 250],
            [['EmployeeId', 'EmployeeName'], 'string', 'max' => 50],
            [['ShipmentBulkId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['ShipmentBulkId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CreateTime' => 'Create Time',
            'Description' => 'Description',
            'Status' => 'Status',
            'EmployeeId' => 'Employee ID',
            'EmployeeName' => 'Employee Name',
            'TotalQuantityPackages' => 'Total Quantity Packages',
            'TotalWeightPackages' => 'Total Weight Packages',
            'TotalInputPackages' => 'Total Input Packages',
            'TotalOutputPackages' => 'Total Output Packages',
            'TotalPackagesNoTrackingNotDefine' => 'Total Packages No Tracking Not Define',
            'TotalPackagesBroken' => 'Total Packages Broken',
            'TotalPackagesCanNotDelivery' => 'Total Packages Can Not Delivery',
            'TotalPackagesDelivered' => 'Total Packages Delivered',
            'ShipmentBulkId' => 'Shipment Bulk ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'ShipmentBulkId']);
    }
}
