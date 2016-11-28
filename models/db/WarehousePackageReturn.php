<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_return".
 *
 * @property integer $id
 * @property string $TrackingCode
 * @property integer $Type
 * @property string $TransactionTime
 * @property integer $Quantity
 * @property string $TransactionFee
 * @property integer $FeeBillToOrganizationId
 * @property integer $ReturnByEmployeeId
 * @property integer $reasonReturnTypeId
 * @property string $description
 * @property integer $shippingProviderId
 *
 * @property PurchaseOrderItemReturn[] $purchaseOrderItemReturns
 * @property Organization $feeBillToOrganization
 * @property OrganizationEmployee $returnByEmployee
 * @property PurchaseOrderItemReturnType $reasonReturnType
 * @property ShippingProvider $shippingProvider
 */
class WarehousePackageReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Type', 'Quantity', 'FeeBillToOrganizationId', 'ReturnByEmployeeId', 'reasonReturnTypeId', 'shippingProviderId'], 'integer'],
            [['TransactionTime'], 'safe'],
            [['TransactionFee'], 'number'],
            [['TrackingCode'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['FeeBillToOrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['FeeBillToOrganizationId' => 'id']],
            [['ReturnByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ReturnByEmployeeId' => 'id']],
            [['reasonReturnTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrderItemReturnType::className(), 'targetAttribute' => ['reasonReturnTypeId' => 'id']],
            [['shippingProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => ShippingProvider::className(), 'targetAttribute' => ['shippingProviderId' => 'id']],
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
            'Type' => 'Type',
            'TransactionTime' => 'Transaction Time',
            'Quantity' => 'Quantity',
            'TransactionFee' => 'Transaction Fee',
            'FeeBillToOrganizationId' => 'Fee Bill To Organization ID',
            'ReturnByEmployeeId' => 'Return By Employee ID',
            'reasonReturnTypeId' => 'Reason Return Type ID',
            'description' => 'Description',
            'shippingProviderId' => 'Shipping Provider ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemReturns()
    {
        return $this->hasMany(PurchaseOrderItemReturn::className(), ['WarehousePackageReturnId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeeBillToOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'FeeBillToOrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReturnByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ReturnByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReasonReturnType()
    {
        return $this->hasOne(PurchaseOrderItemReturnType::className(), ['id' => 'reasonReturnTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingProvider()
    {
        return $this->hasOne(ShippingProvider::className(), ['id' => 'shippingProviderId']);
    }
}
