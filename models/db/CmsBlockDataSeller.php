<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_seller".
 *
 * @property integer $id
 * @property integer $blockId
 * @property string $sellerId
 * @property string $sellerLocation
 * @property string $linkTo
 * @property integer $categoryId
 * @property double $reviewPercent
 * @property integer $order
 * @property integer $active
 * @property string $imgAvatar
 * @property integer $reviewScore
 *
 * @property CmsBlock $block
 * @property CmsBlockDataCategory $category
 */
class CmsBlockDataSeller extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_seller';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'sellerId', 'categoryId', 'order', 'active'], 'required'],
            [['blockId', 'categoryId', 'order', 'active', 'reviewScore'], 'integer'],
            [['reviewPercent'], 'number'],
            [['sellerId', 'sellerLocation', 'linkTo'], 'string', 'max' => 200],
            [['imgAvatar'], 'string', 'max' => 255],
            [['blockId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlock::className(), 'targetAttribute' => ['blockId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlockDataCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blockId' => 'Block ID',
            'sellerId' => 'Seller ID',
            'sellerLocation' => 'Seller Location',
            'linkTo' => 'Link To',
            'categoryId' => 'Category ID',
            'reviewPercent' => 'Review Percent',
            'order' => 'Order',
            'active' => 'Active',
            'imgAvatar' => 'Img Avatar',
            'reviewScore' => 'Review Score',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(CmsBlock::className(), ['id' => 'blockId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CmsBlockDataCategory::className(), ['id' => 'categoryId']);
    }
}
