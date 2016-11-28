<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $TableRef
 * @property string $ShortDescription
 * @property string $BasicInfomation
 * @property string $CompensionInfomation
 * @property string $DetailDescription
 * @property string $VideoUrl
 * @property string $AdminComment
 * @property string $MetaKeywords
 * @property string $MetaDescription
 * @property string $MetaTitle
 * @property integer $CategoryId
 * @property integer $IsActive
 * @property integer $DisplayOrder
 * @property integer $Published
 * @property integer $Deleted
 * @property string $CreatedTime
 * @property string $UpdatedTime
 *
 * @property CustomerActivitySite[] $customerActivitySites
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 * @property Category $category
 */
class ProductType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShortDescription', 'BasicInfomation', 'CompensionInfomation', 'DetailDescription', 'VideoUrl', 'AdminComment', 'MetaDescription'], 'string'],
            [['CategoryId', 'IsActive', 'DisplayOrder', 'Published', 'Deleted'], 'integer'],
            [['CreatedTime', 'UpdatedTime'], 'safe'],
            [['Name', 'MetaKeywords', 'MetaTitle'], 'string', 'max' => 400],
            [['TableRef'], 'string', 'max' => 100],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'TableRef' => 'Table Ref',
            'ShortDescription' => 'Short Description',
            'BasicInfomation' => 'Basic Infomation',
            'CompensionInfomation' => 'Compension Infomation',
            'DetailDescription' => 'Detail Description',
            'VideoUrl' => 'Video Url',
            'AdminComment' => 'Admin Comment',
            'MetaKeywords' => 'Meta Keywords',
            'MetaDescription' => 'Meta Description',
            'MetaTitle' => 'Meta Title',
            'CategoryId' => 'Category ID',
            'IsActive' => 'Is Active',
            'DisplayOrder' => 'Display Order',
            'Published' => 'Published',
            'Deleted' => 'Deleted',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerActivitySites()
    {
        return $this->hasMany(CustomerActivitySite::className(), ['ProductTypeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['ProductTypeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['ProductTypeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }
}
