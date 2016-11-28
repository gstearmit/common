<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "email_template".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Link
 * @property integer $StoreId
 * @property string $Description
 * @property integer $EmployeeId
 * @property string $CreatedTime
 * @property string $EndTime
 * @property integer $IsActive
 *
 * @property Store $store
 * @property OrganizationEmployee $employee
 * @property QueuedEmail[] $queuedEmails
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StoreId', 'EmployeeId', 'IsActive'], 'integer'],
            [['CreatedTime', 'EndTime'], 'safe'],
            [['Name'], 'string', 'max' => 200],
            [['Link'], 'string', 'max' => 500],
            [['Description'], 'string', 'max' => 255],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'Name' => 'Name',
            'Link' => 'Link',
            'StoreId' => 'Store ID',
            'Description' => 'Description',
            'EmployeeId' => 'Employee ID',
            'CreatedTime' => 'Created Time',
            'EndTime' => 'End Time',
            'IsActive' => 'Is Active',
        ];
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
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQueuedEmails()
    {
        return $this->hasMany(QueuedEmail::className(), ['TemplateId' => 'id']);
    }
}
