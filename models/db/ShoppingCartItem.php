<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shopping_cart_item".
 *
 * @property integer $id
 * @property integer $CategoryId
 * @property integer $StoreId
 * @property integer $CustomerId
 * @property string $ItemId
 * @property string $startPrice
 * @property string $sellPrice
 * @property string $usTax
 * @property string $usShipping
 * @property string $discount
 * @property integer $Quantity
 * @property string $CreatedTime
 * @property string $UpdatedTime
 * @property integer $siteId
 * @property string $Specific
 * @property string $Title
 * @property string $Image
 *
 * @property Store $store
 * @property Category $category
 * @property Site $site
 * @property Customer $customer
 */
class ShoppingCartItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shopping_cart_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryId', 'StoreId', 'CustomerId', 'Quantity', 'siteId'], 'integer'],
            [['startPrice', 'sellPrice', 'usTax', 'usShipping', 'discount'], 'number'],
            [['CreatedTime', 'UpdatedTime'], 'safe'],
            [['ItemId'], 'string', 'max' => 50],
            [['Specific'], 'string', 'max' => 300],
            [['Title'], 'string', 'max' => 200],
            [['Image'], 'string', 'max' => 255],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CategoryId' => 'Category ID',
            'StoreId' => 'Store ID',
            'CustomerId' => 'Customer ID',
            'ItemId' => 'Item ID',
            'startPrice' => 'Start Price',
            'sellPrice' => 'Sell Price',
            'usTax' => 'Us Tax',
            'usShipping' => 'Us Shipping',
            'discount' => 'Discount',
            'Quantity' => 'Quantity',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
            'siteId' => 'Site ID',
            'Specific' => 'Specific',
            'Title' => 'Title',
            'Image' => 'Image',
        ];
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }
}
