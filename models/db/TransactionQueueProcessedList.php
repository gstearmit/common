<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_queue_processed_list".
 *
 * @property integer $id
 * @property string $ListName
 * @property string $Description
 * @property string $CreatedTime
 * @property integer $CreatedByEmployeeId
 * @property string $CreatedEmployeeName
 * @property string $ExportedFilePath
 * @property resource $ExportedFileBlob
 * @property string $ProcessedFilePath
 * @property resource $ProcessedFileBlob
 * @property string $ProcessTime
 * @property integer $ProcessByEmployeeId
 * @property string $ProcessByEmployeeName
 *
 * @property OrganizationEmployee $createdByEmployee
 * @property OrganizationEmployee $processByEmployee
 * @property TransactionQueueProcessedListAudit[] $transactionQueueProcessedListAudits
 */
class TransactionQueueProcessedList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_queue_processed_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime', 'ProcessTime'], 'safe'],
            [['CreatedByEmployeeId', 'ProcessByEmployeeId'], 'integer'],
            [['ExportedFileBlob', 'ProcessedFileBlob'], 'string'],
            [['ListName', 'Description', 'CreatedEmployeeName', 'ExportedFilePath', 'ProcessedFilePath', 'ProcessByEmployeeName'], 'string', 'max' => 255],
            [['CreatedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CreatedByEmployeeId' => 'id']],
            [['ProcessByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcessByEmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ListName' => 'List Name',
            'Description' => 'Description',
            'CreatedTime' => 'Created Time',
            'CreatedByEmployeeId' => 'Created By Employee ID',
            'CreatedEmployeeName' => 'Created Employee Name',
            'ExportedFilePath' => 'Exported File Path',
            'ExportedFileBlob' => 'Exported File Blob',
            'ProcessedFilePath' => 'Processed File Path',
            'ProcessedFileBlob' => 'Processed File Blob',
            'ProcessTime' => 'Process Time',
            'ProcessByEmployeeId' => 'Process By Employee ID',
            'ProcessByEmployeeName' => 'Process By Employee Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CreatedByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcessByEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedListAudits()
    {
        return $this->hasMany(TransactionQueueProcessedListAudit::className(), ['TransactionQueueProcessedListId' => 'id']);
    }
}
