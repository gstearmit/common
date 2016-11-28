<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "ebay_item_crawl".
 *
 * @property integer $id
 * @property string $categoryId
 * @property integer $minPrice
 * @property integer $maxPrice
 * @property integer $stepPrice
 * @property integer $updateTime
 * @property integer $totalItem
 * @property integer $lastUpdate
 * @property integer $priority
 * @property integer $itemPerPage
 * @property boolean $active
 */
class EbayItemCrawl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ebay_item_crawl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'required'],
            [['minPrice', 'maxPrice', 'stepPrice', 'updateTime', 'totalItem', 'lastUpdate', 'priority', 'itemPerPage'], 'integer'],
            [['active'], 'boolean'],
            [['categoryId'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoryId' => 'Category ID',
            'minPrice' => 'Min Price',
            'maxPrice' => 'Max Price',
            'stepPrice' => 'Step Price',
            'updateTime' => 'Update Time',
            'totalItem' => 'Total Item',
            'lastUpdate' => 'Last Update',
            'priority' => 'Priority',
            'itemPerPage' => 'Item Per Page',
            'active' => 'Active',
        ];
    }
}
