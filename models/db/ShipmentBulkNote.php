<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_note".
 *
 * @property integer $id
 * @property string $CreatedTime
 * @property integer $EmployeeId
 * @property string $Note
 * @property integer $shipment_bulk_id
 *
 * @property OrganizationEmployee $employee
 * @property ShipmentBulk $shipmentBulk
 */
class ShipmentBulkNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime'], 'safe'],
            [['EmployeeId', 'shipment_bulk_id'], 'integer'],
            [['Note'], 'string', 'max' => 1000],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
            [['shipment_bulk_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulk::className(), 'targetAttribute' => ['shipment_bulk_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CreatedTime' => 'Created Time',
            'EmployeeId' => 'Employee ID',
            'Note' => 'Note',
            'shipment_bulk_id' => 'Shipment Bulk ID',
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
    public function getShipmentBulk()
    {
        return $this->hasOne(ShipmentBulk::className(), ['id' => 'shipment_bulk_id']);
    }
}
