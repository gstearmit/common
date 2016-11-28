<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_image_slide".
 *
 * @property integer $id
 * @property integer $blockId
 * @property string $linkImage
 * @property string $linkTo
 * @property integer $active
 * @property integer $order
 * @property string $name
 * @property string $background
 *
 * @property CmsBlock $block
 */
class CmsBlockDataImageSlide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_image_slide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'linkImage', 'linkTo', 'active', 'order'], 'required'],
            [['blockId', 'active', 'order'], 'integer'],
            [['linkImage', 'linkTo'], 'string', 'max' => 300],
            [['name', 'background'], 'string', 'max' => 50],
            [['blockId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsBlock::className(), 'targetAttribute' => ['blockId' => 'id']],
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
            'linkImage' => 'Link Image',
            'linkTo' => 'Link To',
            'active' => 'Active',
            'order' => 'Order',
            'name' => 'Name',
            'background' => 'Background',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlock()
    {
        return $this->hasOne(CmsBlock::className(), ['id' => 'blockId']);
    }
}
