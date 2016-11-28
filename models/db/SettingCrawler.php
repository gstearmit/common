<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "setting_crawler".
 *
 * @property integer $id
 * @property string $source_url
 * @property string $classGetImage
 * @property string $classGetTitle
 * @property string $classGetPrice
 * @property string $classGetDescription
 * @property string $classGetQuantity
 * @property string $classGetCategory
 * @property string $classGetOriginId
 * @property string $classGetSize
 * @property string $classGetOther
 * @property string $description
 * @property string $currency
 * @property string $absoluteImg
 * @property string $logo
 * @property string $active
 * @property string $fullUrl
 */
class SettingCrawler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting_crawler';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['source_url', 'classGetImage', 'classGetTitle', 'classGetPrice', 'classGetDescription', 'classGetQuantity', 'classGetCategory', 'classGetOriginId', 'classGetSize', 'classGetOther', 'description', 'absoluteImg'], 'string', 'max' => 450],
            [['currency'], 'string', 'max' => 105],
            [['logo', 'active', 'fullUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'source_url' => 'Source Url',
            'classGetImage' => 'Class Get Image',
            'classGetTitle' => 'Class Get Title',
            'classGetPrice' => 'Class Get Price',
            'classGetDescription' => 'Class Get Description',
            'classGetQuantity' => 'Class Get Quantity',
            'classGetCategory' => 'Class Get Category',
            'classGetOriginId' => 'Class Get Origin ID',
            'classGetSize' => 'Class Get Size',
            'classGetOther' => 'Class Get Other',
            'description' => 'Description',
            'currency' => 'Currency',
            'absoluteImg' => 'Absolute Img',
            'logo' => 'Logo',
            'active' => 'Active',
            'fullUrl' => 'Full Url',
        ];
    }
}
