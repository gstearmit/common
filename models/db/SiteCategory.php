<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site_category".
 *
 * @property integer $siteId
 * @property string $name
 * @property string $createTime
 * @property string $updateTime
 * @property string $SeoDescription
 * @property string $SeoTitle
 * @property string $SeoKeyword
 */
class SiteCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime'], 'safe'],
            [['name'], 'string', 'max' => 220],
            [['SeoDescription', 'SeoTitle', 'SeoKeyword'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'siteId' => 'Site ID',
            'name' => 'Name',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'SeoDescription' => 'Seo Description',
            'SeoTitle' => 'Seo Title',
            'SeoKeyword' => 'Seo Keyword',
        ];
    }
}
