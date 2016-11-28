<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_point_wallet_convert".
 *
 * @property integer $id
 * @property integer $fromPoint
 * @property integer $toPoint
 * @property integer $rate
 * @property string $convertAmount
 * @property integer $siteId
 *
 * @property Site $site
 */
class SystemPointWalletConvert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_point_wallet_convert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fromPoint', 'toPoint', 'rate', 'siteId'], 'integer'],
            [['convertAmount'], 'number'],
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
            'fromPoint' => 'From Point',
            'toPoint' => 'To Point',
            'rate' => 'Rate',
            'convertAmount' => 'Convert Amount',
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
