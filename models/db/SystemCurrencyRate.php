<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_currency_rate".
 *
 * @property integer $id
 * @property integer $CurrencyFromId
 * @property integer $CurrencyToId
 * @property string $Rate
 * @property string $UpdateTime
 *
 * @property SystemCurrency $currencyFrom
 * @property SystemCurrency $currencyTo
 */
class SystemCurrencyRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_currency_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CurrencyFromId', 'CurrencyToId'], 'integer'],
            [['Rate'], 'number'],
            [['UpdateTime'], 'safe'],
            [['CurrencyFromId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyFromId' => 'id']],
            [['CurrencyToId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyToId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CurrencyFromId' => 'Currency From ID',
            'CurrencyToId' => 'Currency To ID',
            'Rate' => 'Rate',
            'UpdateTime' => 'Update Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyFrom()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyFromId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyTo()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyToId']);
    }
}
