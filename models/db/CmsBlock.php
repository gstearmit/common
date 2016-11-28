<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_block".
 *
 * @property integer $id
 * @property string $title
 * @property string $blockName
 * @property integer $pageId
 * @property integer $active
 * @property integer $order
 * @property integer $type
 * @property integer $parentId
 * @property string $linkTo
 * @property integer $siteId
 * @property integer $templateId
 * @property string $class
 * @property string $description
 * @property string $image
 * @property integer $isDelete
 *
 * @property Cmspage $page
 * @property Site $site
 * @property CmsTemplate $template
 * @property CmsBlockDataCategoryProduct[] $cmsBlockDataCategoryProducts
 * @property CmsBlockDataCategoryProductAuction[] $cmsBlockDataCategoryProductAuctions
 * @property CmsBlockDataImageBanner[] $cmsBlockDataImageBanners
 * @property CmsBlockDataImageBrand[] $cmsBlockDataImageBrands
 * @property CmsBlockDataImageSlide[] $cmsBlockDataImageSlides
 * @property CmsBlockDataKeyword[] $cmsBlockDataKeywords
 * @property CmsBlockDataNavMenu[] $cmsBlockDataNavMenus
 * @property CmsBlockDataProduct[] $cmsBlockDataProducts
 * @property CmsBlockDataProductAuction[] $cmsBlockDataProductAuctions
 * @property CmsBlockDataSeller[] $cmsBlockDataSellers
 * @property CmsBlockDataSlideProduct[] $cmsBlockDataSlideProducts
 */
class CmsBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pageId', 'active', 'order', 'type', 'parentId', 'siteId', 'templateId', 'isDelete'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['blockName'], 'string', 'max' => 30],
            [['linkTo', 'description', 'image'], 'string', 'max' => 255],
            [['class'], 'string', 'max' => 50],
            [['pageId'], 'exist', 'skipOnError' => true, 'targetClass' => Cmspage::className(), 'targetAttribute' => ['pageId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['templateId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsTemplate::className(), 'targetAttribute' => ['templateId' => 'id']],
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
            'blockName' => 'Block Name',
            'pageId' => 'Page ID',
            'active' => 'Active',
            'order' => 'Order',
            'type' => 'Type',
            'parentId' => 'Parent ID',
            'linkTo' => 'Link To',
            'siteId' => 'Site ID',
            'templateId' => 'Template ID',
            'class' => 'Class',
            'description' => 'Description',
            'image' => 'Image',
            'isDelete' => 'Is Delete',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Cmspage::className(), ['id' => 'pageId']);
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
    public function getTemplate()
    {
        return $this->hasOne(CmsTemplate::className(), ['id' => 'templateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataCategoryProducts()
    {
        return $this->hasMany(CmsBlockDataCategoryProduct::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataCategoryProductAuctions()
    {
        return $this->hasMany(CmsBlockDataCategoryProductAuction::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataImageBanners()
    {
        return $this->hasMany(CmsBlockDataImageBanner::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataImageBrands()
    {
        return $this->hasMany(CmsBlockDataImageBrand::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataImageSlides()
    {
        return $this->hasMany(CmsBlockDataImageSlide::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataKeywords()
    {
        return $this->hasMany(CmsBlockDataKeyword::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataNavMenus()
    {
        return $this->hasMany(CmsBlockDataNavMenu::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataProducts()
    {
        return $this->hasMany(CmsBlockDataProduct::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataProductAuctions()
    {
        return $this->hasMany(CmsBlockDataProductAuction::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataSellers()
    {
        return $this->hasMany(CmsBlockDataSeller::className(), ['blockId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsBlockDataSlideProducts()
    {
        return $this->hasMany(CmsBlockDataSlideProduct::className(), ['blockId' => 'id']);
    }
}
