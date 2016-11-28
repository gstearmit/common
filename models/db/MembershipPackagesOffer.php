<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "membership_packages_offer".
 *
 * @property integer $id
 * @property integer $detail_id
 * @property integer $packages_id
 * @property string $value
 * @property string $benefitAmount
 * @property integer $benefitType
 * @property integer $warehouse_package_setting_id
 * @property integer $shipping_option_setting_id
 * @property integer $type
 *
 * @property MembershipPackagesDetail $detail
 * @property MembershipPackages $packages
 * @property WarehousePackageSetting $warehousePackageSetting
 * @property ShippingOptionSetting $shippingOptionSetting
 */
class MembershipPackagesOffer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_packages_offer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail_id', 'packages_id', 'benefitType', 'warehouse_package_setting_id', 'shipping_option_setting_id', 'type'], 'integer'],
            [['benefitAmount'], 'number'],
            [['value'], 'string', 'max' => 255],
            [['detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackagesDetail::className(), 'targetAttribute' => ['detail_id' => 'id']],
            [['packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackages::className(), 'targetAttribute' => ['packages_id' => 'id']],
            [['warehouse_package_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['warehouse_package_setting_id' => 'id']],
            [['shipping_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['shipping_option_setting_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail_id' => 'Detail ID',
            'packages_id' => 'Packages ID',
            'value' => 'Value',
            'benefitAmount' => 'Benefit Amount',
            'benefitType' => 'Benefit Type',
            'warehouse_package_setting_id' => 'Warehouse Package Setting ID',
            'shipping_option_setting_id' => 'Shipping Option Setting ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetail()
    {
        return $this->hasOne(MembershipPackagesDetail::className(), ['id' => 'detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasOne(MembershipPackages::className(), ['id' => 'packages_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSetting()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'warehouse_package_setting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSetting()
    {
        return $this->hasOne(ShippingOptionSetting::className(), ['id' => 'shipping_option_setting_id']);
    }
}
