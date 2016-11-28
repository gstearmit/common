<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "keyword".
 *
 * @property string $id
 * @property string $keyword
 * @property string $type
 * @property integer $createTime
 * @property integer $updateTime
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $active
 * @property string $objectId
 */
class Keyword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keyword';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'objectId'], 'required'],
            [['createTime', 'updateTime', 'active'], 'integer'],
            [['id', 'keyword'], 'string', 'max' => 220],
            [['type', 'createEmail', 'updateEmail', 'objectId'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keyword' => 'Keyword',
            'type' => 'Type',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'active' => 'Active',
            'objectId' => 'Object ID',
        ];
    }
}
