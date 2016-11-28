<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_product_interested".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $ProductId
 * @property string $ProductName
 * @property integer $CategoryId
 * @property string $CreatedTime
 *
 * @property Customer $customer
 * @property Product $product
 * @property Category $category
 */
class CustomerProductInterested extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_product_interested';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'ProductId', 'CategoryId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['ProductName'], 'string', 'max' => 255],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
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
            'ProductId' => 'Product ID',
            'ProductName' => 'Product Name',
            'CategoryId' => 'Category ID',
            'CreatedTime' => 'Created Time',
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'ProductId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }
}
