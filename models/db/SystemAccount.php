<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_account".
 *
 * @property integer $id
 * @property string $Description
 * @property string $AccountNumber
 * @property string $AccountEmail
 * @property string $OpeningBalance
 * @property string $CurrentBalance
 * @property string $PromotionCurrentBalance
 * @property string $TotalBalance
 * @property string $FreezeBalance
 * @property string $FreezeBalanceDraw
 * @property string $BalanceCanShop
 * @property string $BalanceCanWithDraw
 * @property string $PreviousCurrentBlance
 * @property string $TotalCreditAmount
 * @property string $TotalDebitAmount
 * @property string $Note
 * @property string $LastUpdated
 * @property string $LastAmount
 * @property integer $CheckedByEmployeeId
 * @property integer $OrganizationId
 * @property integer $SiteId
 * @property integer $StoreId
 * @property string $ApprovedDate
 * @property integer $Active
 * @property integer $IsPendding
 * @property string $PenddingFromDate
 * @property string $PenddingToDate
 * @property string $DeactiveDate
 *
 * @property Organization $organization
 * @property OrganizationEmployee $checkedByEmployee
 * @property Store $store
 * @property Site $site
 * @property SystemAccountTransaction[] $systemAccountTransactions
 */
class SystemAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OpeningBalance', 'CurrentBalance', 'PromotionCurrentBalance', 'TotalBalance', 'FreezeBalance', 'FreezeBalanceDraw', 'BalanceCanShop', 'BalanceCanWithDraw', 'PreviousCurrentBlance', 'TotalCreditAmount', 'TotalDebitAmount'], 'number'],
            [['LastUpdated', 'ApprovedDate', 'PenddingFromDate', 'PenddingToDate', 'DeactiveDate'], 'safe'],
            [['CheckedByEmployeeId', 'OrganizationId', 'SiteId', 'StoreId', 'Active', 'IsPendding'], 'integer'],
            [['Description', 'AccountEmail'], 'string', 'max' => 255],
            [['AccountNumber', 'LastAmount'], 'string', 'max' => 50],
            [['Note'], 'string', 'max' => 500],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
            [['CheckedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CheckedByEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['SiteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['SiteId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Description' => 'Description',
            'AccountNumber' => 'Account Number',
            'AccountEmail' => 'Account Email',
            'OpeningBalance' => 'Opening Balance',
            'CurrentBalance' => 'Current Balance',
            'PromotionCurrentBalance' => 'Promotion Current Balance',
            'TotalBalance' => 'Total Balance',
            'FreezeBalance' => 'Freeze Balance',
            'FreezeBalanceDraw' => 'Freeze Balance Draw',
            'BalanceCanShop' => 'Balance Can Shop',
            'BalanceCanWithDraw' => 'Balance Can With Draw',
            'PreviousCurrentBlance' => 'Previous Current Blance',
            'TotalCreditAmount' => 'Total Credit Amount',
            'TotalDebitAmount' => 'Total Debit Amount',
            'Note' => 'Note',
            'LastUpdated' => 'Last Updated',
            'LastAmount' => 'Last Amount',
            'CheckedByEmployeeId' => 'Checked By Employee ID',
            'OrganizationId' => 'Organization ID',
            'SiteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'ApprovedDate' => 'Approved Date',
            'Active' => 'Active',
            'IsPendding' => 'Is Pendding',
            'PenddingFromDate' => 'Pendding From Date',
            'PenddingToDate' => 'Pendding To Date',
            'DeactiveDate' => 'Deactive Date',
        ];
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
    public function getCheckedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CheckedByEmployeeId']);
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'SiteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['SystemAccountId' => 'id']);
    }
}
