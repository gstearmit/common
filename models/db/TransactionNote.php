<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "transaction_note".
 *
 * @property integer $id
 * @property string $CreatedDate
 * @property string $Action
 * @property string $Note
 * @property integer $EmployeeId
 * @property integer $TransactionId
 *
 * @property Transaction $transaction
 * @property OrganizationEmployee $employee
 */
class TransactionNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedDate'], 'safe'],
            [['EmployeeId', 'TransactionId'], 'integer'],
            [['Action'], 'string', 'max' => 500],
            [['Note'], 'string', 'max' => 1000],
            [['TransactionId'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['TransactionId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CreatedDate' => 'Created Date',
            'Action' => 'Action',
            'Note' => 'Note',
            'EmployeeId' => 'Employee ID',
            'TransactionId' => 'Transaction ID',
        ];
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
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }
}
