<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_team_members".
 *
 * @property integer $id
 * @property integer $TeamId
 * @property integer $EmployeeId
 * @property string $DateJoined
 * @property string $DateLeft
 *
 * @property SaleTeam $team
 * @property OrganizationEmployee $employee
 */
class SaleTeamMembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_team_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TeamId', 'EmployeeId'], 'integer'],
            [['DateJoined', 'DateLeft'], 'safe'],
            [['TeamId'], 'exist', 'skipOnError' => true, 'targetClass' => SaleTeam::className(), 'targetAttribute' => ['TeamId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TeamId' => 'Team ID',
            'EmployeeId' => 'Employee ID',
            'DateJoined' => 'Date Joined',
            'DateLeft' => 'Date Left',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(SaleTeam::className(), ['id' => 'TeamId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }
}
