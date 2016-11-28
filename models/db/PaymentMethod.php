<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "payment_method".
 *
 * @property integer $id
 * @property string $Name
 * @property string $description
 * @property integer $active
 * @property string $alias
 * @property string $bankCode
 * @property string $image
 * @property integer $group
 * @property integer $childId
 *
 * @property PaymentMethodBank[] $paymentMethodBanks
 * @property PaymentMethodProvider[] $paymentMethodProviders
 * @property PurchaseOrder[] $purchaseOrders
 * @property SaleCommissionSettingDetail[] $saleCommissionSettingDetails
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'group', 'childId'], 'integer'],
            [['Name', 'alias', 'bankCode'], 'string', 'max' => 100],
            [['description', 'image'], 'string', 'max' => 255],
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
            'description' => 'Description',
            'active' => 'Active',
            'alias' => 'Alias',
            'bankCode' => 'Bank Code',
            'image' => 'Image',
            'group' => 'Group',
            'childId' => 'Child ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodBanks()
    {
        return $this->hasMany(PaymentMethodBank::className(), ['PaymentMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodProviders()
    {
        return $this->hasMany(PaymentMethodProvider::className(), ['paymentMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['PaymentMethodId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettingDetails()
    {
        return $this->hasMany(SaleCommissionSettingDetail::className(), ['PaymentMethodId' => 'id']);
    }
}
