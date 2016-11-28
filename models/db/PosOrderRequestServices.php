<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_order_request_services".
 *
 * @property integer $id
 * @property string $TotalSubAmountFeeInLocalCurrency
 * @property string $BaseOnTotalWeight
 * @property string $BaseOnTotalValues
 * @property string $BaseOnInsuranceValues
 * @property integer $WarehouseOptionGroupId
 * @property integer $WarehouseOptionSettingId
 * @property integer $ShippingOptionGroupId
 * @property integer $ShippingOptionSettingId
 * @property integer $Quantity
 * @property string $TotalSubAmountFee
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $Description
 * @property string $CreatedTime
 * @property string $Note
 * @property integer $PosOrderRequestId
 * @property integer $WarehouseOptionSettingPriceId
 * @property integer $ShippingOptionSettingPriceId
 *
 * @property SystemCurrency $currency
 * @property WarehousePackageSettingGroup $warehouseOptionGroup
 * @property WarehousePackageSetting $warehouseOptionSetting
 * @property ShippingOptionGroup $shippingOptionGroup
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property PosOrderRequest $posOrderRequest
 * @property WarehousePackageSettingPrices $warehouseOptionSettingPrice
 * @property ShippingOptionSettingPrices $shippingOptionSettingPrice
 */
class PosOrderRequestServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_order_request_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TotalSubAmountFeeInLocalCurrency', 'BaseOnTotalWeight', 'BaseOnTotalValues', 'BaseOnInsuranceValues', 'TotalSubAmountFee', 'CurrencyRate'], 'number'],
            [['WarehouseOptionGroupId', 'WarehouseOptionSettingId', 'ShippingOptionGroupId', 'ShippingOptionSettingId', 'Quantity', 'CurrencyId', 'PosOrderRequestId', 'WarehouseOptionSettingPriceId', 'ShippingOptionSettingPriceId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['Description', 'Note'], 'string', 'max' => 255],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['WarehouseOptionGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingGroup::className(), 'targetAttribute' => ['WarehouseOptionGroupId' => 'id']],
            [['WarehouseOptionSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSetting::className(), 'targetAttribute' => ['WarehouseOptionSettingId' => 'id']],
            [['ShippingOptionGroupId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['ShippingOptionGroupId' => 'id']],
            [['ShippingOptionSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['ShippingOptionSettingId' => 'id']],
            [['PosOrderRequestId'], 'exist', 'skipOnError' => true, 'targetClass' => PosOrderRequest::className(), 'targetAttribute' => ['PosOrderRequestId' => 'id']],
            [['WarehouseOptionSettingPriceId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageSettingPrices::className(), 'targetAttribute' => ['WarehouseOptionSettingPriceId' => 'id']],
            [['ShippingOptionSettingPriceId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSettingPrices::className(), 'targetAttribute' => ['ShippingOptionSettingPriceId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TotalSubAmountFeeInLocalCurrency' => 'Total Sub Amount Fee In Local Currency',
            'BaseOnTotalWeight' => 'Base On Total Weight',
            'BaseOnTotalValues' => 'Base On Total Values',
            'BaseOnInsuranceValues' => 'Base On Insurance Values',
            'WarehouseOptionGroupId' => 'Warehouse Option Group ID',
            'WarehouseOptionSettingId' => 'Warehouse Option Setting ID',
            'ShippingOptionGroupId' => 'Shipping Option Group ID',
            'ShippingOptionSettingId' => 'Shipping Option Setting ID',
            'Quantity' => 'Quantity',
            'TotalSubAmountFee' => 'Total Sub Amount Fee',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'Description' => 'Description',
            'CreatedTime' => 'Created Time',
            'Note' => 'Note',
            'PosOrderRequestId' => 'Pos Order Request ID',
            'WarehouseOptionSettingPriceId' => 'Warehouse Option Setting Price ID',
            'ShippingOptionSettingPriceId' => 'Shipping Option Setting Price ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionGroup()
    {
        return $this->hasOne(WarehousePackageSettingGroup::className(), ['id' => 'WarehouseOptionGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionSetting()
    {
        return $this->hasOne(WarehousePackageSetting::className(), ['id' => 'WarehouseOptionSettingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionGroup()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'ShippingOptionGroupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSetting()
    {
        return $this->hasOne(ShippingOptionSetting::className(), ['id' => 'ShippingOptionSettingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequest()
    {
        return $this->hasOne(PosOrderRequest::className(), ['id' => 'PosOrderRequestId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOptionSettingPrice()
    {
        return $this->hasOne(WarehousePackageSettingPrices::className(), ['id' => 'WarehouseOptionSettingPriceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrice()
    {
        return $this->hasOne(ShippingOptionSettingPrices::className(), ['id' => 'ShippingOptionSettingPriceId']);
    }
}
