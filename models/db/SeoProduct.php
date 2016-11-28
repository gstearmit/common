<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "seo_product".
 *
 * @property integer $id
 * @property string $keyword
 * @property string $categoryIds
 * @property string $priceFrom
 * @property string $priceTo
 * @property string $sellerIds
 * @property string $condition
 * @property integer $type
 * @property string $brand
 * @property integer $landing_Id
 * @property integer $portal
 *
 * @property SeoLanding $landing
 */
class SeoProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priceFrom', 'priceTo'], 'number'],
            [['type', 'landing_Id', 'portal'], 'integer'],
            [['keyword', 'categoryIds', 'sellerIds', 'condition', 'brand'], 'string', 'max' => 255],
            [['landing_Id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoLanding::className(), 'targetAttribute' => ['landing_Id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
            'categoryIds' => 'Category Ids',
            'priceFrom' => 'Price From',
            'priceTo' => 'Price To',
            'sellerIds' => 'Seller Ids',
            'condition' => 'Condition',
            'type' => 'Type',
            'brand' => 'Brand',
            'landing_Id' => 'Landing  ID',
            'portal' => 'Portal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanding()
    {
        return $this->hasOne(SeoLanding::className(), ['id' => 'landing_Id']);
    }
}
