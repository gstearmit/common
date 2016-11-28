<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_external_voucher".
 *
 * @property integer $id
 * @property string $CodeVoucher
 * @property integer $TransactionExternalId
 * @property string $Description
 * @property string $CodeVoucherByThirdParty
 * @property string $TotalMoney
 * @property string $TotalMoneyInText
 * @property integer $TypeVoucher
 * @property string $TransactionCosts
 * @property string $CreationTime
 * @property integer $OperationByEmployeeId
 * @property string $OperationTime
 * @property string $OperationNote
 * @property string $ApproveTime
 * @property integer $ApproveByEmployeeId
 * @property string $ApproveNote
 * @property string $CompletionTime
 * @property integer $ProcessStatus
 * @property string $DepositFullName
 * @property string $DepositEmail
 * @property string $DepositMobile
 * @property string $DepositIdentityNumber
 * @property string $DepositAdress
 * @property integer $Status
 * @property integer $StoreId
 * @property integer $PaidStatus
 * @property string $PaidAmount
 *
 * @property TransactionExternal $transactionExternal
 * @property Store $store
 * @property OrganizationEmployee $approveByEmployee
 * @property OrganizationEmployee $operationByEmployee
 */
class TransactionExternalVoucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_external_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TransactionExternalId', 'TypeVoucher', 'OperationByEmployeeId', 'ApproveByEmployeeId', 'ProcessStatus', 'Status', 'StoreId', 'PaidStatus'], 'integer'],
            [['TotalMoney', 'TransactionCosts', 'PaidAmount'], 'number'],
            [['CreationTime', 'OperationTime', 'ApproveTime', 'CompletionTime'], 'safe'],
            [['CodeVoucher', 'CodeVoucherByThirdParty', 'DepositFullName', 'DepositEmail', 'DepositIdentityNumber'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 500],
            [['TotalMoneyInText'], 'string', 'max' => 1000],
            [['OperationNote', 'ApproveNote', 'DepositAdress'], 'string', 'max' => 255],
            [['DepositMobile'], 'string', 'max' => 20],
            [['TransactionExternalId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionExternal::className(), 'targetAttribute' => ['TransactionExternalId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['ApproveByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApproveByEmployeeId' => 'id']],
            [['OperationByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['OperationByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CodeVoucher' => 'Code Voucher',
            'TransactionExternalId' => 'Transaction External ID',
            'Description' => 'Description',
            'CodeVoucherByThirdParty' => 'Code Voucher By Third Party',
            'TotalMoney' => 'Total Money',
            'TotalMoneyInText' => 'Total Money In Text',
            'TypeVoucher' => 'Type Voucher',
            'TransactionCosts' => 'Transaction Costs',
            'CreationTime' => 'Creation Time',
            'OperationByEmployeeId' => 'Operation By Employee ID',
            'OperationTime' => 'Operation Time',
            'OperationNote' => 'Operation Note',
            'ApproveTime' => 'Approve Time',
            'ApproveByEmployeeId' => 'Approve By Employee ID',
            'ApproveNote' => 'Approve Note',
            'CompletionTime' => 'Completion Time',
            'ProcessStatus' => 'Process Status',
            'DepositFullName' => 'Deposit Full Name',
            'DepositEmail' => 'Deposit Email',
            'DepositMobile' => 'Deposit Mobile',
            'DepositIdentityNumber' => 'Deposit Identity Number',
            'DepositAdress' => 'Deposit Adress',
            'Status' => 'Status',
            'StoreId' => 'Store ID',
            'PaidStatus' => 'Paid Status',
            'PaidAmount' => 'Paid Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternal()
    {
        return $this->hasOne(TransactionExternal::className(), ['id' => 'TransactionExternalId']);
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
    public function getApproveByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ApproveByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'OperationByEmployeeId']);
    }
}
