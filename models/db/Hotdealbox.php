<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "hotdealbox".
 *
 * @property integer $id
 * @property integer $siteId
 * @property string $name
 * @property string $itemIds
 * @property integer $active
 * @property integer $createTime
 * @property string $createEmail
 * @property integer $updateTime
 * @property string $updateEmail
 *
 * @property Site $site
 */
class Hotdealbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotdealbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siteId', 'active', 'createTime', 'updateTime'], 'integer'],
            [['name', 'itemIds'], 'string', 'max' => 220],
            [['createEmail', 'updateEmail'], 'string', 'max' => 50],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'siteId' => 'Site ID',
            'name' => 'Name',
            'itemIds' => 'Item Ids',
            'active' => 'Active',
            'createTime' => 'Create Time',
            'createEmail' => 'Create Email',
            'updateTime' => 'Update Time',
            'updateEmail' => 'Update Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }
}
