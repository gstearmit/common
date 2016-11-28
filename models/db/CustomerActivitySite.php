<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_activity_site".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $ProductId
 * @property integer $ProductTypeId
 * @property integer $StepCalculation
 * @property string $Comment
 * @property string $CreatedTime
 *
 * @property Customer $customer
 * @property Product $product
 * @property ProductType $productType
 */
class CustomerActivitySite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_activity_site';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'ProductId', 'ProductTypeId', 'StepCalculation'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['Comment'], 'string', 'max' => 100],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['ProductTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['ProductTypeId' => 'id']],
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
            'ProductTypeId' => 'Product Type ID',
            'StepCalculation' => 'Step Calculation',
            'Comment' => 'Comment',
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
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'ProductTypeId']);
    }
}
