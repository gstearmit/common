<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_queue_log".
 *
 * @property integer $id
 * @property integer $TransactionQueueId
 * @property string $CreatedTime
 * @property string $Description
 *
 * @property TransactionQueue $transactionQueue
 */
class TransactionQueueLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_queue_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TransactionQueueId'], 'integer'],
            [['CreatedTime'], 'safe'],
            [['Description'], 'string', 'max' => 255],
            [['TransactionQueueId'], 'exist', 'skipOnError' => true, 'targetClass' => TransactionQueue::className(), 'targetAttribute' => ['TransactionQueueId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TransactionQueueId' => 'Transaction Queue ID',
            'CreatedTime' => 'Created Time',
            'Description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueue()
    {
        return $this->hasOne(TransactionQueue::className(), ['id' => 'TransactionQueueId']);
    }
}
