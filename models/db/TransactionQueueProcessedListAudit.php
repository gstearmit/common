<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_queue_processed_list_audit".
 *
 * @property integer $id
 * @property integer $TransactionQueueProcessedListId
 * @property integer $StoreId
 * @property integer $TransactionAccountSystemId
 * @property string $UploadedTime
 * @property integer $UploadByEmployeeId
 * @property string $TransactionCode
 * @property string $TransactionCreatedTime
 * @property string $CompletedTime
 * @property string $TransactionTypeDescription
 * @property string $Amount
 * @property string $FromAccount
 * @property string $ToAccount
 * @property string $TransactionNote
 * @property string $TransactionStatus
 * @property integer $IsAudit
 * @property string $AuditTime
 * @property integer $AuditSucess
 * @property string $TransactionInternalRef
 * @property string $Note
 *
 * @property TransactionQueueProcessedList $transactionQueueProcessedList
 * @property Store $store
 * @property TransactionAccountSystem $transactionAccountSystem
 * @property OrganizationEmployee $uploadByEmployee
 */
class TransactionQueueProcessedListAudit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_queue_processed_list_audit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TransactionQueueProcessedListId', 'StoreId', 'TransactionAccountSystemId', 'UploadByEmployeeId', 'IsAudit', 'AuditSucess'], 'integer'],
            [['UploadedTime', 'TransactionCreatedTime', 'CompletedTime', 'AuditTime'], 'safe'],
            [['Amount'], 'number'],
            [['TransactionCode', 'TransactionTypeDescription', 'FromAccount', 'ToAccount', 'TransactionNote', 'TransactionStatus', 'TransactionInternalRef', 'Note'], 'string', 'max' => 255],
            [['TransactionQueueProcessedListId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionQueueProcessedList::className(), 'targetAttribute' => ['TransactionQueueProcessedListId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['TransactionAccountSystemId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionAccountSystem::className(), 'targetAttribute' => ['TransactionAccountSystemId' => 'id']],
            [['UploadByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['UploadByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TransactionQueueProcessedListId' => 'Transaction Queue Processed List ID',
            'StoreId' => 'Store ID',
            'TransactionAccountSystemId' => 'Transaction Account System ID',
            'UploadedTime' => 'Uploaded Time',
            'UploadByEmployeeId' => 'Upload By Employee ID',
            'TransactionCode' => 'Transaction Code',
            'TransactionCreatedTime' => 'Transaction Created Time',
            'CompletedTime' => 'Completed Time',
            'TransactionTypeDescription' => 'Transaction Type Description',
            'Amount' => 'Amount',
            'FromAccount' => 'From Account',
            'ToAccount' => 'To Account',
            'TransactionNote' => 'Transaction Note',
            'TransactionStatus' => 'Transaction Status',
            'IsAudit' => 'Is Audit',
            'AuditTime' => 'Audit Time',
            'AuditSucess' => 'Audit Sucess',
            'TransactionInternalRef' => 'Transaction Internal Ref',
            'Note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedList()
    {
        return $this->hasOne(TransactionQueueProcessedList::className(), ['id' => 'TransactionQueueProcessedListId']);
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
    public function getTransactionAccountSystem()
    {
        return $this->hasOne(TransactionAccountSystem::className(), ['id' => 'TransactionAccountSystemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploadByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'UploadByEmployeeId']);
    }
}
