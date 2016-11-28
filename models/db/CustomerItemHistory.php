<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_item_history".
 *
 * @property integer $id
 * @property integer $customerId
 * @property string $itemId
 * @property string $updateTime
 * @property integer $siteId
 * @property integer $StoreId
 * @property integer $CategoryId
 *
 * @property Category $category
 * @property Customer $customer
 */
class CustomerItemHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_item_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'itemId', 'siteId', 'StoreId'], 'required'],
            [['customerId', 'siteId', 'StoreId', 'CategoryId'], 'integer'],
            [['updateTime'], 'safe'],
            [['itemId'], 'string', 'max' => 15],
            [['customerId', 'itemId', 'siteId', 'StoreId', 'CategoryId'], 'unique', 'targetAttribute' => ['customerId', 'itemId', 'siteId', 'StoreId', 'CategoryId'], 'message' => 'The combination of Customer ID, Item ID, Site ID, Store ID and Category ID has already been taken.'],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
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
            'itemId' => 'Item ID',
            'updateTime' => 'Update Time',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'CategoryId' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }
}
