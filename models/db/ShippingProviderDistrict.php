<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_provider_district".
 *
 * @property integer $id
 * @property integer $ShippingProviderProvinceId
 * @property string $DistrictName
 * @property string $DistrictCode
 * @property integer $DisplayOrder
 *
 * @property ShippingProviderProvince $shippingProviderProvince
 * @property ShippingProviderDistrictMapping[] $shippingProviderDistrictMappings
 */
class ShippingProviderDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_provider_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShippingProviderProvinceId', 'DisplayOrder'], 'integer'],
            [['DistrictName'], 'string', 'max' => 50],
            [['DistrictCode'], 'string', 'max' => 10],
            [['ShippingProviderProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProviderProvince::className(), 'targetAttribute' => ['ShippingProviderProvinceId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ShippingProviderProvinceId' => 'Shipping Provider Province ID',
            'DistrictName' => 'District Name',
            'DistrictCode' => 'District Code',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProviderProvince()
    {
        return $this->hasOne(ShippingProviderProvince::className(), ['id' => 'ShippingProviderProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProviderDistrictMappings()
    {
        return $this->hasMany(ShippingProviderDistrictMapping::className(), ['ProviderDistrictId' => 'id']);
    }
}
