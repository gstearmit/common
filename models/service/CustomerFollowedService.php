<?php
/**
 * Created by PhpStorm.
 * User: ducqu
 * Date: 19-11-2015
 * Time: 11:33 AM
 */

namespace common\models\service;


use common\components\TextUtility;
use common\models\db\CustomerFollowed;
use common\models\output\DataPage;

class CustomerFollowedService
{

    public static function getList($customerId, $type = null, $siteId = 2, $StoreId = 2, $order = 'desc', $page = 1, $size = 20, $select = '*')
    {
        $dataPage = new DataPage();
        if ($customerId == null || $siteId == null || $StoreId == null) {
            return $dataPage;
        }
        $query = CustomerFollowed::find()->select($select)->where(['customerId' => $customerId]);
//        $type = $type == null ? CustomerFollowed::ebay_item : $type;
//        $query->andWhere(['objectType' => $type]);
        $order = $order == 'desc' ? 'id desc' : 'id asc';
        $query->orderBy($order);
        $dataPage->page = $page;
        $dataPage->pageSize = $size;
        $dataPage->setData($query);
        return $dataPage;
    }

    public static function checkFollowed($ids, $objectType, $customerId, $siteId, $StoreId)
    {
        $followeds = CustomerFollowed::find()->select('objectId')->where(['objectId' => $ids, 'objectType' => $objectType, 'customerId' => $customerId, 'siteId' => $siteId, 'StoreId' => $StoreId])->orderBy('updateTime desc')->all();
        $rs = [];
        foreach ($followeds as $followed) {
            $rs[] = $followed->objectId;
        }
        return $rs;
    }

    public static function insert($itemId, $objectType, $customerId, $siteId, $StoreId)
    {
        $customerId = $customerId == null ? \Yii::$app->user->getId() : $customerId;
        $history = self::getOne($itemId, $objectType, $customerId, $siteId, $StoreId);
        $newRecord = true;
        if ($history == null) {
            $history = new CustomerFollowed();
        } else {
            $newRecord = false;
        }
        $history->isNewRecord = $newRecord;
        $history->customerId = $customerId;
        $history->objectType = $objectType;
        $history->objectId = $itemId;
        $history->siteId = $siteId;
        $history->StoreId = $StoreId;
        $history->updateTime = TextUtility::datetimeByUnixTime();
        return $history->save(false);
    }

    public static function getOne($ids, $objectType, $customerId, $siteId, $StoreId)
    {
        return CustomerFollowed::find()->where(['objectId' => $ids, 'objectType' => $objectType, 'customerId' => $customerId, 'siteId' => $siteId, 'StoreId' => $StoreId])->one();
    }

    public static function deleteOne($ids, $objectType, $customerId, $siteId, $StoreId)
    {
        return CustomerFollowed::deleteAll(['objectId' => $ids, 'objectType' => $objectType, 'customerId' => $customerId, 'siteId' => $siteId, 'StoreId' => $StoreId]);
    }
    
    public static function getCheckFollow($ids, $customerId)
    {
    	return CustomerFollowed::find()->where(['objectId' => $ids, 'customerId' => $customerId])->one();
    }
    
}