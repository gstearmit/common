<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "functions".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $view
 * @property string $controller
 * @property string $linkInfo
 * @property string $action
 * @property integer $groupFunctionId
 * @property integer $Active
 *
 * @property FunctionGroup $groupFunction
 * @property RoleFunction[] $roleFunctions
 * @property UserFunction[] $userFunctions
 */
class Functions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'functions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['groupFunctionId', 'Active'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description', 'view', 'controller', 'linkInfo', 'action'], 'string', 'max' => 255],
            [['groupFunctionId'], 'exist', 'skipOnError' => true, 'targetClass' => FunctionGroup::className(), 'targetAttribute' => ['groupFunctionId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'view' => 'View',
            'controller' => 'Controller',
            'linkInfo' => 'Link Info',
            'action' => 'Action',
            'groupFunctionId' => 'Group Function ID',
            'Active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupFunction()
    {
        return $this->hasOne(FunctionGroup::className(), ['id' => 'groupFunctionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleFunctions()
    {
        return $this->hasMany(RoleFunction::className(), ['functionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFunctions()
    {
        return $this->hasMany(UserFunction::className(), ['functionId' => 'id']);
    }
}
