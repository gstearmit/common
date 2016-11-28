<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cmspage".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $SeoDescription
 * @property string $SeoTitle
 * @property string $SeoKeyword
 * @property integer $LanguageId
 * @property integer $siteId
 * @property string $alias
 * @property boolean $active
 * @property integer $type
 * @property string $startTime
 * @property string $endTime
 * @property string $image
 * @property string $link
 * @property string $tracking
 * @property integer $storeId
 *
 * @property CmsBlock[] $cmsBlocks
 * @property Language $language
 * @property Site $site
 * @property Store $store
 */
class Cmspage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmspage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LanguageId', 'siteId', 'type', 'storeId'], 'integer'],
            [['active'], 'boolean'],
            [['startTime', 'endTime'], 'safe'],
            [['Name'], 'string', 'max' => 400],
            [['Description'], 'string', 'max' => 4000],
            [['SeoDescription', 'SeoTitle', 'SeoKeyword', 'link', 'tracking'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 50],
            [['image'], 'string', 'max' => 500],
            [['LanguageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['LanguageId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'SeoDescription' => 'Seo Description',
            'SeoTitle' => 'Seo Title',
            'SeoKeyword' => 'Seo Keyword',
            'LanguageId' => 'Language ID',
            'siteId' => 'Site ID',
            'alias' => 'Alias',
            'active' => 'Active',
            'type' => 'Type',
            'startTime' => 'Start Time',
            'endTime' => 'End Time',
            'image' => 'Image',
            'link' => 'Link',
            'tracking' => 'Tracking',
            'storeId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlocks()
    {
        return $this->hasMany(CmsBlock::className(), ['pageId' => 'id']);
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }
}
