<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user_function".
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $functionId
 * @property integer $Active
 * @property string $roleId
 * @property integer $inherit
 * @property integer $userfunction
 *
 * @property User $user
 * @property Functions $function
 */
class UserFunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_function';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'functionId', 'Active', 'inherit', 'userfunction'], 'integer'],
            [['roleId'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['functionId'], 'exist', 'skipOnError' => true, 'targetClass' => Functions::className(), 'targetAttribute' => ['functionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'functionId' => 'Function ID',
            'Active' => 'Active',
            'roleId' => 'Role ID',
            'inherit' => 'Inherit',
            'userfunction' => 'Userfunction',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunction()
    {
        return $this->hasOne(Functions::className(), ['id' => 'functionId']);
    }
}
