<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_tracking".
 *
 * @property integer $id
 * @property string $ActivityTime
 * @property integer $ShippingPackageLocalId
 * @property integer $ShipmentId
 * @property string $ActivityStatus
 * @property string $Note
 * @property string $ActivityBy
 *
 * @property Shipment $shipment
 * @property ShippingPackageLocal $shippingPackageLocal
 */
class ShipmentTracking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_tracking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ActivityTime'], 'safe'],
            [['ShippingPackageLocalId', 'ShipmentId'], 'integer'],
            [['ActivityStatus', 'Note'], 'string', 'max' => 1000],
            [['ActivityBy'], 'string', 'max' => 100],
            [['ShipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['ShipmentId' => 'id']],
            [['ShippingPackageLocalId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingPackageLocal::className(), 'targetAttribute' => ['ShippingPackageLocalId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ActivityTime' => 'Activity Time',
            'ShippingPackageLocalId' => 'Shipping Package Local ID',
            'ShipmentId' => 'Shipment ID',
            'ActivityStatus' => 'Activity Status',
            'Note' => 'Note',
            'ActivityBy' => 'Activity By',
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
    public function getShippingPackageLocal()
    {
        return $this->hasOne(ShippingPackageLocal::className(), ['id' => 'ShippingPackageLocalId']);
    }
}
