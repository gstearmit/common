<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_contact".
 *
 * @property integer $id
 * @property string $Relation
 * @property string $FullName
 * @property string $Postion
 * @property string $Phone
 * @property string $Mobile
 * @property string $Email
 * @property string $BirthDate
 * @property string $Hobby
 * @property string $Note
 * @property integer $IsDefaultContact
 * @property integer $DisplayOrder
 * @property integer $CustomerId
 * @property integer $IsActive
 * @property integer $Deleted
 *
 * @property Customer $customer
 */
class CustomerContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BirthDate'], 'safe'],
            [['IsDefaultContact', 'DisplayOrder', 'CustomerId', 'IsActive', 'Deleted'], 'integer'],
            [['Relation', 'FullName', 'Postion', 'Mobile', 'Email'], 'string', 'max' => 50],
            [['Phone'], 'string', 'max' => 15],
            [['Hobby', 'Note'], 'string', 'max' => 500],
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
            'Relation' => 'Relation',
            'FullName' => 'Full Name',
            'Postion' => 'Postion',
            'Phone' => 'Phone',
            'Mobile' => 'Mobile',
            'Email' => 'Email',
            'BirthDate' => 'Birth Date',
            'Hobby' => 'Hobby',
            'Note' => 'Note',
            'IsDefaultContact' => 'Is Default Contact',
            'DisplayOrder' => 'Display Order',
            'CustomerId' => 'Customer ID',
            'IsActive' => 'Is Active',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }
}
