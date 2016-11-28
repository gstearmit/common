<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property string $name
 * @property string $objectId
 * @property integer $active
 * @property string $link
 * @property integer $position
 * @property string $type
 * @property integer $siteId
 * @property string $StartTime
 * @property string $EndTime
 * @property double $Width
 * @property double $Height
 * @property integer $CampaignId
 * @property integer $CategoryId
 * @property integer $PageId
 * @property integer $StoreId
 *
 * @property Category $category
 * @property Campaign $campaign
 * @property Store $store
 * @property Site $site
 * @property BannerLog[] $bannerLogs
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'position', 'siteId', 'CampaignId', 'CategoryId', 'PageId', 'StoreId'], 'integer'],
            [['StartTime', 'EndTime'], 'safe'],
            [['Width', 'Height'], 'number'],
            [['name', 'link'], 'string', 'max' => 220],
            [['objectId', 'type'], 'string', 'max' => 50],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['CampaignId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['CampaignId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
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
            'objectId' => 'Object ID',
            'active' => 'Active',
            'link' => 'Link',
            'position' => 'Position',
            'type' => 'Type',
            'siteId' => 'Site ID',
            'StartTime' => 'Start Time',
            'EndTime' => 'End Time',
            'Width' => 'Width',
            'Height' => 'Height',
            'CampaignId' => 'Campaign ID',
            'CategoryId' => 'Category ID',
            'PageId' => 'Page ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'CampaignId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
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
    public function getBannerLogs()
    {
        return $this->hasMany(BannerLog::className(), ['BannerId' => 'id']);
    }
}
