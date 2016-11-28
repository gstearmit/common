<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_voucher".
 *
 * @property integer $id
 * @property string $CodeVoucher
 * @property integer $TransactionRequestId
 * @property integer $TransactionId
 * @property string $Description
 * @property string $CodeVoucherByThirdParty
 * @property string $TotalMoney
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
 * @property integer $PaymentStatus
 * @property string $PaidAmount
 *
 * @property TransactionRequest $transactionRequest
 * @property Transaction $transaction
 * @property OrganizationEmployee $operationByEmployee
 * @property OrganizationEmployee $approveByEmployee
 * @property Store $store
 */
class TransactionVoucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TransactionRequestId', 'TransactionId', 'TypeVoucher', 'OperationByEmployeeId', 'ApproveByEmployeeId', 'ProcessStatus', 'Status', 'StoreId', 'PaymentStatus'], 'integer'],
            [['TotalMoney', 'TransactionCosts', 'PaidAmount'], 'number'],
            [['CreationTime', 'OperationTime', 'ApproveTime', 'CompletionTime'], 'safe'],
            [['CodeVoucher', 'CodeVoucherByThirdParty', 'DepositFullName', 'DepositEmail', 'DepositIdentityNumber'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 500],
            [['OperationNote', 'ApproveNote', 'DepositAdress'], 'string', 'max' => 255],
            [['DepositMobile'], 'string', 'max' => 20],
            [['TransactionRequestId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionRequest::className(), 'targetAttribute' => ['TransactionRequestId' => 'id']],
            [['TransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['TransactionId' => 'id']],
            [['OperationByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['OperationByEmployeeId' => 'id']],
            [['ApproveByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApproveByEmployeeId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'TransactionRequestId' => 'Transaction Request ID',
            'TransactionId' => 'Transaction ID',
            'Description' => 'Description',
            'CodeVoucherByThirdParty' => 'Code Voucher By Third Party',
            'TotalMoney' => 'Total Money',
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
            'PaymentStatus' => 'Payment Status',
            'PaidAmount' => 'Paid Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequest()
    {
        return $this->hasOne(TransactionRequest::className(), ['id' => 'TransactionRequestId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'TransactionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'OperationByEmployeeId']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
