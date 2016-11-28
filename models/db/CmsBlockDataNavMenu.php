<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_nav_menu".
 *
 * @property integer $id
 * @property string $categoryName
 * @property integer $exitsChild
 * @property string $childContent
 * @property string $linkTo
 * @property integer $order
 * @property integer $active
 * @property integer $blockId
 * @property integer $categoryId
 *
 * @property CmsBlock $block
 * @property CmsBlockDataCategory $category
 */
class CmsBlockDataNavMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_nav_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exitsChild', 'order', 'active', 'blockId', 'categoryId'], 'integer'],
            [['childContent'], 'string'],
            [['categoryName'], 'string', 'max' => 100],
            [['linkTo'], 'string', 'max' => 200],
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
            'categoryName' => 'Category Name',
            'exitsChild' => 'Exits Child',
            'childContent' => 'Child Content',
            'linkTo' => 'Link To',
            'order' => 'Order',
            'active' => 'Active',
            'blockId' => 'Block ID',
            'categoryId' => 'Category ID',
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
