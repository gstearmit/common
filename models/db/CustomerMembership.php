<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_membership".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $membership_packages_id
 * @property integer $active
 * @property string $registered_time
 * @property string $expired_time
 * @property string $charge_fee
 * @property integer $payment_status
 * @property string $paid_amount
 *
 * @property Customer $customer
 * @property MembershipPackages $membershipPackages
 * @property InvoiceMapCustomerMembership[] $invoiceMapCustomerMemberships
 */
class CustomerMembership extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_membership';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'membership_packages_id', 'active', 'payment_status'], 'integer'],
            [['registered_time', 'expired_time'], 'safe'],
            [['charge_fee', 'paid_amount'], 'number'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['membership_packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => MembershipPackages::className(), 'targetAttribute' => ['membership_packages_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'membership_packages_id' => 'Membership Packages ID',
            'active' => 'Active',
            'registered_time' => 'Registered Time',
            'expired_time' => 'Expired Time',
            'charge_fee' => 'Charge Fee',
            'payment_status' => 'Payment Status',
            'paid_amount' => 'Paid Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackages()
    {
        return $this->hasOne(MembershipPackages::className(), ['id' => 'membership_packages_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapCustomerMemberships()
    {
        return $this->hasMany(InvoiceMapCustomerMembership::className(), ['customer_membership_id' => 'id']);
    }
}
