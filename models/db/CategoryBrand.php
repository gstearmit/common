<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_brand".
 *
 * @property integer $categoryId
 * @property integer $brandId
 * @property string $categoryName
 * @property string $brandName
 * @property integer $id
 *
 * @property Category $category
 */
class CategoryBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'brandId'], 'integer'],
            [['categoryName', 'brandName'], 'string', 'max' => 220],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categoryId' => 'Category ID',
            'brandId' => 'Brand ID',
            'categoryName' => 'Category Name',
            'brandName' => 'Brand Name',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryId']);
    }
}
