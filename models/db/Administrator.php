<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "administrator".
 *
 * @property integer $id
 * @property string $email
 * @property string $description
 * @property integer $joinTime
 * @property integer $active
 * @property string $lastTime
 * @property integer $role
 * @property string $rememberKey
 * @property integer $siteId
 * @property integer $StoreId
 * @property string $password_hash
 * @property string $username
 * @property string $password_reset_token
 * @property string $auth_key
 *
 * @property Site $site
 * @property Store $store
 */
class Administrator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['joinTime', 'active', 'role', 'siteId', 'StoreId'], 'integer'],
            [['lastTime'], 'safe'],
            [['email'], 'string', 'max' => 100],
            [['rememberKey'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['username', 'auth_key'], 'string', 'max' => 200],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
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
            'email' => 'Email',
            'description' => 'Description',
            'joinTime' => 'Join Time',
            'active' => 'Active',
            'lastTime' => 'Last Time',
            'role' => 'Role',
            'rememberKey' => 'Remember Key',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'password_hash' => 'Password Hash',
            'username' => 'Username',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }
}
