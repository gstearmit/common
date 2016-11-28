<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "dailydeals".
 *
 * @property integer $id
 * @property integer $itemId
 * @property integer $parentId
 * @property string $name
 * @property string $condition
 * @property string $image
 * @property double $price
 * @property double $sellPrice
 * @property double $oldPrice
 * @property double $sellOldPrice
 * @property integer $rate
 * @property integer $quantity
 * @property integer $quantitysold
 * @property integer $endtime
 * @property integer $published
 * @property string $usShipping
 * @property string $usTax
 */
class Dailydeals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dailydeals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'parentId', 'rate', 'quantity', 'quantitysold', 'endtime', 'published'], 'integer'],
            [['price', 'sellPrice', 'oldPrice', 'sellOldPrice', 'usShipping', 'usTax'], 'number'],
            [['name', 'condition'], 'string', 'max' => 250],
            [['image'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'parentId' => 'Parent ID',
            'name' => 'Name',
            'condition' => 'Condition',
            'image' => 'Image',
            'price' => 'Price',
            'sellPrice' => 'Sell Price',
            'oldPrice' => 'Old Price',
            'sellOldPrice' => 'Sell Old Price',
            'rate' => 'Rate',
            'quantity' => 'Quantity',
            'quantitysold' => 'Quantitysold',
            'endtime' => 'Endtime',
            'published' => 'Published',
            'usShipping' => 'Us Shipping',
            'usTax' => 'Us Tax',
        ];
    }
}
