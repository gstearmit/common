<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_bank_account".
 *
 * @property integer $id
 * @property string $BankName
 * @property string $BankAccountCode
 * @property string $FromDate
 * @property string $ToDate
 * @property integer $Active
 * @property integer $IsDefault
 * @property integer $OrganizationId
 * @property string $BalanceAccount
 *
 * @property Organization $organization
 */
class OrganizationBankAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_bank_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FromDate', 'ToDate'], 'safe'],
            [['Active', 'IsDefault', 'OrganizationId'], 'integer'],
            [['BalanceAccount'], 'number'],
            [['BankName', 'BankAccountCode'], 'string', 'max' => 50],
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
            'BankName' => 'Bank Name',
            'BankAccountCode' => 'Bank Account Code',
            'FromDate' => 'From Date',
            'ToDate' => 'To Date',
            'Active' => 'Active',
            'IsDefault' => 'Is Default',
            'OrganizationId' => 'Organization ID',
            'BalanceAccount' => 'Balance Account',
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
