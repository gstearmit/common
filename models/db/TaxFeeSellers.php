<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tax_fee_sellers".
 *
 * @property integer $id
 * @property string $sellerId
 * @property string $description
 * @property double $usTax
 * @property double $shippingFee
 * @property integer $order
 * @property integer $published
 */
class TaxFeeSellers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tax_fee_sellers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sellerId', 'description'], 'required'],
            [['usTax', 'shippingFee'], 'number'],
            [['order', 'published'], 'integer'],
            [['sellerId'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sellerId' => 'Seller ID',
            'description' => 'Description',
            'usTax' => 'Us Tax',
            'shippingFee' => 'Shipping Fee',
            'order' => 'Order',
            'published' => 'Published',
        ];
    }
}
