<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_account_system".
 *
 * @property integer $id
 * @property string $AccountNumber
 * @property string $AccountEmail
 * @property string $AccountToken
 * @property string $AccountBankId
 * @property integer $ParentAccountId
 * @property string $Description
 * @property string $OpeningBalance
 * @property string $CurrentBalance
 * @property string $TotalCreditAmount
 * @property string $TotalDebitAmount
 * @property string $PreviousCurrentBlance
 * @property string $LastAmount
 * @property string $LastUpdated
 * @property integer $LastModifyEmployeeId
 * @property string $Note
 * @property integer $OrganizationId
 * @property integer $StoreId
 * @property integer $Active
 * @property string $AccountRefPaymentMapping
 * @property integer $PaymentProviderId
 *
 * @property Organization $organization
 * @property OrganizationEmployee $lastModifyEmployee
 * @property Store $store
 * @property PaymentProvider $paymentProvider
 * @property TransactionExternal[] $transactionExternals
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionQueue[] $transactionQueues0
 * @property TransactionQueueProcessedListAudit[] $transactionQueueProcessedListAudits
 */
class TransactionAccountSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_account_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ParentAccountId', 'LastModifyEmployeeId', 'OrganizationId', 'StoreId', 'Active', 'PaymentProviderId'], 'integer'],
            [['OpeningBalance', 'CurrentBalance', 'TotalCreditAmount', 'TotalDebitAmount', 'PreviousCurrentBlance', 'LastAmount'], 'number'],
            [['LastUpdated'], 'safe'],
            [['AccountNumber'], 'string', 'max' => 50],
            [['AccountEmail', 'AccountToken', 'AccountBankId', 'Description', 'AccountRefPaymentMapping'], 'string', 'max' => 255],
            [['Note'], 'string', 'max' => 500],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
            [['LastModifyEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['LastModifyEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['PaymentProviderId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentProvider::className(), 'targetAttribute' => ['PaymentProviderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'AccountNumber' => 'Account Number',
            'AccountEmail' => 'Account Email',
            'AccountToken' => 'Account Token',
            'AccountBankId' => 'Account Bank ID',
            'ParentAccountId' => 'Parent Account ID',
            'Description' => 'Description',
            'OpeningBalance' => 'Opening Balance',
            'CurrentBalance' => 'Current Balance',
            'TotalCreditAmount' => 'Total Credit Amount',
            'TotalDebitAmount' => 'Total Debit Amount',
            'PreviousCurrentBlance' => 'Previous Current Blance',
            'LastAmount' => 'Last Amount',
            'LastUpdated' => 'Last Updated',
            'LastModifyEmployeeId' => 'Last Modify Employee ID',
            'Note' => 'Note',
            'OrganizationId' => 'Organization ID',
            'StoreId' => 'Store ID',
            'Active' => 'Active',
            'AccountRefPaymentMapping' => 'Account Ref Payment Mapping',
            'PaymentProviderId' => 'Payment Provider ID',
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
    public function getLastModifyEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'LastModifyEmployeeId']);
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
    public function getPaymentProvider()
    {
        return $this->hasOne(PaymentProvider::className(), ['id' => 'PaymentProviderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternals()
    {
        return $this->hasMany(TransactionExternal::className(), ['BenefitTransactionAccountSystemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['ToRefAccountSystemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues0()
    {
        return $this->hasMany(TransactionQueue::className(), ['FromRefAccountSystemId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedListAudits()
    {
        return $this->hasMany(TransactionQueueProcessedListAudit::className(), ['TransactionAccountSystemId' => 'id']);
    }
}
