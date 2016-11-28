<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_review".
 *
 * @property integer $id
 * @property integer $CustomerId
 * @property integer $ProductId
 * @property integer $CategoryId
 * @property integer $IsApproved
 * @property string $Title
 * @property string $ReviewText
 * @property integer $Rating
 * @property integer $HelpfulYesTotal
 * @property integer $HelpfulNoTotal
 * @property string $CreatedTime
 *
 * @property Product $product
 * @property Customer $customer
 * @property Category $category
 */
class ProductReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'ProductId', 'CategoryId', 'IsApproved', 'Rating', 'HelpfulYesTotal', 'HelpfulNoTotal'], 'integer'],
            [['Title', 'ReviewText'], 'string'],
            [['CreatedTime'], 'safe'],
            [['ProductId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['ProductId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
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
            'CategoryId' => 'Category ID',
            'IsApproved' => 'Is Approved',
            'Title' => 'Title',
            'ReviewText' => 'Review Text',
            'Rating' => 'Rating',
            'HelpfulYesTotal' => 'Helpful Yes Total',
            'HelpfulNoTotal' => 'Helpful No Total',
            'CreatedTime' => 'Created Time',
        ];
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }
}
