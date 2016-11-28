<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_log".
 *
 * @property integer $id
 * @property string $CreateTime
 * @property string $Description
 * @property string $Note
 * @property integer $EmployeeId
 * @property string $EmployeeName
 * @property integer $ShipmentId
 *
 * @property Shipment $shipment
 * @property OrganizationEmployee $employee
 */
class ShipmentLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateTime'], 'safe'],
            [['EmployeeId', 'ShipmentId'], 'integer'],
            [['Description'], 'string', 'max' => 500],
            [['Note'], 'string', 'max' => 1000],
            [['EmployeeName'], 'string', 'max' => 50],
            [['ShipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['ShipmentId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
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
            'Note' => 'Note',
            'EmployeeId' => 'Employee ID',
            'EmployeeName' => 'Employee Name',
            'ShipmentId' => 'Shipment ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'ShipmentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }
}
