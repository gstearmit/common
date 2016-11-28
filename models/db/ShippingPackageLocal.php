<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_package_local".
 *
 * @property integer $id
 * @property string $TrackingCode
 * @property string $postName
 * @property string $postPhone
 * @property string $postAddress
 * @property integer $postProvinceId
 * @property integer $postDistrictId
 * @property integer $postWardId
 * @property string $receiverName
 * @property string $receiverPhone
 * @property string $receiverAddress
 * @property integer $receiverProvinceId
 * @property integer $receiverDistrictId
 * @property integer $receiverWardId
 * @property string $receiverEmail
 * @property string $order_name
 * @property integer $order_quantity
 * @property string $order_code
 * @property double $order_amount
 * @property double $order_weight
 * @property double $order_collect
 * @property integer $config_service
 * @property integer $config_cod
 * @property integer $config_protected
 * @property integer $config_checking
 * @property integer $config_fragile
 * @property integer $config_payment
 * @property integer $courier
 * @property string $domain
 * @property string $mechar_key
 * @property double $feeShipping
 * @property string $response
 * @property integer $WarehouseId
 * @property integer $ShippingMethodId
 * @property integer $CustomerId
 * @property integer $StoreId
 * @property integer $siteId
 * @property string $createTime
 * @property string $sentTime
 * @property string $receivedTimeByCustomer
 * @property integer $status
 * @property string $description
 * @property string $shipChungTrackingCode
 * @property string $shipChungMoneyCollect
 * @property string $shipChungShowFeePvc
 * @property string $shipChungShowFeeCod
 * @property string $shipChungShowFeePbh
 * @property string $shipChungDiscount
 * @property integer $shipmentId
 * @property integer $shipmentpackagelocallistId
 * @property integer $auditStatus
 * @property string $auditTime
 * @property string $auditNote
 * @property integer $auditByEmployeeId
 * @property integer $returnStatus
 * @property string $returnReceivedTime
 * @property integer $returnReasonType
 * @property string $returnReasonNote
 * @property string $returnTrackingCode
 * @property string $shipChungTrackingCodeOld
 * @property string $shipChungCancelReason
 * @property string $plantime
 * @property string $reference_id
 * @property string $message
 * @property string $shipping_label
 * @property integer $shippingProvider
 * @property string $ShippingProviderCallBack
 *
 * @property ShipmentTracking[] $shipmentTrackings
 * @property ShippingMethod $shippingMethod
 * @property Customer $customer
 * @property Store $store
 * @property Shipment $shipment
 * @property ShippingPackageLocalList $shipmentpackagelocallist
 * @property ShippingProvider $shippingProvider0
 */
class ShippingPackageLocal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_package_local';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postAddress', 'receiverAddress', 'response'], 'string'],
            [['postProvinceId', 'postDistrictId', 'postWardId', 'receiverProvinceId', 'receiverDistrictId', 'receiverWardId', 'order_quantity', 'config_service', 'config_cod', 'config_protected', 'config_checking', 'config_fragile', 'config_payment', 'courier', 'WarehouseId', 'ShippingMethodId', 'CustomerId', 'StoreId', 'siteId', 'status', 'shipmentId', 'shipmentpackagelocallistId', 'auditStatus', 'auditByEmployeeId', 'returnStatus', 'returnReasonType', 'shippingProvider'], 'integer'],
            [['order_amount', 'order_weight', 'order_collect', 'feeShipping', 'shipChungMoneyCollect', 'shipChungShowFeePvc', 'shipChungShowFeeCod', 'shipChungShowFeePbh', 'shipChungDiscount'], 'number'],
            [['createTime', 'sentTime', 'receivedTimeByCustomer', 'auditTime', 'returnReceivedTime', 'plantime'], 'safe'],
            [['TrackingCode', 'receiverEmail', 'order_code', 'domain', 'shipChungTrackingCode'], 'string', 'max' => 100],
            [['postName', 'receiverName', 'order_name', 'mechar_key'], 'string', 'max' => 200],
            [['postPhone', 'receiverPhone'], 'string', 'max' => 20],
            [['description', 'auditNote', 'returnReasonNote', 'returnTrackingCode', 'shipChungTrackingCodeOld', 'shipChungCancelReason', 'reference_id'], 'string', 'max' => 255],
            [['message', 'shipping_label'], 'string', 'max' => 500],
            [['ShippingProviderCallBack'], 'string', 'max' => 10],
            [['ShippingMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingMethod::className(), 'targetAttribute' => ['ShippingMethodId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['shipmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Shipment::className(), 'targetAttribute' => ['shipmentId' => 'id']],
            [['shipmentpackagelocallistId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingPackageLocalList::className(), 'targetAttribute' => ['shipmentpackagelocallistId' => 'id']],
            [['shippingProvider'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['shippingProvider' => 'id']],
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
            'postName' => 'Post Name',
            'postPhone' => 'Post Phone',
            'postAddress' => 'Post Address',
            'postProvinceId' => 'Post Province ID',
            'postDistrictId' => 'Post District ID',
            'postWardId' => 'Post Ward ID',
            'receiverName' => 'Receiver Name',
            'receiverPhone' => 'Receiver Phone',
            'receiverAddress' => 'Receiver Address',
            'receiverProvinceId' => 'Receiver Province ID',
            'receiverDistrictId' => 'Receiver District ID',
            'receiverWardId' => 'Receiver Ward ID',
            'receiverEmail' => 'Receiver Email',
            'order_name' => 'Order Name',
            'order_quantity' => 'Order Quantity',
            'order_code' => 'Order Code',
            'order_amount' => 'Order Amount',
            'order_weight' => 'Order Weight',
            'order_collect' => 'Order Collect',
            'config_service' => 'Config Service',
            'config_cod' => 'Config Cod',
            'config_protected' => 'Config Protected',
            'config_checking' => 'Config Checking',
            'config_fragile' => 'Config Fragile',
            'config_payment' => 'Config Payment',
            'courier' => 'Courier',
            'domain' => 'Domain',
            'mechar_key' => 'Mechar Key',
            'feeShipping' => 'Fee Shipping',
            'response' => 'Response',
            'WarehouseId' => 'Warehouse ID',
            'ShippingMethodId' => 'Shipping Method ID',
            'CustomerId' => 'Customer ID',
            'StoreId' => 'Store ID',
            'siteId' => 'Site ID',
            'createTime' => 'Create Time',
            'sentTime' => 'Sent Time',
            'receivedTimeByCustomer' => 'Received Time By Customer',
            'status' => 'Status',
            'description' => 'Description',
            'shipChungTrackingCode' => 'Ship Chung Tracking Code',
            'shipChungMoneyCollect' => 'Ship Chung Money Collect',
            'shipChungShowFeePvc' => 'Ship Chung Show Fee Pvc',
            'shipChungShowFeeCod' => 'Ship Chung Show Fee Cod',
            'shipChungShowFeePbh' => 'Ship Chung Show Fee Pbh',
            'shipChungDiscount' => 'Ship Chung Discount',
            'shipmentId' => 'Shipment ID',
            'shipmentpackagelocallistId' => 'Shipmentpackagelocallist ID',
            'auditStatus' => 'Audit Status',
            'auditTime' => 'Audit Time',
            'auditNote' => 'Audit Note',
            'auditByEmployeeId' => 'Audit By Employee ID',
            'returnStatus' => 'Return Status',
            'returnReceivedTime' => 'Return Received Time',
            'returnReasonType' => 'Return Reason Type',
            'returnReasonNote' => 'Return Reason Note',
            'returnTrackingCode' => 'Return Tracking Code',
            'shipChungTrackingCodeOld' => 'Ship Chung Tracking Code Old',
            'shipChungCancelReason' => 'Ship Chung Cancel Reason',
            'plantime' => 'Plantime',
            'reference_id' => 'Reference ID',
            'message' => 'Message',
            'shipping_label' => 'Shipping Label',
            'shippingProvider' => 'Shipping Provider',
            'ShippingProviderCallBack' => 'Shipping Provider Call Back',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentTrackings()
    {
        return $this->hasMany(ShipmentTracking::className(), ['ShippingPackageLocalId' => 'id']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['id' => 'shipmentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentpackagelocallist()
    {
        return $this->hasOne(ShippingPackageLocalList::className(), ['id' => 'shipmentpackagelocallistId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider0()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'shippingProvider']);
    }
}
