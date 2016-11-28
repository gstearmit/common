<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "role_function".
 *
 * @property integer $id
 * @property integer $roleId
 * @property integer $functionId
 * @property integer $Active
 *
 * @property Roles $role
 * @property Functions $function
 */
class RoleFunction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_function';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['roleId', 'functionId', 'Active'], 'integer'],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['roleId' => 'id']],
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
            'roleId' => 'Role ID',
            'functionId' => 'Function ID',
            'Active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'roleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunction()
    {
        return $this->hasOne(Functions::className(), ['id' => 'functionId']);
    }
}
