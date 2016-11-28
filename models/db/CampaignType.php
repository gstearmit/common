<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "campaign_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Note
 * @property integer $DisplayOrder
 * @property integer $IsActive
 * @property string $CreatedTime
 * @property integer $Deleted
 *
 * @property Campaign[] $campaigns
 */
class CampaignType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Note'], 'string'],
            [['DisplayOrder', 'IsActive', 'Deleted'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['Name'], 'string', 'max' => 100],
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
            'Note' => 'Note',
            'DisplayOrder' => 'Display Order',
            'IsActive' => 'Is Active',
            'CreatedTime' => 'Created Time',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['CampaignTypeId' => 'id']);
    }
}
