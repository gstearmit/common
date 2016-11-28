<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_point_convert_setting".
 *
 * @property integer $id
 * @property string $fromPrice
 * @property string $toPrice
 * @property string $rate
 * @property integer $active
 * @property string $fromDate
 * @property string $toDate
 * @property integer $autoAddWallet
 * @property integer $exchangePoint
 * @property integer $siteId
 *
 * @property Site $site
 */
class SystemPointConvertSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_point_convert_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromPrice', 'toPrice', 'rate'], 'number'],
            [['active', 'autoAddWallet', 'exchangePoint', 'siteId'], 'integer'],
            [['fromDate', 'toDate'], 'safe'],
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
            'fromPrice' => 'From Price',
            'toPrice' => 'To Price',
            'rate' => 'Rate',
            'active' => 'Active',
            'fromDate' => 'From Date',
            'toDate' => 'To Date',
            'autoAddWallet' => 'Auto Add Wallet',
            'exchangePoint' => 'Exchange Point',
            'siteId' => 'Site ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }
}
