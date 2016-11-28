<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "membership_packages".
 *
 * @property integer $id
 * @property string $name
 * @property string $system_name
 * @property string $description
 * @property string $fee_monthly
 * @property integer $is_free
 * @property string $fee_annual
 * @property integer $active
 * @property integer $default
 * @property integer $recommended
 * @property integer $display_order
 * @property integer $store_id
 * @property integer $currency_id
 *
 * @property CustomerMembership[] $customerMemberships
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property Store $store
 * @property SystemCurrency $currency
 * @property MembershipPackagesOffer[] $membershipPackagesOffers
 * @property ShippingOptionSettingPrices[] $shippingOptionSettingPrices
 * @property WarehousePackageSettingPrices[] $warehousePackageSettingPrices
 */
class MembershipPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fee_monthly', 'fee_annual'], 'number'],
            [['is_free', 'active', 'default', 'recommended', 'display_order', 'store_id', 'currency_id'], 'integer'],
            [['name', 'system_name', 'description'], 'string', 'max' => 255],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['currency_id' => 'id']],
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
            'system_name' => 'System Name',
            'description' => 'Description',
            'fee_monthly' => 'Fee Monthly',
            'is_free' => 'Is Free',
            'fee_annual' => 'Fee Annual',
            'active' => 'Active',
            'default' => 'Default',
            'recommended' => 'Recommended',
            'display_order' => 'Display Order',
            'store_id' => 'Store ID',
            'currency_id' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerMemberships()
    {
        return $this->hasMany(CustomerMembership::className(), ['membership_packages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['MembershipPackageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackagesOffers()
    {
        return $this->hasMany(MembershipPackagesOffer::className(), ['packages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrices()
    {
        return $this->hasMany(ShippingOptionSettingPrices::className(), ['membership_package_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageSettingPrices()
    {
        return $this->hasMany(WarehousePackageSettingPrices::className(), ['membership_packages_id' => 'id']);
    }
}
