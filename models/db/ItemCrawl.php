<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "item_crawl".
 *
 * @property integer $id
 * @property string $link
 * @property integer $createTime
 * @property integer $updateTime
 * @property integer $run
 * @property string $name
 * @property string $categoryLink
 * @property double $sellPrice
 * @property double $startPrice
 * @property integer $categoryId
 * @property string $content
 * @property string $images
 * @property string $currency
 * @property integer $siteId
 * @property integer $storeId
 *
 * @property Site $site
 * @property Store $store
 * @property Category $category
 */
class ItemCrawl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_crawl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime', 'run', 'categoryId', 'siteId', 'storeId'], 'integer'],
            [['sellPrice', 'startPrice'], 'number'],
            [['content', 'images'], 'string'],
            [['link'], 'string', 'max' => 250],
            [['name', 'categoryLink'], 'string', 'max' => 220],
            [['currency'], 'string', 'max' => 50],
            [['link'], 'unique'],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'run' => 'Run',
            'name' => 'Name',
            'categoryLink' => 'Category Link',
            'sellPrice' => 'Sell Price',
            'startPrice' => 'Start Price',
            'categoryId' => 'Category ID',
            'content' => 'Content',
            'images' => 'Images',
            'currency' => 'Currency',
            'siteId' => 'Site ID',
            'storeId' => 'Store ID',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }
}
