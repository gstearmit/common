<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "ebay_update_schedule".
 *
 * @property integer $id
 * @property integer $timeLeft
 * @property integer $updateStep
 * @property boolean $active
 * @property integer $type
 */
class EbayUpdateSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ebay_update_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['timeLeft', 'updateStep'], 'required'],
            [['timeLeft', 'updateStep', 'type'], 'integer'],
            [['active'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'timeLeft' => 'Time Left',
            'updateStep' => 'Update Step',
            'active' => 'Active',
            'type' => 'Type',
        ];
    }
}
