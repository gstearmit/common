<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_warehouse_prefer".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $WarehouseId
 * @property string $RegistrationTime
 * @property integer $DefaultReceiveWarehouse
 *
 * @property Customer $customer
 * @property Warehouse $warehouse
 */
class CustomerWarehousePrefer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_warehouse_prefer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'WarehouseId', 'DefaultReceiveWarehouse'], 'integer'],
            [['RegistrationTime'], 'string', 'max' => 255],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['WarehouseId'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['WarehouseId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CustomerId' => 'Customer ID',
            'WarehouseId' => 'Warehouse ID',
            'RegistrationTime' => 'Registration Time',
            'DefaultReceiveWarehouse' => 'Default Receive Warehouse',
        ];
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
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'WarehouseId']);
    }
}
