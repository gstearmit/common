<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_account_transaction_voucher".
 *
 * @property integer $id
 * @property string $CodeVoucher
 * @property integer $CustomerId
 * @property string $CreationTime
 * @property integer $SystemAccountTransactionId
 * @property string $Description
 * @property string $CodeVoucherByThirdParty
 * @property string $TotalMoney
 * @property integer $TypeVoucher
 * @property string $TransactionCosts
 * @property integer $OperationByEmployeeId
 * @property string $OperationTime
 * @property string $OperationNote
 * @property string $ApproveTime
 * @property integer $ApproveByEmployeeId
 * @property string $ApproveNote
 * @property string $CompletionTime
 * @property integer $ProcessStatus
 * @property string $FullName
 * @property string $Email
 * @property string $Mobile
 * @property string $IdentityNumber
 * @property string $Address
 * @property integer $PaymentStatus
 * @property string $PaidAmount
 * @property integer $StoreId
 *
 * @property Shipment[] $shipments
 * @property SystemAccountTransaction $systemAccountTransaction
 * @property Store $store
 * @property OrganizationEmployee $operationByEmployee
 * @property OrganizationEmployee $approveByEmployee
 * @property Customer $customer
 */
class SystemAccountTransactionVoucher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_account_transaction_voucher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'SystemAccountTransactionId', 'TypeVoucher', 'OperationByEmployeeId', 'ApproveByEmployeeId', 'ProcessStatus', 'PaymentStatus', 'StoreId'], 'integer'],
            [['CreationTime', 'OperationTime', 'ApproveTime', 'CompletionTime'], 'safe'],
            [['TotalMoney', 'TransactionCosts', 'PaidAmount'], 'number'],
            [['CodeVoucher', 'CodeVoucherByThirdParty', 'FullName', 'Email', 'IdentityNumber'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 500],
            [['OperationNote', 'ApproveNote', 'Address'], 'string', 'max' => 255],
            [['Mobile'], 'string', 'max' => 20],
            [['SystemAccountTransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['SystemAccountTransactionId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['OperationByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['OperationByEmployeeId' => 'id']],
            [['ApproveByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ApproveByEmployeeId' => 'id']],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
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
            'CustomerId' => 'Customer ID',
            'CreationTime' => 'Creation Time',
            'SystemAccountTransactionId' => 'System Account Transaction ID',
            'Description' => 'Description',
            'CodeVoucherByThirdParty' => 'Code Voucher By Third Party',
            'TotalMoney' => 'Total Money',
            'TypeVoucher' => 'Type Voucher',
            'TransactionCosts' => 'Transaction Costs',
            'OperationByEmployeeId' => 'Operation By Employee ID',
            'OperationTime' => 'Operation Time',
            'OperationNote' => 'Operation Note',
            'ApproveTime' => 'Approve Time',
            'ApproveByEmployeeId' => 'Approve By Employee ID',
            'ApproveNote' => 'Approve Note',
            'CompletionTime' => 'Completion Time',
            'ProcessStatus' => 'Process Status',
            'FullName' => 'Full Name',
            'Email' => 'Email',
            'Mobile' => 'Mobile',
            'IdentityNumber' => 'Identity Number',
            'Address' => 'Address',
            'PaymentStatus' => 'Payment Status',
            'PaidAmount' => 'Paid Amount',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['SystemAccountTransactionVoucherId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'SystemAccountTransactionId']);
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }
}
