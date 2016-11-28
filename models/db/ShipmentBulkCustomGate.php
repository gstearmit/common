<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_custom_gate".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $PartnerId
 * @property integer $ProvinceId
 * @property integer $CountryId
 * @property integer $ProcessedByEmployeeId
 *
 * @property ShipmentBulkAirbillCategoryMapping[] $shipmentBulkAirbillCategoryMappings
 * @property ShipmentBulkCustom[] $shipmentBulkCustoms
 * @property Partner $partner
 * @property SystemStateProvince $province
 * @property SystemCountry $country
 * @property OrganizationEmployee $processedByEmployee
 */
class ShipmentBulkCustomGate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_custom_gate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PartnerId', 'ProvinceId', 'CountryId', 'ProcessedByEmployeeId'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['PartnerId'], 'exist', 'skipOnError' => true, 'targetClass' => Partner::className(), 'targetAttribute' => ['PartnerId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['CountryId' => 'id']],
            [['ProcessedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcessedByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'PartnerId' => 'Partner ID',
            'ProvinceId' => 'Province ID',
            'CountryId' => 'Country ID',
            'ProcessedByEmployeeId' => 'Processed By Employee ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkAirbillCategoryMappings()
    {
        return $this->hasMany(ShipmentBulkAirbillCategoryMapping::className(), ['ShipmentBulkCustomGateId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustoms()
    {
        return $this->hasMany(ShipmentBulkCustom::className(), ['customGate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::className(), ['id' => 'PartnerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'ProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'CountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcessedByEmployeeId']);
    }
}
