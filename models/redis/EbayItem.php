<?php
/**
 * Created by PhpStorm.
 * User: ducqu
 * Date: 12/18/2015
 * Time: 11:34 AM
 */

namespace common\models\redis;


use common\models\ebay\SolrEbayItem;
use yii\redis\ActiveRecord;

class EbayItem extends ActiveRecord
{
    public function attributes()
    {
        return ['id','data'];
        //return array_keys(get_class_vars(SolrEbayItem::class));
    }
}