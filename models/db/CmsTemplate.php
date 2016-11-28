<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_template".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $layouts
 * @property string $template
 * @property integer $order
 * @property boolean $active
 * @property string $image
 * @property integer $type
 * @property integer $parentId
 * @property integer $isAuto
 *
 * @property CmsBlock[] $cmsBlocks
 * @property CmsTemplateObject[] $cmsTemplateObjects
 */
class CmsTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'type', 'parentId', 'isAuto'], 'integer'],
            [['active'], 'boolean'],
            [['name', 'layouts', 'template'], 'string', 'max' => 100],
            [['alias'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
            'layouts' => 'Layouts',
            'template' => 'Template',
            'order' => 'Order',
            'active' => 'Active',
            'image' => 'Image',
            'type' => 'Type',
            'parentId' => 'Parent ID',
            'isAuto' => 'Is Auto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlocks()
    {
        return $this->hasMany(CmsBlock::className(), ['templateId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsTemplateObjects()
    {
        return $this->hasMany(CmsTemplateObject::className(), ['templateId' => 'id']);
    }
}
