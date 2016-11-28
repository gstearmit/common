<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "landing".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $Description
 * @property string $ProductsList
 * @property string $HtmlContent
 * @property integer $CampaingId
 *
 * @property Campaign $campaing
 */
class Landing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductsList', 'HtmlContent'], 'string'],
            [['CampaingId'], 'integer'],
            [['Name', 'Description'], 'string', 'max' => 255],
            [['CampaingId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['CampaingId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'ProductsList' => 'Products List',
            'HtmlContent' => 'Html Content',
            'CampaingId' => 'Campaing ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaing()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'CampaingId']);
    }
}
