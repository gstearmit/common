<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_followed".
 *
 * @property integer $id
 * @property integer $customerId
 * @property string $objectId
 * @property integer $objectType
 * @property integer $siteId
 * @property integer $StoreId
 * @property string $updateTime
 * @property string $note
 * @property string $name
 * @property string $price
 * @property integer $endTime
 * @property string $imageUrl
 * @property string $object
 *
 * @property Customer $customer
 * @property Site $site
 * @property Store $store
 */
class CustomerFollowed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_followed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'objectId', 'objectType'], 'required'],
            [['customerId', 'objectType', 'siteId', 'StoreId', 'endTime'], 'integer'],
            [['updateTime'], 'safe'],
            [['price'], 'number'],
            [['object'], 'string'],
            [['objectId'], 'string', 'max' => 255],
            [['note', 'name', 'imageUrl'], 'string', 'max' => 500],
            [['customerId', 'objectId', 'objectType', 'StoreId'], 'unique', 'targetAttribute' => ['customerId', 'objectId', 'objectType', 'StoreId'], 'message' => 'The combination of Customer ID, Object ID, Object Type and Store ID has already been taken.'],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerId' => 'Customer ID',
            'objectId' => 'Object ID',
            'objectType' => 'Object Type',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'updateTime' => 'Update Time',
            'note' => 'Note',
            'name' => 'Name',
            'price' => 'Price',
            'endTime' => 'End Time',
            'imageUrl' => 'Image Url',
            'object' => 'Object',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
