<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "auction_infos_note".
 *
 * @property integer $id
 * @property integer $auction_infos_id
 * @property integer $user_id
 * @property string $createdTime
 * @property string $note
 * @property integer $type_id
 * @property integer $employee_id
 * @property string $employee_name
 *
 * @property AuctionInfos $auctionInfos
 * @property OrganizationEmployee $employee
 */
class AuctionInfosNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auction_infos_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auction_infos_id', 'user_id', 'type_id', 'employee_id'], 'integer'],
            [['createdTime'], 'safe'],
            [['note'], 'string', 'max' => 1000],
            [['employee_name'], 'string', 'max' => 255],
            [['auction_infos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuctionInfos::className(), 'targetAttribute' => ['auction_infos_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auction_infos_id' => 'Auction Infos ID',
            'user_id' => 'User ID',
            'createdTime' => 'Created Time',
            'note' => 'Note',
            'type_id' => 'Type ID',
            'employee_id' => 'Employee ID',
            'employee_name' => 'Employee Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasOne(AuctionInfos::className(), ['id' => 'auction_infos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'employee_id']);
    }
}
