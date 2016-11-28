<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "newscategories".
 *
 * @property integer $id
 * @property integer $parentId
 * @property string $name
 * @property integer $order
 * @property string $description
 * @property integer $published
 * @property string $createTime
 * @property string $updateTime
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $footer
 * @property string $icon
 * @property integer $storeId
 * @property integer $type
 * @property integer $languageId
 * @property integer $originId
 *
 * @property News[] $news
 * @property Store $store
 * @property Language $language
 * @property Newscategories $origin
 * @property Newscategories[] $newscategories
 */
class Newscategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'newscategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId', 'order', 'published', 'footer', 'storeId', 'type', 'languageId', 'originId'], 'integer'],
            [['description'], 'string'],
            [['createTime', 'updateTime'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['createEmail', 'updateEmail', 'icon'], 'string', 'max' => 100],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['languageId' => 'id']],
            [['originId'], 'exist', 'skipOnError' => true, 'targetClass' => Newscategories::className(), 'targetAttribute' => ['originId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentId' => 'Parent ID',
            'name' => 'Name',
            'order' => 'Order',
            'description' => 'Description',
            'published' => 'Published',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'footer' => 'Footer',
            'icon' => 'Icon',
            'storeId' => 'Store ID',
            'type' => 'Type',
            'languageId' => 'Language ID',
            'originId' => 'Origin ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'languageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigin()
    {
        return $this->hasOne(Newscategories::className(), ['id' => 'originId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewscategories()
    {
        return $this->hasMany(Newscategories::className(), ['originId' => 'id']);
    }
}
