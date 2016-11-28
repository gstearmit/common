<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $categoryId
 * @property integer $userId
 * @property string $image
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $published
 * @property integer $order
 * @property string $createDate
 * @property string $updateDate
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $storeId
 * @property integer $type
 * @property integer $languageId
 * @property integer $originId
 *
 * @property Store $store
 * @property Newscategories $category
 * @property Language $language
 * @property News $origin
 * @property News[] $news
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'userId', 'published', 'order', 'storeId', 'type', 'languageId', 'originId'], 'integer'],
            [['content'], 'string'],
            [['createDate', 'updateDate'], 'safe'],
            [['image'], 'string', 'max' => 250],
            [['name'], 'string', 'max' => 2500],
            [['description'], 'string', 'max' => 4000],
            [['createEmail', 'updateEmail'], 'string', 'max' => 255],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Newscategories::className(), 'targetAttribute' => ['categoryId' => 'id']],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['languageId' => 'id']],
            [['originId'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['originId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
            'userId' => 'User ID',
            'image' => 'Image',
            'name' => 'Name',
            'description' => 'Description',
            'content' => 'Content',
            'published' => 'Published',
            'order' => 'Order',
            'createDate' => 'Create Date',
            'updateDate' => 'Update Date',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'storeId' => 'Store ID',
            'type' => 'Type',
            'languageId' => 'Language ID',
            'originId' => 'Origin ID',
        ];
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
    public function getCategory()
    {
        return $this->hasOne(Newscategories::className(), ['id' => 'categoryId']);
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
        return $this->hasOne(News::className(), ['id' => 'originId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['originId' => 'id']);
    }
}
