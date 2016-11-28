<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "discount_usage_history".
 *
 * @property integer $id
 * @property integer $DiscountId
 * @property integer $OrderId
 * @property string $CreatedTime
 * @property integer $siteId
 * @property integer $StoreId
 *
 * @property Discount $discount
 * @property Store $store
 * @property Site $site
 * @property Order $order
 */
class DiscountUsageHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_usage_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DiscountId', 'OrderId', 'siteId', 'StoreId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['DiscountId'], 'exist', 'skipOnError' => true, 'targetClass' => Discount::className(), 'targetAttribute' => ['DiscountId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['OrderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['OrderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'DiscountId' => 'Discount ID',
            'OrderId' => 'Order ID',
            'CreatedTime' => 'Created Time',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'DiscountId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'OrderId']);
    }
}
