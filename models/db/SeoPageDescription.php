<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "seo_page_description".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $metaDescription
 * @property string $metaKeyword
 * @property string $link
 * @property string $status
 * @property string $updateTime
 * @property string $createTime
 */
class SeoPageDescription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_page_description';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updateTime', 'createTime'], 'safe'],
            [['title', 'description', 'metaDescription', 'metaKeyword', 'link', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'metaDescription' => 'Meta Description',
            'metaKeyword' => 'Meta Keyword',
            'link' => 'Link',
            'status' => 'Status',
            'updateTime' => 'Update Time',
            'createTime' => 'Create Time',
        ];
    }
}
