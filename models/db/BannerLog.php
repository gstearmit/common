<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "banner_log".
 *
 * @property integer $id
 * @property string $FromIP
 * @property string $FromDevice
 * @property string $FromBrowser
 * @property integer $UserId
 * @property integer $BannerId
 * @property integer $AffiliateId
 * @property integer $siteId
 *
 * @property Banner $banner
 * @property Affiliate $affiliate
 * @property Site $site
 * @property OrganizationEmployee $user
 */
class BannerLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'BannerId', 'AffiliateId', 'siteId'], 'integer'],
            [['FromIP', 'FromDevice', 'FromBrowser'], 'string', 'max' => 100],
            [['BannerId'], 'exist', 'skipOnError' => true, 'targetClass' => Banner::className(), 'targetAttribute' => ['BannerId' => 'id']],
            [['AffiliateId'], 'exist', 'skipOnError' => true, 'targetClass' => Affiliate::className(), 'targetAttribute' => ['AffiliateId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['UserId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['UserId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FromIP' => 'From Ip',
            'FromDevice' => 'From Device',
            'FromBrowser' => 'From Browser',
            'UserId' => 'User ID',
            'BannerId' => 'Banner ID',
            'AffiliateId' => 'Affiliate ID',
            'siteId' => 'Site ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'BannerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliate()
    {
        return $this->hasOne(Affiliate::className(), ['id' => 'AffiliateId']);
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
    public function getUser()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'UserId']);
    }
}
