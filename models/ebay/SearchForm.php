<?php
/**
 * Created by PhpStorm.
 * User: ducquan
 * Date: 22/10/2015
 * Time: 09:50 AM
 */

namespace common\models\ebay;


class SearchForm extends \yii\base\Model
{ 
    public $id, $keyword, $auction, $sellerIds, $categoryIds, $specifics = [], $location, $maxPrice, $minPrice, $conditions = [], $page = 1, $size = 50, $unHold = [], $type = null, $order = 0;
    public $storeId;
    public function valid()
    {
        if ($this->sellerIds == null && $this->categoryIds == null && $this->keyword == null) {
            return false;
        }
        return true;
    }
}