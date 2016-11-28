<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property integer $siteId
 * @property string $name
 * @property string $website
 * @property integer $position
 * @property string $description
 * @property integer $active
 *
 * @property Site $site
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'siteId', 'position', 'active'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 220],
            [['website'], 'string', 'max' => 100],
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
            'website' => 'Website',
            'position' => 'Position',
            'description' => 'Description',
            'active' => 'Active',
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
