<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_customer_membership".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $customer_membership_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property CustomerMembership $customerMembership
 * @property SystemAccountTransaction $systemAccountTransaction
 */
class InvoiceMapCustomerMembership extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_customer_membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'customer_membership_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['customer_membership_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerMembership::className(), 'targetAttribute' => ['customer_membership_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'customer_membership_id' => 'Customer Membership ID',
            'system_account_transaction_id' => 'System Account Transaction ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerMembership()
    {
        return $this->hasOne(CustomerMembership::className(), ['id' => 'customer_membership_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'system_account_transaction_id']);
    }
}
