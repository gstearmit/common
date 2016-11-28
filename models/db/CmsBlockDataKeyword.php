<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block_data_keyword".
 *
 * @property integer $id
 * @property integer $blockId
 * @property string $keyword
 * @property string $linkTo
 * @property integer $active
 * @property integer $order
 *
 * @property CmsBlock $block
 */
class CmsBlockDataKeyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block_data_keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blockId', 'keyword', 'active', 'order'], 'required'],
            [['blockId', 'active', 'order'], 'integer'],
            [['keyword'], 'string', 'max' => 30],
            [['linkTo'], 'string', 'max' => 300],
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
            'keyword' => 'Keyword',
            'linkTo' => 'Link To',
            'active' => 'Active',
            'order' => 'Order',
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
