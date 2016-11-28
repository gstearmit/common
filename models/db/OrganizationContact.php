<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_contact".
 *
 * @property integer $id
 * @property string $FullName
 * @property string $Position
 * @property string $Email
 * @property string $Phone
 * @property string $Mobile
 * @property string $FromDate
 * @property string $ToDate
 * @property integer $IsActive
 * @property integer $OrganizationId
 *
 * @property Organization $organization
 */
class OrganizationContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FromDate', 'ToDate'], 'safe'],
            [['IsActive', 'OrganizationId'], 'integer'],
            [['FullName', 'Position', 'Email', 'Phone', 'Mobile'], 'string', 'max' => 50],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FullName' => 'Full Name',
            'Position' => 'Position',
            'Email' => 'Email',
            'Phone' => 'Phone',
            'Mobile' => 'Mobile',
            'FromDate' => 'From Date',
            'ToDate' => 'To Date',
            'IsActive' => 'Is Active',
            'OrganizationId' => 'Organization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'OrganizationId']);
    }
}
