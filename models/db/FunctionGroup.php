<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "function_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $DisplayOrder
 * @property integer $LanguageId
 *
 * @property Language $language
 * @property Functions[] $functions
 */
class FunctionGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'function_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DisplayOrder', 'LanguageId'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'description' => 'Description',
            'DisplayOrder' => 'Display Order',
            'LanguageId' => 'Language ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'LanguageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunctions()
    {
        return $this->hasMany(Functions::className(), ['groupFunctionId' => 'id']);
    }
}
