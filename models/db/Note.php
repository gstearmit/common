<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "note".
 *
 * @property integer $id
 * @property string $type
 * @property string $message
 * @property integer $createTime
 * @property string $email
 * @property integer $updateTime
 * @property string $colone
 * @property string $coltwo
 * @property string $colthree
 * @property string $colfour
 * @property string $objectId
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['createTime', 'updateTime'], 'integer'],
            [['type'], 'string', 'max' => 50],
            [['email', 'colone', 'coltwo', 'colthree', 'colfour', 'objectId'], 'string', 'max' => 220],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'message' => 'Message',
            'createTime' => 'Create Time',
            'email' => 'Email',
            'updateTime' => 'Update Time',
            'colone' => 'Colone',
            'coltwo' => 'Coltwo',
            'colthree' => 'Colthree',
            'colfour' => 'Colfour',
            'objectId' => 'Object ID',
        ];
    }
}
