<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "locale_string_resource".
 *
 * @property integer $id
 * @property integer $LanguageId
 * @property string $ResourceName
 * @property string $ResourceValue
 * @property integer $Active
 * @property integer $Type
 *
 * @property Language $language
 */
class LocaleStringResource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locale_string_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LanguageId', 'Active', 'Type'], 'integer'],
            [['ResourceValue'], 'string'],
            [['ResourceName'], 'string', 'max' => 200],
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
            'LanguageId' => 'Language ID',
            'ResourceName' => 'Resource Name',
            'ResourceValue' => 'Resource Value',
            'Active' => 'Active',
            'Type' => 'Type',
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
