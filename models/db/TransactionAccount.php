<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_account".
 *
 * @property integer $id
 * @property string $AccountEmail
 * @property string $PhoneNumber
 * @property string $AccountNumber
 * @property string $TransactionAccountCode
 * @property integer $CustomerId
 * @property integer $AccountType
 * @property string $OpeningBalance
 * @property string $OpeningFreezeBalance
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
 * @property string $LastUpdated
 * @property string $LastAmount
 * @property integer $CheckedByEmployeeId
 * @property integer $OrganizationId
 * @property integer $StoreId
 * @property integer $Active
 * @property string $DeactiveDate
 * @property integer $IsPendding
 * @property string $PenddingFromDate
 * @property string $PenddingToDate
 * @property string $Description
 * @property integer $SiteId
 * @property string $IdentityNumber
 * @property string $IdentityIssuedDate
 * @property string $IdentityIssuedBy
 * @property string $IdentityImageUrlBefore
 * @property string $IdentityImageUrlAfter
 * @property integer $IdentityVerified
 * @property integer $IsIntialized
 * @property string $Address
 * @property string $FullName
 * @property string $Password
 * @property string $Salt
 * @property string $Note
 * @property string $VerifyOtp
 * @property integer $VerifyOtpCount
 * @property string $LastLockOtpTime
 * @property integer $VerifyLock
 * @property integer $TotalOtpCount
 * @property integer $LockInMinutes
 *
 * @property Transaction[] $transactions
 * @property Customer $customer
 * @property Organization $organization
 * @property OrganizationEmployee $checkedByEmployee
 * @property Store $store
 * @property Site $site
 * @property TransactionRequest[] $transactionRequests
 */
class TransactionAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId'], 'required'],
            [['CustomerId', 'AccountType', 'CheckedByEmployeeId', 'OrganizationId', 'StoreId', 'Active', 'IsPendding', 'SiteId', 'IdentityVerified', 'IsIntialized', 'VerifyOtpCount', 'VerifyLock', 'TotalOtpCount', 'LockInMinutes'], 'integer'],
            [['OpeningBalance', 'OpeningFreezeBalance', 'CurrentBalance', 'PromotionCurrentBalance', 'TotalBalance', 'FreezeBalance', 'FreezeBalanceDraw', 'BalanceCanShop', 'BalanceCanWithDraw', 'PreviousCurrentBlance', 'TotalCreditAmount', 'TotalDebitAmount', 'LastAmount'], 'number'],
            [['LastUpdated', 'DeactiveDate', 'PenddingFromDate', 'PenddingToDate', 'IdentityIssuedDate', 'LastLockOtpTime'], 'safe'],
            [['AccountEmail', 'Description', 'IdentityIssuedBy', 'IdentityImageUrlBefore', 'IdentityImageUrlAfter', 'Address'], 'string', 'max' => 255],
            [['PhoneNumber'], 'string', 'max' => 15],
            [['AccountNumber', 'TransactionAccountCode', 'Password'], 'string', 'max' => 50],
            [['IdentityNumber', 'Salt'], 'string', 'max' => 20],
            [['FullName'], 'string', 'max' => 200],
            [['Note'], 'string', 'max' => 500],
            [['VerifyOtp'], 'string', 'max' => 10],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
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
            'AccountEmail' => 'Account Email',
            'PhoneNumber' => 'Phone Number',
            'AccountNumber' => 'Account Number',
            'TransactionAccountCode' => 'Transaction Account Code',
            'CustomerId' => 'Customer ID',
            'AccountType' => 'Account Type',
            'OpeningBalance' => 'Opening Balance',
            'OpeningFreezeBalance' => 'Opening Freeze Balance',
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
            'LastUpdated' => 'Last Updated',
            'LastAmount' => 'Last Amount',
            'CheckedByEmployeeId' => 'Checked By Employee ID',
            'OrganizationId' => 'Organization ID',
            'StoreId' => 'Store ID',
            'Active' => 'Active',
            'DeactiveDate' => 'Deactive Date',
            'IsPendding' => 'Is Pendding',
            'PenddingFromDate' => 'Pendding From Date',
            'PenddingToDate' => 'Pendding To Date',
            'Description' => 'Description',
            'SiteId' => 'Site ID',
            'IdentityNumber' => 'Identity Number',
            'IdentityIssuedDate' => 'Identity Issued Date',
            'IdentityIssuedBy' => 'Identity Issued By',
            'IdentityImageUrlBefore' => 'Identity Image Url Before',
            'IdentityImageUrlAfter' => 'Identity Image Url After',
            'IdentityVerified' => 'Identity Verified',
            'IsIntialized' => 'Is Intialized',
            'Address' => 'Address',
            'FullName' => 'Full Name',
            'Password' => 'Password',
            'Salt' => 'Salt',
            'Note' => 'Note',
            'VerifyOtp' => 'Verify Otp',
            'VerifyOtpCount' => 'Verify Otp Count',
            'LastLockOtpTime' => 'Last Lock Otp Time',
            'VerifyLock' => 'Verify Lock',
            'TotalOtpCount' => 'Total Otp Count',
            'LockInMinutes' => 'Lock In Minutes',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['TransactionAccountId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
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
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['TransactionAccountId' => 'id']);
    }
}
