<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_log".
 *
 * @property integer $id
 * @property string $TrackingCode
 * @property integer $ObjectRefId
 * @property string $ObjectType
 * @property string $postName
 * @property string $postPhone
 * @property string $postAddress
 * @property integer $postCity
 * @property integer $postProvince
 * @property string $receiverName
 * @property string $receiverPhone
 * @property string $receiverAdress
 * @property integer $receiverCity
 * @property integer $receiverProvince
 * @property integer $receiverWard
 * @property string $order_name
 * @property integer $order_quantity
 * @property double $order_amount
 * @property double $order_weight
 * @property double $order_collect
 * @property integer $orderItemSku
 * @property integer $config_service
 * @property integer $config_cod
 * @property integer $config_protect
 * @property integer $config_checking
 * @property integer $config_fragile
 * @property integer $config_payment
 * @property string $mecharId
 * @property double $feeShipping
 * @property string $response
 * @property integer $ShippingMethodId
 * @property integer $CustomerId
 * @property integer $OrderItemId
 * @property integer $StoreId
 * @property integer $siteId
 * @property string $createTime
 * @property string $sentTime
 * @property string $receivedTimeByCustomer
 * @property integer $status
 *
 * @property ShippingMethod $shippingMethod
 * @property Customer $customer
 * @property OrderItem $orderItem
 * @property Store $store
 * @property Site $site
 */
class ShippingLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ObjectRefId', 'postCity', 'postProvince', 'receiverCity', 'receiverProvince', 'receiverWard', 'order_quantity', 'orderItemSku', 'config_service', 'config_cod', 'config_protect', 'config_checking', 'config_fragile', 'config_payment', 'ShippingMethodId', 'CustomerId', 'OrderItemId', 'StoreId', 'siteId', 'status'], 'integer'],
            [['postAddress', 'receiverAdress', 'response'], 'string'],
            [['order_amount', 'order_weight', 'order_collect', 'feeShipping'], 'number'],
            [['createTime', 'sentTime', 'receivedTimeByCustomer'], 'safe'],
            [['TrackingCode'], 'string', 'max' => 100],
            [['ObjectType'], 'string', 'max' => 50],
            [['postName', 'receiverName', 'order_name', 'mecharId'], 'string', 'max' => 200],
            [['postPhone', 'receiverPhone'], 'string', 'max' => 20],
            [['ShippingMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMethod::className(), 'targetAttribute' => ['ShippingMethodId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['OrderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['OrderItemId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'TrackingCode' => 'Tracking Code',
            'ObjectRefId' => 'Object Ref ID',
            'ObjectType' => 'Object Type',
            'postName' => 'Post Name',
            'postPhone' => 'Post Phone',
            'postAddress' => 'Post Address',
            'postCity' => 'Post City',
            'postProvince' => 'Post Province',
            'receiverName' => 'Receiver Name',
            'receiverPhone' => 'Receiver Phone',
            'receiverAdress' => 'Receiver Adress',
            'receiverCity' => 'Receiver City',
            'receiverProvince' => 'Receiver Province',
            'receiverWard' => 'Receiver Ward',
            'order_name' => 'Order Name',
            'order_quantity' => 'Order Quantity',
            'order_amount' => 'Order Amount',
            'order_weight' => 'Order Weight',
            'order_collect' => 'Order Collect',
            'orderItemSku' => 'Order Item Sku',
            'config_service' => 'Config Service',
            'config_cod' => 'Config Cod',
            'config_protect' => 'Config Protect',
            'config_checking' => 'Config Checking',
            'config_fragile' => 'Config Fragile',
            'config_payment' => 'Config Payment',
            'mecharId' => 'Mechar ID',
            'feeShipping' => 'Fee Shipping',
            'response' => 'Response',
            'ShippingMethodId' => 'Shipping Method ID',
            'CustomerId' => 'Customer ID',
            'OrderItemId' => 'Order Item ID',
            'StoreId' => 'Store ID',
            'siteId' => 'Site ID',
            'createTime' => 'Create Time',
            'sentTime' => 'Sent Time',
            'receivedTimeByCustomer' => 'Received Time By Customer',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingMethod()
    {
        return $this->hasOne(ShippingMethod::className(), ['id' => 'ShippingMethodId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'OrderItemId']);
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
}
