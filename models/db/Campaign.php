<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Subject
 * @property string $Body
 * @property integer $CampaignTypeId
 * @property string $ActiveFromDate
 * @property string $ActiveToDate
 * @property integer $CreatedByEmployeeId
 * @property integer $IsActive
 * @property string $CreatedTime
 * @property integer $Status
 *
 * @property Banner[] $banners
 * @property CampaignType $campaignType
 * @property OrganizationEmployee $createdByEmployee
 * @property CustomerCampaigns[] $customerCampaigns
 * @property Landing[] $landings
 * @property Order[] $orders
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 * @property QueuedEmail[] $queuedEmails
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Subject', 'Body'], 'string'],
            [['CampaignTypeId', 'CreatedByEmployeeId', 'IsActive', 'Status'], 'integer'],
            [['ActiveFromDate', 'ActiveToDate', 'CreatedTime'], 'safe'],
            [['CampaignTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => CampaignType::className(), 'targetAttribute' => ['CampaignTypeId' => 'id']],
            [['CreatedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CreatedByEmployeeId' => 'id']],
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
            'Subject' => 'Subject',
            'Body' => 'Body',
            'CampaignTypeId' => 'Campaign Type ID',
            'ActiveFromDate' => 'Active From Date',
            'ActiveToDate' => 'Active To Date',
            'CreatedByEmployeeId' => 'Created By Employee ID',
            'IsActive' => 'Is Active',
            'CreatedTime' => 'Created Time',
            'Status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['CampaignId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignType()
    {
        return $this->hasOne(CampaignType::className(), ['id' => 'CampaignTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CreatedByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCampaigns()
    {
        return $this->hasMany(CustomerCampaigns::className(), ['Campaign_Id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLandings()
    {
        return $this->hasMany(Landing::className(), ['CampaingId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['CampSourceId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['CampaignId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['CampaignId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueuedEmails()
    {
        return $this->hasMany(QueuedEmail::className(), ['CampaignId' => 'id']);
    }
}
