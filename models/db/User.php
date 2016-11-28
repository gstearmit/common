<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property string $fullname
 * @property string $avatar
 * @property string $addres
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $currency
 * @property string $joinTime
 * @property string $lastTime
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OrganizationEmployee[] $organizationEmployees
 * @property UserFunction[] $userFunctions
 * @property UserRole[] $userRoles
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['joinTime', 'lastTime', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['username', 'email', 'fullname', 'auth_key'], 'string', 'max' => 200],
            [['password_hash', 'avatar', 'addres', 'password_reset_token'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'fullname' => 'Fullname',
            'avatar' => 'Avatar',
            'addres' => 'Addres',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'currency' => 'Currency',
            'joinTime' => 'Join Time',
            'lastTime' => 'Last Time',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationEmployees()
    {
        return $this->hasMany(OrganizationEmployee::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFunctions()
    {
        return $this->hasMany(UserFunction::className(), ['userId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['userId' => 'id']);
    }
}
