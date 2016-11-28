<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $Guid
 * @property string $OriginalItemId
 * @property string $Sku
 * @property integer $CategoryId
 * @property integer $ProductTypeId
 * @property integer $GroupedProductId
 * @property integer $VendorId
 * @property integer $ManufacturerId
 * @property integer $MerchantId
 * @property integer $siteId
 * @property integer $StoreId
 * @property string $Name
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property string $AdminComment
 * @property integer $ProductTemplateId
 * @property string $MetaKeywords
 * @property string $MetaDescription
 * @property string $MetaTitle
 * @property integer $AllowCustomerReviews
 * @property integer $ApprovedRatingSum
 * @property integer $NotApprovedRatingSum
 * @property integer $ApprovedTotalReviews
 * @property integer $NotApprovedTotalReviews
 * @property integer $IsRecurring
 * @property integer $RecurringCycleLength
 * @property integer $RecurringCyclePeriodId
 * @property integer $RecurringTotalCycles
 * @property integer $IsFreeShipping
 * @property string $AdditionalShippingCharge
 * @property integer $IsTaxExempt
 * @property integer $TaxCategoryId
 * @property integer $StockQuantity
 * @property integer $AvailableStockQuantity
 * @property integer $OrderMinimumQuantity
 * @property integer $OrderMaximumQuantity
 * @property integer $DisableBuyButton
 * @property integer $DisableWishlistButton
 * @property integer $AvailableForPreOrder
 * @property string $Price
 * @property string $OldPrice
 * @property string $ProductCost
 * @property integer $IsHotDeal
 * @property string $SpecialPrice
 * @property string $SpecialPriceStartDateTime
 * @property string $SpecialPriceEndDateTime
 * @property integer $CampaignId
 * @property integer $HasTierPrices
 * @property string $Weight
 * @property string $Length
 * @property string $Width
 * @property string $Height
 * @property string $AvailableStartDateTime
 * @property string $AvailableEndDateTime
 * @property integer $DisplayOrder
 * @property integer $Published
 * @property integer $Deleted
 * @property string $CreatedTime
 * @property string $UpdatedTime
 * @property integer $TotalLike
 * @property integer $NumberOfViews
 * @property string $ThumbUrl
 * @property string $ImageUrl
 * @property string $Brand
 * @property string $OriginalUrl
 * @property string $LastCrawlTime
 *
 * @property CustomerActivitySite[] $customerActivitySites
 * @property CustomerImages[] $customerImages
 * @property CustomerProductHistory[] $customerProductHistories
 * @property CustomerProductInterested[] $customerProductInteresteds
 * @property OrderItem[] $orderItems
 * @property Campaign $campaign
 * @property ProductType $productType
 * @property Category $category
 * @property Manufacturer $manufacturer
 * @property Site $site
 * @property Store $store
 * @property Merchant $merchant
 * @property ProductCrosssell[] $productCrosssells
 * @property ProductCrosssell[] $productCrosssells0
 * @property ProductImages[] $productImages
 * @property ProductRelated[] $productRelateds
 * @property ProductRelated[] $productRelateds0
 * @property ProductReview[] $productReviews
 * @property PurchaseOrderItem[] $purchaseOrderItems
 * @property PurchaseOrderItemRevision[] $purchaseOrderItemRevisions
 * @property WarehousePackageItem[] $warehousePackageItems
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryId', 'ProductTypeId', 'GroupedProductId', 'VendorId', 'ManufacturerId', 'MerchantId', 'siteId', 'StoreId', 'ProductTemplateId', 'AllowCustomerReviews', 'ApprovedRatingSum', 'NotApprovedRatingSum', 'ApprovedTotalReviews', 'NotApprovedTotalReviews', 'IsRecurring', 'RecurringCycleLength', 'RecurringCyclePeriodId', 'RecurringTotalCycles', 'IsFreeShipping', 'IsTaxExempt', 'TaxCategoryId', 'StockQuantity', 'AvailableStockQuantity', 'OrderMinimumQuantity', 'OrderMaximumQuantity', 'DisableBuyButton', 'DisableWishlistButton', 'AvailableForPreOrder', 'IsHotDeal', 'CampaignId', 'HasTierPrices', 'DisplayOrder', 'Published', 'Deleted', 'TotalLike', 'NumberOfViews'], 'integer'],
            [['ShortDescription', 'FullDescription', 'AdminComment'], 'string'],
            [['AdditionalShippingCharge', 'Price', 'OldPrice', 'ProductCost', 'SpecialPrice', 'Weight', 'Length', 'Width', 'Height'], 'number'],
            [['SpecialPriceStartDateTime', 'SpecialPriceEndDateTime', 'AvailableStartDateTime', 'AvailableEndDateTime', 'CreatedTime', 'UpdatedTime', 'LastCrawlTime'], 'safe'],
            [['Guid'], 'string', 'max' => 64],
            [['OriginalItemId'], 'string', 'max' => 100],
            [['Sku'], 'string', 'max' => 400],
            [['Name', 'MetaKeywords', 'MetaDescription', 'MetaTitle', 'ThumbUrl', 'ImageUrl'], 'string', 'max' => 255],
            [['Brand'], 'string', 'max' => 50],
            [['OriginalUrl'], 'string', 'max' => 1000],
            [['CampaignId'], 'exist', 'skipOnError' => true, 'targetClass' => Campaign::className(), 'targetAttribute' => ['CampaignId' => 'id']],
            [['ProductTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['ProductTypeId' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['ManufacturerId'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['ManufacturerId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['MerchantId'], 'exist', 'skipOnError' => true, 'targetClass' => Merchant::className(), 'targetAttribute' => ['MerchantId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Guid' => 'Guid',
            'OriginalItemId' => 'Original Item ID',
            'Sku' => 'Sku',
            'CategoryId' => 'Category ID',
            'ProductTypeId' => 'Product Type ID',
            'GroupedProductId' => 'Grouped Product ID',
            'VendorId' => 'Vendor ID',
            'ManufacturerId' => 'Manufacturer ID',
            'MerchantId' => 'Merchant ID',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'Name' => 'Name',
            'ShortDescription' => 'Short Description',
            'FullDescription' => 'Full Description',
            'AdminComment' => 'Admin Comment',
            'ProductTemplateId' => 'Product Template ID',
            'MetaKeywords' => 'Meta Keywords',
            'MetaDescription' => 'Meta Description',
            'MetaTitle' => 'Meta Title',
            'AllowCustomerReviews' => 'Allow Customer Reviews',
            'ApprovedRatingSum' => 'Approved Rating Sum',
            'NotApprovedRatingSum' => 'Not Approved Rating Sum',
            'ApprovedTotalReviews' => 'Approved Total Reviews',
            'NotApprovedTotalReviews' => 'Not Approved Total Reviews',
            'IsRecurring' => 'Is Recurring',
            'RecurringCycleLength' => 'Recurring Cycle Length',
            'RecurringCyclePeriodId' => 'Recurring Cycle Period ID',
            'RecurringTotalCycles' => 'Recurring Total Cycles',
            'IsFreeShipping' => 'Is Free Shipping',
            'AdditionalShippingCharge' => 'Additional Shipping Charge',
            'IsTaxExempt' => 'Is Tax Exempt',
            'TaxCategoryId' => 'Tax Category ID',
            'StockQuantity' => 'Stock Quantity',
            'AvailableStockQuantity' => 'Available Stock Quantity',
            'OrderMinimumQuantity' => 'Order Minimum Quantity',
            'OrderMaximumQuantity' => 'Order Maximum Quantity',
            'DisableBuyButton' => 'Disable Buy Button',
            'DisableWishlistButton' => 'Disable Wishlist Button',
            'AvailableForPreOrder' => 'Available For Pre Order',
            'Price' => 'Price',
            'OldPrice' => 'Old Price',
            'ProductCost' => 'Product Cost',
            'IsHotDeal' => 'Is Hot Deal',
            'SpecialPrice' => 'Special Price',
            'SpecialPriceStartDateTime' => 'Special Price Start Date Time',
            'SpecialPriceEndDateTime' => 'Special Price End Date Time',
            'CampaignId' => 'Campaign ID',
            'HasTierPrices' => 'Has Tier Prices',
            'Weight' => 'Weight',
            'Length' => 'Length',
            'Width' => 'Width',
            'Height' => 'Height',
            'AvailableStartDateTime' => 'Available Start Date Time',
            'AvailableEndDateTime' => 'Available End Date Time',
            'DisplayOrder' => 'Display Order',
            'Published' => 'Published',
            'Deleted' => 'Deleted',
            'CreatedTime' => 'Created Time',
            'UpdatedTime' => 'Updated Time',
            'TotalLike' => 'Total Like',
            'NumberOfViews' => 'Number Of Views',
            'ThumbUrl' => 'Thumb Url',
            'ImageUrl' => 'Image Url',
            'Brand' => 'Brand',
            'OriginalUrl' => 'Original Url',
            'LastCrawlTime' => 'Last Crawl Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerActivitySites()
    {
        return $this->hasMany(CustomerActivitySite::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerImages()
    {
        return $this->hasMany(CustomerImages::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductHistories()
    {
        return $this->hasMany(CustomerProductHistory::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerProductInteresteds()
    {
        return $this->hasMany(CustomerProductInterested::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaign()
    {
        return $this->hasOne(Campaign::className(), ['id' => 'CampaignId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'ProductTypeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'ManufacturerId']);
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
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'StoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(Merchant::className(), ['id' => 'MerchantId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCrosssells()
    {
        return $this->hasMany(ProductCrosssell::className(), ['ProductId1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCrosssells0()
    {
        return $this->hasMany(ProductCrosssell::className(), ['ProductId2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelateds()
    {
        return $this->hasMany(ProductRelated::className(), ['ProductId1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductRelateds0()
    {
        return $this->hasMany(ProductRelated::className(), ['ProductId2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductReviews()
    {
        return $this->hasMany(ProductReview::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRevisions()
    {
        return $this->hasMany(PurchaseOrderItemRevision::className(), ['ProductId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItems()
    {
        return $this->hasMany(WarehousePackageItem::className(), ['productId' => 'id']);
    }
}
