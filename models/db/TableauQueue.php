<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tableau_queue".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $createTime
 * @property boolean $isSuccess
 * @property integer $sentCount
 */
class TableauQueue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tableau_queue';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['createTime'], 'safe'],
            [['isSuccess'], 'boolean'],
            [['sentCount'], 'integer'],
            [['key'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'createTime' => 'Create Time',
            'isSuccess' => 'Is Success',
            'sentCount' => 'Sent Count',
        ];
    }
}
