<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property integer $id
 * @property double $Rate
 * @property double $RatePoint
 * @property integer $siteId
 * @property integer $StoreId
 * @property string $parentId
 * @property string $Name
 * @property string $website
 * @property string $phone
 * @property string $description
 * @property double $usTax
 * @property double $feeShip
 * @property double $feeMore
 * @property double $coefficient
 * @property string $representName
 * @property string $representPhone
 * @property string $representEmail
 * @property string $createTime
 * @property string $updateTime
 * @property integer $active
 * @property string $createEmail
 * @property string $updateEmail
 * @property integer $icount
 * @property string $note
 * @property integer $TotalOrderCount
 * @property string $TotalOrderAmount
 *
 * @property Site $site
 * @property Store $store
 * @property Product[] $products
 * @property ProductEbay[] $productEbays
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'merchant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Rate', 'RatePoint', 'usTax', 'feeShip', 'feeMore', 'coefficient', 'TotalOrderAmount'], 'number'],
            [['siteId', 'StoreId', 'active', 'icount', 'TotalOrderCount'], 'integer'],
            [['description', 'note'], 'string'],
            [['createTime', 'updateTime'], 'safe'],
            [['parentId'], 'string', 'max' => 10],
            [['Name', 'representName'], 'string', 'max' => 220],
            [['website', 'representEmail', 'createEmail', 'updateEmail'], 'string', 'max' => 100],
            [['phone', 'representPhone'], 'string', 'max' => 20],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Rate' => 'Rate',
            'RatePoint' => 'Rate Point',
            'siteId' => 'Site ID',
            'StoreId' => 'Store ID',
            'parentId' => 'Parent ID',
            'Name' => 'Name',
            'website' => 'Website',
            'phone' => 'Phone',
            'description' => 'Description',
            'usTax' => 'Us Tax',
            'feeShip' => 'Fee Ship',
            'feeMore' => 'Fee More',
            'coefficient' => 'Coefficient',
            'representName' => 'Represent Name',
            'representPhone' => 'Represent Phone',
            'representEmail' => 'Represent Email',
            'createTime' => 'Create Time',
            'updateTime' => 'Update Time',
            'active' => 'Active',
            'createEmail' => 'Create Email',
            'updateEmail' => 'Update Email',
            'icount' => 'Icount',
            'note' => 'Note',
            'TotalOrderCount' => 'Total Order Count',
            'TotalOrderAmount' => 'Total Order Amount',
        ];
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
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['MerchantId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductEbays()
    {
        return $this->hasMany(ProductEbay::className(), ['MerchantId' => 'id']);
    }
}
