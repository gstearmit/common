<?php
/**
 * Created by PhpStorm.
 * User: idea
 * Date: 29/11/2016
 * Time: 10:03
 */
namespace common\models\model;

use common\components\TextUtility;
use common\models\ebay\SolrEbayItem;

class EbayItem extends \common\models\db\EbayItem{

    public $desc;

    public static function getSpecifics()
    {
        return [
            'Model' => 'specific_Model',
            'Type' => 'specific_Type',
            'Size' => 'specific_Size',
            'Material' => 'specific_Material',
            'Style' => 'specific_Style',
            'Features' => 'specific_Features',
            'Size Type' => 'specific_SizeType',
            'Compatible Brand' => 'specific_CompatibleBrand',
            'Brand' => 'specific_Brand',
            'Color' => 'specific_Color',
            'Compatible Model' => 'specific_CompatibleModel',
            'Format' => 'specific_Format',
            'Skin Type' => 'specific_SkinType',
            'Formulation' => 'specific_Formulation',
            'Effect' => 'specific_Effect',
            'Gender' => 'specific_Gender',
            'Concerns' => 'specific_Concerns',
            'Metal' => 'specific_Metal',
            'Main Stone' => 'specific_MainStone',
            'Age Level' => 'specific_AgeLevel',
            'Year' => 'specific_Year',
            'Shop For' => 'specific_ShopFor',
            'Theme' => 'specific_Theme',
            'Product Line' => 'specific_ProductLine',
            'Ring Size' => 'specific_RingSize'
        ];
    }



    public static function getConditions()
    {
        return [
            '1000' => ['New', 'Mới'],
            '3000' => ['Used', 'Đã qua sử dụng'],
            '2000' => ['Manufacturer refurbished', 'Hàng tân trang của nhà sản xuất'],
            '7000' => ['For parts or not working', 'Không hoạt động hoặc chỉ hoạt động một phần'],
            '1500' => ['New other (see details)', 'Mới (Khác)'],
            '2500' => ['Seller refurbished', 'Hàng được người bán tân trang'],
            '4000' => ['Very Good', 'Còn rất tốt'],
            '5000' => ['Good', 'Còn tốt'],
            '2750' => ['Like New', 'Như mới'],
            '6000' => ['Acceptable', 'Chấp nhận được'],
            '1750' => ['New with defects', 'Mới (Có lỗi nhỏ)'],
        ];
    }

    static $mapConditionId = null;
    static $mapConditionLabel = null;
    static $mapConditionLabelOrigin = null;

    public static function getConditionId($name)
    {
        if (static::$mapConditionId == null) {
            static::$mapConditionId = [];
            $list = static::getConditions();
            foreach ($list as $id => $condition) {
                static::$mapConditionId[$condition[0]] = $id;
            }
        }

        return isset(static::$mapConditionId[$name]) ? static::$mapConditionId[$name] : null;
    }

    public static function getConditionLabel($id)
    {
        if (static::$mapConditionLabel == null) {
            static::$mapConditionLabel = [];
            $list = static::getConditions();
            foreach ($list as $cid => $condition) {
                static::$mapConditionLabel[$cid] = $condition[1];
            }
        }

        return isset(static::$mapConditionLabel[$id]) ? static::$mapConditionLabel[$id] : 'Khác';
    }

    public static function getConditionLabelOrigin($id)
    {
        if (static::$mapConditionLabelOrigin == null) {
            static::$mapConditionLabelOrigin = [];
            $list = static::getConditions();
            foreach ($list as $id => $condition) {
                static::$mapConditionLabelOrigin[$id] = $condition[0];
            }
        }

        return isset(static::$mapConditionLabelOrigin[$id]) ? static::$mapConditionLabelOrigin[$id] : 'Other';
    }

    public function buildSolrItem()
    {
        $solr_object = new SolrEbayItem();
        $object_var = $this->attributes;
        foreach ($object_var as $key => $prop) {
            if (property_exists($solr_object, $key)) {
                $solr_object->$key = $prop;
            }
        }
//        $solr_object->facets = [];
//        if (isset($object_var['specifics']) && is_array($object_var['specifics'])) {
//            foreach ($object_var['specifics'] as $spe) {
//                $solr_object->facets[] = $spe->name;
//            }
//        }
//        if (is_array($solr_object->specifics))
//            foreach ($solr_object->specifics as $specific) {
//                $solr_object->{'specific_' . TextUtility::base64Encode($specific->name)} = str_replace('"',"'",trim($specific->value));
//            }
        $solr_object->discount = $this->getDiscount();
        if (isset($solr_object->seller->id)) {
            $solr_object->sellerId = $solr_object->seller->id;
        }
        if (isset($this->primaryCategory) && isset($this->primaryCategory->path)) {
            $solr_object->category = explode(':', $this->primaryCategory->path);
        }
        $solr_object->description = $this->description;
        $solr_object->seller = json_encode($solr_object->seller);
        $solr_object->saleSpecific = json_encode($solr_object->saleSpecific);
        $solr_object->specifics = json_encode($solr_object->specifics);
        $solr_object->subItems = json_encode($solr_object->subItems);
        $solr_object->updateTime = time();
        return $solr_object;
    }

    /**
     * @return float|int
     */
    public function getDiscount()
    {
//        $discount = 0;
        $object_var = $this->attributes;
//        if ($object_var['startPrice'] > 0) {
//            $discount = ceil(100 - ($object_var['sellPrice'] / $object_var['startPrice'] * 100));
//        }
        return TextUtility::calPercent($object_var['startPrice'], $object_var['sellPrice']);
    }

    public function beforeSave($insert)
    {
        $this->convertToSolrSave();
        $this->updateTime = time();
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function convertToSolrSave()
    {
        if (isset($this->primaryCategory) && isset($this->primaryCategory->path)) {
            $this->category = $this->primaryCategory->path;
        }
        $this->seller = json_encode($this->seller);
        $this->saleSpecific = json_encode($this->saleSpecific);
        $this->specifics = json_encode($this->specifics);
        $this->subItems = json_encode($this->subItems);
        $this->primaryCategory = json_encode($this->primaryCategory);
        $this->secondaryCategory = json_encode($this->secondaryCategory);
        $this->images = json_encode($this->images);
    }

    public function reconvert()
    {
        $this->seller = json_decode($this->seller, false);
        $this->saleSpecific = json_decode($this->saleSpecific, false);
        $this->specifics = json_decode($this->specifics, false);
        $this->subItems = json_decode($this->subItems, false);
        $this->primaryCategory = json_decode($this->primaryCategory, false);
        $this->secondaryCategory = json_decode($this->secondaryCategory, false);
        $this->images = json_decode($this->images, false);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->reconvert();
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }
}