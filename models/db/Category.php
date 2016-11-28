<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $siteId
 * @property string $name
 * @property string $originName
 * @property integer $parentId
 * @property string $description
 * @property integer $position
 * @property integer $leaf
 * @property integer $active
 * @property integer $home
 * @property string $createTime
 * @property string $updateTime
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $icount
 * @property integer $level
 * @property string $path
 * @property string $MetaKeywords
 * @property string $MetaDescription
 * @property string $MetaTitle
 * @property integer $PageSize
 * @property double $priceMultiple
 * @property double $priceMultipleOld
 * @property double $priceAddition
 * @property double $priceAdditionOld
 * @property integer $StoreId
 * @property string $name_vn
 * @property string $name_ph
 * @property string $name_th
 * @property string $name_sg
 * @property string $name_id
 * @property string $name_my
 *
 * @property Banner[] $banners
 * @property Store $store
 * @property Site $site
 * @property CategoryBrand[] $categoryBrands
 * @property CategoryCustomPolicy[] $categoryCustomPolicies
 * @property CategoryPricePolicy[] $categoryPricePolicies
 * @property CategoryServicePolicy[] $categoryServicePolicies
 * @property CustomerCall[] $customerCalls
 * @property CustomerCard[] $customerCards
 * @property CustomerItemHistory[] $customerItemHistories
 * @property CustomerProductHistory[] $customerProductHistories
 * @property CustomerProductInterested[] $customerProductInteresteds
 * @property DiscountCategory[] $discountCategories
 * @property ItemCrawl[] $itemCrawls
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 * @property ProductReview[] $productReviews
 * @property ProductType[] $productTypes
 * @property SaleCommissionSetting[] $saleCommissionSettings
 * @property ShoppingCartItem[] $shoppingCartItems
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['siteId', 'parentId', 'position', 'leaf', 'active', 'home', 'icount', 'level', 'PageSize', 'StoreId'], 'integer'],
            [['description', 'MetaDescription'], 'string'],
            [['createTime', 'updateTime'], 'safe'],
            [['priceMultiple', 'priceMultipleOld', 'priceAddition', 'priceAdditionOld'], 'number'],
            [['alias', 'name', 'originName', 'path'], 'string', 'max' => 220],
            [['createEmail', 'updateEmail'], 'string', 'max' => 100],
            [['MetaKeywords', 'MetaTitle', 'name_vn', 'name_ph', 'name_th', 'name_sg', 'name_id', 'name_my'], 'string', 'max' => 255],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
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
            'alias' => 'Alias',
            'siteId' => 'Site ID',
            'name' => 'Name',
            'originName' => 'Origin Name',
            'parentId' => 'Parent ID',
            'description' => 'Description',
            'position' => 'Position',
            'leaf' => 'Leaf',
            'active' => 'Active',
            'home' => 'Home',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'icount' => 'Icount',
            'level' => 'Level',
            'path' => 'Path',
            'MetaKeywords' => 'Meta Keywords',
            'MetaDescription' => 'Meta Description',
            'MetaTitle' => 'Meta Title',
            'PageSize' => 'Page Size',
            'priceMultiple' => 'Price Multiple',
            'priceMultipleOld' => 'Price Multiple Old',
            'priceAddition' => 'Price Addition',
            'priceAdditionOld' => 'Price Addition Old',
            'StoreId' => 'Store ID',
            'name_vn' => 'Name Vn',
            'name_ph' => 'Name Ph',
            'name_th' => 'Name Th',
            'name_sg' => 'Name Sg',
            'name_id' => 'Name ID',
            'name_my' => 'Name My',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banner::className(), ['CategoryId' => 'id']);
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryBrands()
    {
        return $this->hasMany(CategoryBrand::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCustomPolicies()
    {
        return $this->hasMany(CategoryCustomPolicy::className(), ['CategoryRefId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPricePolicies()
    {
        return $this->hasMany(CategoryPricePolicy::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryServicePolicies()
    {
        return $this->hasMany(CategoryServicePolicy::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCalls()
    {
        return $this->hasMany(CustomerCall::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCards()
    {
        return $this->hasMany(CustomerCard::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerItemHistories()
    {
        return $this->hasMany(CustomerItemHistory::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductHistories()
    {
        return $this->hasMany(CustomerProductHistory::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductInteresteds()
    {
        return $this->hasMany(CustomerProductInterested::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCategories()
    {
        return $this->hasMany(DiscountCategory::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCrawls()
    {
        return $this->hasMany(ItemCrawl::className(), ['categoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReview::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettings()
    {
        return $this->hasMany(SaleCommissionSetting::className(), ['CategoryId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShoppingCartItems()
    {
        return $this->hasMany(ShoppingCartItem::className(), ['CategoryId' => 'id']);
    }
}
