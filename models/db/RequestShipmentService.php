<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_shipment_service".
 *
 * @property integer $id
 * @property integer $shipping_option_group_id
 * @property integer $shipping_option_setting_id
 * @property integer $request_shipment_id
 * @property string $created_time
 * @property integer $ShippingOptionSettingPriceId
 * @property integer $RefundedStatus
 * @property string $RefundedAmount
 * @property string $ApprovedTime
 * @property integer $ApprovedEmployeeId
 * @property integer $ApprovedStatus
 * @property string $RejectedReason
 * @property string $PaidWeight
 * @property string $ActualWeight
 * @property integer $SystemUnitWeightId
 * @property string $FeeChargedPerUnit
 * @property integer $UOM
 * @property string $Quantity
 * @property string $SubTotalAmount
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $SubTotaAmountInLocalCurrency
 * @property string $Note
 *
 * @property ShippingOptionSetting $shippingOptionSetting
 * @property ShippingOptionGroup $shippingOptionGroup
 * @property RequestShipment $requestShipment
 * @property ShippingOptionSettingPrices $shippingOptionSettingPrice
 * @property OrganizationEmployee $approvedEmployee
 * @property SystemCurrency $currency
 */
class RequestShipmentService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_shipment_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_option_group_id', 'shipping_option_setting_id', 'request_shipment_id', 'ShippingOptionSettingPriceId', 'RefundedStatus', 'ApprovedEmployeeId', 'ApprovedStatus', 'SystemUnitWeightId', 'UOM', 'CurrencyId'], 'integer'],
            [['created_time', 'ApprovedTime'], 'safe'],
            [['RefundedAmount', 'PaidWeight', 'ActualWeight', 'FeeChargedPerUnit', 'SubTotalAmount', 'CurrencyRate', 'SubTotaAmountInLocalCurrency'], 'number'],
            [['RejectedReason', 'Note'], 'string', 'max' => 1000],
            [['Quantity'], 'string', 'max' => 255],
            [['shipping_option_setting_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSetting::className(), 'targetAttribute' => ['shipping_option_setting_id' => 'id']],
            [['shipping_option_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionGroup::className(), 'targetAttribute' => ['shipping_option_group_id' => 'id']],
            [['request_shipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestShipment::className(), 'targetAttribute' => ['request_shipment_id' => 'id']],
            [['ShippingOptionSettingPriceId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingOptionSettingPrices::className(), 'targetAttribute' => ['ShippingOptionSettingPriceId' => 'id']],
            [['ApprovedEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApprovedEmployeeId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shipping_option_group_id' => 'Shipping Option Group ID',
            'shipping_option_setting_id' => 'Shipping Option Setting ID',
            'request_shipment_id' => 'Request Shipment ID',
            'created_time' => 'Created Time',
            'ShippingOptionSettingPriceId' => 'Shipping Option Setting Price ID',
            'RefundedStatus' => 'Refunded Status',
            'RefundedAmount' => 'Refunded Amount',
            'ApprovedTime' => 'Approved Time',
            'ApprovedEmployeeId' => 'Approved Employee ID',
            'ApprovedStatus' => 'Approved Status',
            'RejectedReason' => 'Rejected Reason',
            'PaidWeight' => 'Paid Weight',
            'ActualWeight' => 'Actual Weight',
            'SystemUnitWeightId' => 'System Unit Weight ID',
            'FeeChargedPerUnit' => 'Fee Charged Per Unit',
            'UOM' => 'Uom',
            'Quantity' => 'Quantity',
            'SubTotalAmount' => 'Sub Total Amount',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'SubTotaAmountInLocalCurrency' => 'Sub Tota Amount In Local Currency',
            'Note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSetting()
    {
        return $this->hasOne(ShippingOptionSetting::className(), ['id' => 'shipping_option_setting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionGroup()
    {
        return $this->hasOne(ShippingOptionGroup::className(), ['id' => 'shipping_option_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipment()
    {
        return $this->hasOne(RequestShipment::className(), ['id' => 'request_shipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingOptionSettingPrice()
    {
        return $this->hasOne(ShippingOptionSettingPrices::className(), ['id' => 'ShippingOptionSettingPriceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ApprovedEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }
}
