<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_team".
 *
 * @property integer $id
 * @property string $TeamName
 * @property integer $OrganizationId
 * @property integer $StoreId
 * @property integer $TeamLeaderId
 * @property integer $IsActive
 *
 * @property Order[] $orders
 * @property Organization $organization
 * @property Store $store
 * @property OrganizationEmployee $teamLeader
 * @property SaleTeamMembers[] $saleTeamMembers
 * @property SaleTeamNote[] $saleTeamNotes
 */
class SaleTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrganizationId', 'StoreId', 'TeamLeaderId', 'IsActive'], 'integer'],
            [['TeamName'], 'string', 'max' => 100],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['TeamLeaderId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['TeamLeaderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TeamName' => 'Team Name',
            'OrganizationId' => 'Organization ID',
            'StoreId' => 'Store ID',
            'TeamLeaderId' => 'Team Leader ID',
            'IsActive' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['ManageSaleTeamId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'OrganizationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamLeader()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'TeamLeaderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeamMembers()
    {
        return $this->hasMany(SaleTeamMembers::className(), ['TeamId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeamNotes()
    {
        return $this->hasMany(SaleTeamNote::className(), ['TeamId' => 'id']);
    }
}
