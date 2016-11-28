<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $id
 * @property string $Name
 * @property string $LanguageCulture
 * @property string $UniqueSeoCode
 * @property string $FlagImageFileName
 * @property integer $Rtl
 * @property integer $LimitedToStores
 * @property integer $Published
 * @property integer $DisplayOrder
 *
 * @property Cmspage[] $cmspages
 * @property Customer[] $customers
 * @property FunctionGroup[] $functionGroups
 * @property FunctionMenu[] $functionMenus
 * @property Store $limitedToStores
 * @property LocaleStringResource[] $localeStringResources
 * @property News[] $news
 * @property Newscategories[] $newscategories
 * @property SeoCategory[] $seoCategories
 * @property Store[] $stores
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Rtl', 'LimitedToStores', 'Published', 'DisplayOrder'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['LanguageCulture'], 'string', 'max' => 20],
            [['UniqueSeoCode'], 'string', 'max' => 2],
            [['FlagImageFileName'], 'string', 'max' => 50],
            [['LimitedToStores'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['LimitedToStores' => 'id']],
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
            'LanguageCulture' => 'Language Culture',
            'UniqueSeoCode' => 'Unique Seo Code',
            'FlagImageFileName' => 'Flag Image File Name',
            'Rtl' => 'Rtl',
            'LimitedToStores' => 'Limited To Stores',
            'Published' => 'Published',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspages()
    {
        return $this->hasMany(Cmspage::className(), ['LanguageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['LanguageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunctionGroups()
    {
        return $this->hasMany(FunctionGroup::className(), ['LanguageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunctionMenus()
    {
        return $this->hasMany(FunctionMenu::className(), ['LanguageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitedToStores()
    {
        return $this->hasOne(Store::className(), ['id' => 'LimitedToStores']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocaleStringResources()
    {
        return $this->hasMany(LocaleStringResource::className(), ['LanguageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['languageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewscategories()
    {
        return $this->hasMany(Newscategories::className(), ['languageId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoCategories()
    {
        return $this->hasMany(SeoCategory::className(), ['language_Id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['LanguageId' => 'id']);
    }
}
