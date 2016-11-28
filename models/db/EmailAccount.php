<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "email_account".
 *
 * @property integer $id
 * @property string $Email
 * @property string $DisplayName
 * @property string $Host
 * @property integer $Port
 * @property string $Username
 * @property string $Password
 * @property integer $EnableSsl
 * @property integer $UseDefaultCredentials
 * @property integer $OrganizationId
 * @property integer $StoreId
 *
 * @property Organization $organization
 * @property Store $store
 * @property QueuedEmail[] $queuedEmails
 */
class EmailAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Port', 'EnableSsl', 'UseDefaultCredentials', 'OrganizationId', 'StoreId'], 'integer'],
            [['Email', 'DisplayName', 'Host', 'Username', 'Password'], 'string', 'max' => 255],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
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
            'Email' => 'Email',
            'DisplayName' => 'Display Name',
            'Host' => 'Host',
            'Port' => 'Port',
            'Username' => 'Username',
            'Password' => 'Password',
            'EnableSsl' => 'Enable Ssl',
            'UseDefaultCredentials' => 'Use Default Credentials',
            'OrganizationId' => 'Organization ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'OrganizationId']);
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
    public function getQueuedEmails()
    {
        return $this->hasMany(QueuedEmail::className(), ['EmailAccountId' => 'id']);
    }
}
