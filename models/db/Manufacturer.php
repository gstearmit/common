<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $ManufacturerTemplateId
 * @property string $MetaKeywords
 * @property string $MetaDescription
 * @property string $MetaTitle
 * @property integer $PictureId
 * @property integer $PageSize
 * @property integer $AllowCustomersToSelectPageSize
 * @property string $PageSizeOptions
 * @property string $PriceRanges
 * @property integer $SubjectToAcl
 * @property integer $LimitedToStores
 * @property integer $Published
 * @property integer $Deleted
 * @property integer $IsMoto
 * @property integer $IsOto
 * @property integer $DisplayOrder
 * @property string $CreatedTime
 * @property string $UpdatedTime
 * @property integer $StoreId
 *
 * @property Store $store
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Description', 'MetaDescription'], 'string'],
            [['ManufacturerTemplateId', 'PictureId', 'PageSize', 'AllowCustomersToSelectPageSize', 'SubjectToAcl', 'LimitedToStores', 'Published', 'Deleted', 'IsMoto', 'IsOto', 'DisplayOrder', 'StoreId'], 'integer'],
            [['CreatedTime', 'UpdatedTime'], 'safe'],
            [['Name', 'MetaKeywords', 'MetaTitle', 'PriceRanges'], 'string', 'max' => 400],
            [['PageSizeOptions'], 'string', 'max' => 200],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'Description' => 'Description',
            'ManufacturerTemplateId' => 'Manufacturer Template ID',
            'MetaKeywords' => 'Meta Keywords',
            'MetaDescription' => 'Meta Description',
            'MetaTitle' => 'Meta Title',
            'PictureId' => 'Picture ID',
            'PageSize' => 'Page Size',
            'AllowCustomersToSelectPageSize' => 'Allow Customers To Select Page Size',
            'PageSizeOptions' => 'Page Size Options',
            'PriceRanges' => 'Price Ranges',
            'SubjectToAcl' => 'Subject To Acl',
            'LimitedToStores' => 'Limited To Stores',
            'Published' => 'Published',
            'Deleted' => 'Deleted',
            'IsMoto' => 'Is Moto',
            'IsOto' => 'Is Oto',
            'DisplayOrder' => 'Display Order',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['ManufacturerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['ManufacturerId' => 'id']);
    }
}
