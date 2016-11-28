<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_order_request_items".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $CategoryCustomerPolicyId
 * @property string $UnitPrice
 * @property integer $CurrencyId
 * @property integer $Quantity
 * @property integer $SystemUomId
 * @property string $SubTotal
 * @property string $InsurancedSubTotal
 * @property string $CurrencyRate
 * @property string $SubTotalInLocalCurrency
 * @property string $TotalFee
 * @property string $TotalFeeInLocalCurrency
 * @property integer $PosOrderRequestId
 *
 * @property SystemCurrency $currency
 * @property SystemUnitOfMessure $systemUom
 * @property PosOrderRequest $posOrderRequest
 * @property CategoryCustomPolicy $categoryCustomerPolicy
 * @property PosOrderRequestItemsImages[] $posOrderRequestItemsImages
 * @property PosOrderRequestItemsServices[] $posOrderRequestItemsServices
 */
class PosOrderRequestItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_order_request_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryCustomerPolicyId', 'CurrencyId', 'Quantity', 'SystemUomId', 'PosOrderRequestId'], 'integer'],
            [['UnitPrice', 'SubTotal', 'InsurancedSubTotal', 'CurrencyRate', 'SubTotalInLocalCurrency', 'TotalFee', 'TotalFeeInLocalCurrency'], 'number'],
            [['Name', 'Description'], 'string', 'max' => 255],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['SystemUomId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemUnitOfMessure::className(), 'targetAttribute' => ['SystemUomId' => 'id']],
            [['PosOrderRequestId'], 'exist', 'skipOnError' => true, 'targetClass' => PosOrderRequest::className(), 'targetAttribute' => ['PosOrderRequestId' => 'id']],
            [['CategoryCustomerPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['CategoryCustomerPolicyId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'CategoryCustomerPolicyId' => 'Category Customer Policy ID',
            'UnitPrice' => 'Unit Price',
            'CurrencyId' => 'Currency ID',
            'Quantity' => 'Quantity',
            'SystemUomId' => 'System Uom ID',
            'SubTotal' => 'Sub Total',
            'InsurancedSubTotal' => 'Insuranced Sub Total',
            'CurrencyRate' => 'Currency Rate',
            'SubTotalInLocalCurrency' => 'Sub Total In Local Currency',
            'TotalFee' => 'Total Fee',
            'TotalFeeInLocalCurrency' => 'Total Fee In Local Currency',
            'PosOrderRequestId' => 'Pos Order Request ID',
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
    public function getSystemUom()
    {
        return $this->hasOne(SystemUnitOfMessure::className(), ['id' => 'SystemUomId']);
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
    public function getCategoryCustomerPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'CategoryCustomerPolicyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsImages()
    {
        return $this->hasMany(PosOrderRequestItemsImages::className(), ['PosOrderRequestItemsId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItemsServices()
    {
        return $this->hasMany(PosOrderRequestItemsServices::className(), ['PosOrderRequestItemsId' => 'id']);
    }
}
