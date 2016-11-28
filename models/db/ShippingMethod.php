<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_method".
 *
 * @property integer $id
 * @property integer $ShippingType
 * @property integer $ShippingProviderId
 * @property string $Name
 * @property string $Description
 * @property integer $DisplayOrder
 * @property integer $siteId
 *
 * @property ShippingLog[] $shippingLogs
 * @property ShippingProvider $shippingProvider
 * @property Site $site
 * @property ShippingPackageLocal[] $shippingPackageLocals
 */
class ShippingMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShippingType', 'ShippingProviderId', 'DisplayOrder', 'siteId'], 'integer'],
            [['Description'], 'string'],
            [['Name'], 'string', 'max' => 400],
            [['ShippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['ShippingProviderId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ShippingType' => 'Shipping Type',
            'ShippingProviderId' => 'Shipping Provider ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'DisplayOrder' => 'Display Order',
            'siteId' => 'Site ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingLogs()
    {
        return $this->hasMany(ShippingLog::className(), ['ShippingMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'ShippingProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['ShippingMethodId' => 'id']);
    }
}
