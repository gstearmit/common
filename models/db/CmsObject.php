<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_object".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property boolean $active
 * @property integer $order
 *
 * @property CmsTemplateObject[] $cmsTemplateObjects
 */
class CmsObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'boolean'],
            [['order'], 'integer'],
            [['alias', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'name' => 'Name',
            'active' => 'Active',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsTemplateObjects()
    {
        return $this->hasMany(CmsTemplateObject::className(), ['objectId' => 'id']);
    }
}
