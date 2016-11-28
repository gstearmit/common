<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_kpi".
 *
 * @property integer $id
 * @property integer $PeriodType
 * @property integer $Target
 * @property string $Actual
 * @property string $PercentageCompleted
 * @property string $ReportedDate
 */
class SaleKpi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_kpi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PeriodType', 'Target'], 'integer'],
            [['PercentageCompleted'], 'number'],
            [['ReportedDate'], 'safe'],
            [['Actual'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PeriodType' => 'Period Type',
            'Target' => 'Target',
            'Actual' => 'Actual',
            'PercentageCompleted' => 'Percentage Completed',
            'ReportedDate' => 'Reported Date',
        ];
    }
}
