<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_provider_district_mapping".
 *
 * @property integer $id
 * @property integer $ProviderDistrictId
 * @property integer $SystemDistrictId
 *
 * @property ShippingProviderDistrict $providerDistrict
 * @property SystemDistrict $systemDistrict
 */
class ShippingProviderDistrictMapping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_provider_district_mapping';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProviderDistrictId', 'SystemDistrictId'], 'integer'],
            [['ProviderDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProviderDistrict::className(), 'targetAttribute' => ['ProviderDistrictId' => 'id']],
            [['SystemDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['SystemDistrictId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ProviderDistrictId' => 'Provider District ID',
            'SystemDistrictId' => 'System District ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderDistrict()
    {
        return $this->hasOne(ShippingProviderDistrict::className(), ['id' => 'ProviderDistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'SystemDistrictId']);
    }
}
