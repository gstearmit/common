<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_team_note".
 *
 * @property integer $id
 * @property string $Note
 * @property string $CreatedDate
 * @property integer $TeamId
 *
 * @property SaleTeam $team
 */
class SaleTeamNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_team_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedDate'], 'safe'],
            [['TeamId'], 'integer'],
            [['Note'], 'string', 'max' => 400],
            [['TeamId'], 'exist', 'skipOnError' => true, 'targetClass' => SaleTeam::className(), 'targetAttribute' => ['TeamId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Note' => 'Note',
            'CreatedDate' => 'Created Date',
            'TeamId' => 'Team ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(SaleTeam::className(), ['id' => 'TeamId']);
    }
}
