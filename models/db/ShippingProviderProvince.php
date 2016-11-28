<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_provider_province".
 *
 * @property integer $id
 * @property integer $ShippingProviderId
 * @property string $ProvinceName
 * @property string $ProvinceCode
 * @property integer $DisplayOrder
 *
 * @property ShippingProviderDistrict[] $shippingProviderDistricts
 * @property ShippingProvider $shippingProvider
 */
class ShippingProviderProvince extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_provider_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShippingProviderId', 'DisplayOrder'], 'integer'],
            [['ProvinceName'], 'string', 'max' => 50],
            [['ProvinceCode'], 'string', 'max' => 10],
            [['ShippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['ShippingProviderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ShippingProviderId' => 'Shipping Provider ID',
            'ProvinceName' => 'Province Name',
            'ProvinceCode' => 'Province Code',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProviderDistricts()
    {
        return $this->hasMany(ShippingProviderDistrict::className(), ['ShippingProviderProvinceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'ShippingProviderId']);
    }
}
