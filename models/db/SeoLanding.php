<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "seo_landing".
 *
 * @property integer $id
 * @property string $landing_Code
 * @property string $name
 * @property string $description
 * @property string $topic
 * @property string $relate_Topic
 * @property string $link
 * @property string $path
 * @property integer $status
 * @property string $create_Time
 * @property string $expire_Time
 * @property integer $employee_Id
 * @property integer $site
 * @property integer $store
 * @property string $relate_Topic_Name
 *
 * @property SeoCategory[] $seoCategories
 * @property Site $site0
 * @property Store $store0
 * @property OrganizationEmployee $employee
 * @property SeoProduct[] $seoProducts
 */
class SeoLanding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_landing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'relate_Topic'], 'string'],
            [['status', 'employee_Id', 'site', 'store'], 'integer'],
            [['create_Time', 'expire_Time'], 'safe'],
            [['landing_Code', 'name', 'topic', 'link', 'path', 'relate_Topic_Name'], 'string', 'max' => 255],
            [['site'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['site' => 'id']],
            [['store'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store' => 'id']],
            [['employee_Id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employee_Id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'landing_Code' => 'Landing  Code',
            'name' => 'Name',
            'description' => 'Description',
            'topic' => 'Topic',
            'relate_Topic' => 'Relate  Topic',
            'link' => 'Link',
            'path' => 'Path',
            'status' => 'Status',
            'create_Time' => 'Create  Time',
            'expire_Time' => 'Expire  Time',
            'employee_Id' => 'Employee  ID',
            'site' => 'Site',
            'store' => 'Store',
            'relate_Topic_Name' => 'Relate  Topic  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoCategories()
    {
        return $this->hasMany(SeoCategory::className(), ['landing_Id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite0()
    {
        return $this->hasOne(Site::className(), ['id' => 'site']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore0()
    {
        return $this->hasOne(Store::className(), ['id' => 'store']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'employee_Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoProducts()
    {
        return $this->hasMany(SeoProduct::className(), ['landing_Id' => 'id']);
    }
}
