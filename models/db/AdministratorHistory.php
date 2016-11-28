<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "administrator_history".
 *
 * @property integer $id
 * @property integer $time
 * @property string $email
 * @property string $action
 * @property string $get
 * @property string $post
 * @property string $json
 * @property string $ip
 */
class AdministratorHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrator_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time'], 'integer'],
            [['get', 'post', 'json'], 'string'],
            [['email'], 'string', 'max' => 50],
            [['action', 'ip'], 'string', 'max' => 220],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'email' => 'Email',
            'action' => 'Action',
            'get' => 'Get',
            'post' => 'Post',
            'json' => 'Json',
            'ip' => 'Ip',
        ];
    }
}
