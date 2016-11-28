<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "function_menu".
 *
 * @property integer $id
 * @property string $alias
 * @property string $Name
 * @property integer $ParentId
 * @property integer $children
 * @property string $url
 * @property integer $DisplayOrder
 * @property integer $LanguageId
 * @property integer $active
 *
 * @property Language $language
 */
class FunctionMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'function_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ParentId', 'children', 'DisplayOrder', 'LanguageId', 'active'], 'integer'],
            [['alias', 'Name'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['LanguageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['LanguageId' => 'id']],
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
            'Name' => 'Name',
            'ParentId' => 'Parent ID',
            'children' => 'Children',
            'url' => 'Url',
            'DisplayOrder' => 'Display Order',
            'LanguageId' => 'Language ID',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'LanguageId']);
    }
}
