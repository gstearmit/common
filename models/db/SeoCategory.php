<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "seo_category".
 *
 * @property integer $id
 * @property integer $category_Id
 * @property string $name
 * @property string $description
 * @property integer $parent_Id
 * @property string $url
 * @property string $path
 * @property integer $language_Id
 * @property integer $landing_Id
 *
 * @property Language $language
 * @property SeoLanding $landing
 */
class SeoCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_Id', 'parent_Id', 'language_Id', 'landing_Id'], 'integer'],
            [['name', 'description', 'path'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 500],
            [['language_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_Id' => 'id']],
            [['landing_Id'], 'exist', 'skipOnError' => true, 'targetClass' => SeoLanding::className(), 'targetAttribute' => ['landing_Id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_Id' => 'Category  ID',
            'name' => 'Name',
            'description' => 'Description',
            'parent_Id' => 'Parent  ID',
            'url' => 'Url',
            'path' => 'Path',
            'language_Id' => 'Language  ID',
            'landing_Id' => 'Landing  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanding()
    {
        return $this->hasOne(SeoLanding::className(), ['id' => 'landing_Id']);
    }
}
