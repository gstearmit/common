<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_claim_conversation".
 *
 * @property integer $id
 * @property integer $organizationEmployeeId
 * @property string $createdTime
 * @property string $content
 * @property integer $claimId
 * @property integer $type
 *
 * @property OrganizationEmployee $organizationEmployee
 * @property CustomerClaim $claim
 */
class CustomerClaimConversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_claim_conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organizationEmployeeId', 'claimId', 'type'], 'integer'],
            [['createdTime'], 'safe'],
            [['content'], 'string', 'max' => 255],
            [['organizationEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['organizationEmployeeId' => 'id']],
            [['claimId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerClaim::className(), 'targetAttribute' => ['claimId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organizationEmployeeId' => 'Organization Employee ID',
            'createdTime' => 'Created Time',
            'content' => 'Content',
            'claimId' => 'Claim ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'organizationEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaim()
    {
        return $this->hasOne(CustomerClaim::className(), ['id' => 'claimId']);
    }
}
