<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_claim_type".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $Description
 * @property integer $StoreId
 *
 * @property CustomerClaim[] $customerClaims
 * @property Store $store
 * @property CustomerHelpdesk[] $customerHelpdesks
 */
class CustomerClaimType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_claim_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StoreId'], 'integer'],
            [['Name', 'Description'], 'string', 'max' => 255],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['typeId' => 'Id']);
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
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['typeId' => 'Id']);
    }
}
