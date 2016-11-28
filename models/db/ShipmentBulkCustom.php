<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_custom".
 *
 * @property integer $id
 * @property string $createdTime
 * @property integer $customEmployeeId
 * @property integer $customGate_id
 * @property integer $aribill_id
 * @property integer $packinglist_id
 * @property string $importedTime
 * @property integer $status
 * @property string $totalFee
 * @property string $invoiceNumber
 *
 * @property ShipmentBulkAttachments[] $shipmentBulkAttachments
 * @property OrganizationEmployee $customEmployee
 * @property ShipmentBulkAirbill $aribill
 * @property ShipmentBulkPackinglist $packinglist
 * @property ShipmentBulkCustomGate $customGate
 */
class ShipmentBulkCustom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_custom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdTime', 'importedTime'], 'safe'],
            [['customEmployeeId', 'customGate_id', 'aribill_id', 'packinglist_id', 'status'], 'integer'],
            [['totalFee'], 'number'],
            [['invoiceNumber'], 'string', 'max' => 50],
            [['customEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['customEmployeeId' => 'id']],
            [['aribill_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkAirbill::className(), 'targetAttribute' => ['aribill_id' => 'id']],
            [['packinglist_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkPackinglist::className(), 'targetAttribute' => ['packinglist_id' => 'id']],
            [['customGate_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkCustomGate::className(), 'targetAttribute' => ['customGate_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createdTime' => 'Created Time',
            'customEmployeeId' => 'Custom Employee ID',
            'customGate_id' => 'Custom Gate ID',
            'aribill_id' => 'Aribill ID',
            'packinglist_id' => 'Packinglist ID',
            'importedTime' => 'Imported Time',
            'status' => 'Status',
            'totalFee' => 'Total Fee',
            'invoiceNumber' => 'Invoice Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAttachments()
    {
        return $this->hasMany(ShipmentBulkAttachments::className(), ['ShipmentBulkCustomId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'customEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAribill()
    {
        return $this->hasOne(ShipmentBulkAirbill::className(), ['id' => 'aribill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackinglist()
    {
        return $this->hasOne(ShipmentBulkPackinglist::className(), ['id' => 'packinglist_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomGate()
    {
        return $this->hasOne(ShipmentBulkCustomGate::className(), ['id' => 'customGate_id']);
    }
}
