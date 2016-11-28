<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_setting".
 *
 * @property integer $id
 * @property string $NameCode
 * @property string $Description
 * @property string $Address
 * @property integer $DistrictId
 * @property integer $ProvinceId
 * @property string $Setting
 * @property integer $InChargeEmployeeId
 * @property integer $PartnerId
 * @property integer $WarehouseReceiveId
 * @property integer $StoreId
 *
 * @property Order[] $orders
 * @property PosOrderRequest[] $posOrderRequests
 * @property OrganizationEmployee $inChargeEmployee
 * @property Partner $partner
 * @property SystemDistrict $district
 * @property SystemStateProvince $province
 * @property Warehouse $warehouseReceive
 * @property Store $store
 */
class PosSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DistrictId', 'ProvinceId', 'InChargeEmployeeId', 'PartnerId', 'WarehouseReceiveId', 'StoreId'], 'integer'],
            [['NameCode', 'Description', 'Address'], 'string', 'max' => 255],
            [['Setting'], 'string', 'max' => 1000],
            [['InChargeEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['InChargeEmployeeId' => 'id']],
            [['PartnerId'], 'exist', 'skipOnError' => true, 'targetClass' => Partner::className(), 'targetAttribute' => ['PartnerId' => 'id']],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
            [['ProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ProvinceId' => 'id']],
            [['WarehouseReceiveId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseReceiveId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'NameCode' => 'Name Code',
            'Description' => 'Description',
            'Address' => 'Address',
            'DistrictId' => 'District ID',
            'ProvinceId' => 'Province ID',
            'Setting' => 'Setting',
            'InChargeEmployeeId' => 'In Charge Employee ID',
            'PartnerId' => 'Partner ID',
            'WarehouseReceiveId' => 'Warehouse Receive ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['PosSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['PosSettingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInChargeEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'InChargeEmployeeId']);
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
    public function getDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'DistrictId']);
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
    public function getWarehouseReceive()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseReceiveId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
