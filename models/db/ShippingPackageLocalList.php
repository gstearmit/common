<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipping_package_local_list".
 *
 * @property integer $id
 * @property string $name
 * @property string $createTime
 * @property string $updateTime
 * @property string $submitTime
 * @property string $receiveTime
 * @property integer $carrierProviderId
 * @property integer $totalItemQuantity
 * @property string $totalWeight
 * @property string $totalAmount
 * @property string $totalTransportationFee
 * @property string $totalCodFee
 * @property string $totalFeeInsurance
 * @property string $finalAmount
 * @property string $description
 * @property integer $status
 * @property integer $CreatedByEmployeeId
 *
 * @property ShippingPackageLocal[] $shippingPackageLocals
 * @property ShippingProvider $carrierProvider
 * @property OrganizationEmployee $createdByEmployee
 */
class ShippingPackageLocalList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipping_package_local_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime', 'submitTime', 'receiveTime'], 'safe'],
            [['carrierProviderId', 'totalItemQuantity', 'status', 'CreatedByEmployeeId'], 'integer'],
            [['totalWeight', 'totalAmount', 'totalTransportationFee', 'totalCodFee', 'totalFeeInsurance', 'finalAmount'], 'number'],
            [['name', 'description'], 'string', 'max' => 255],
            [['carrierProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['carrierProviderId' => 'id']],
            [['CreatedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CreatedByEmployeeId' => 'id']],
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
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'submitTime' => 'Submit Time',
            'receiveTime' => 'Receive Time',
            'carrierProviderId' => 'Carrier Provider ID',
            'totalItemQuantity' => 'Total Item Quantity',
            'totalWeight' => 'Total Weight',
            'totalAmount' => 'Total Amount',
            'totalTransportationFee' => 'Total Transportation Fee',
            'totalCodFee' => 'Total Cod Fee',
            'totalFeeInsurance' => 'Total Fee Insurance',
            'finalAmount' => 'Final Amount',
            'description' => 'Description',
            'status' => 'Status',
            'CreatedByEmployeeId' => 'Created By Employee ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocals()
    {
        return $this->hasMany(ShippingPackageLocal::className(), ['shipmentpackagelocallistId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrierProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'carrierProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CreatedByEmployeeId']);
    }
}
