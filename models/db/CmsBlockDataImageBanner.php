<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_image_banner".
 *
 * @property integer $id
 * @property string $title
 * @property integer $blockId
 * @property string $linkImage
 * @property string $linkTo
 * @property integer $bannerType
 * @property integer $active
 * @property integer $order
 * @property integer $categoryId
 * @property string $name
 * @property string $description
 *
 * @property CmsBlock $block
 * @property CmsBlockDataCategory $category
 */
class CmsBlockDataImageBanner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_image_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'linkImage', 'linkTo'], 'required'],
            [['blockId', 'bannerType', 'active', 'order', 'categoryId'], 'integer'],
            [['title', 'description'], 'string', 'max' => 255],
            [['linkImage', 'linkTo'], 'string', 'max' => 300],
            [['name'], 'string', 'max' => 50],
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
            'title' => 'Title',
            'blockId' => 'Block ID',
            'linkImage' => 'Link Image',
            'linkTo' => 'Link To',
            'bannerType' => 'Banner Type',
            'active' => 'Active',
            'order' => 'Order',
            'categoryId' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
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
