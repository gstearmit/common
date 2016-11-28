<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "payment_provider".
 *
 * @property integer $id
 * @property string $Name
 * @property string $alias
 * @property string $description
 * @property integer $active
 * @property string $return_url
 * @property string $cancel_url
 * @property string $submit_url
 * @property string $backgroud_url
 * @property string $image_url
 * @property string $logo_url
 * @property string $pending_url
 * @property integer $rc
 * @property string $alg
 * @property string $bmod
 * @property string $version
 * @property string $email
 * @property string $secret_key
 * @property string $merchantVerifyId
 * @property string $image
 * @property string $type
 * @property integer $siteId
 * @property integer $storeId
 * @property string $aes_iv
 * @property string $portal
 * @property string $token
 * @property string $wsdl
 *
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property PaymentMethodProvider[] $paymentMethodProviders
 * @property Site $site
 * @property Store $store
 * @property TransactionAccountSystem[] $transactionAccountSystems
 */
class PaymentProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'rc', 'siteId', 'storeId'], 'integer'],
            [['Name', 'alias', 'email'], 'string', 'max' => 100],
            [['description', 'return_url', 'cancel_url', 'submit_url', 'backgroud_url', 'image_url', 'logo_url', 'pending_url', 'bmod', 'secret_key', 'image'], 'string', 'max' => 255],
            [['alg', 'version', 'type'], 'string', 'max' => 10],
            [['merchantVerifyId', 'aes_iv', 'wsdl'], 'string', 'max' => 50],
            [['portal', 'token'], 'string', 'max' => 20],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
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
            'alias' => 'Alias',
            'description' => 'Description',
            'active' => 'Active',
            'return_url' => 'Return Url',
            'cancel_url' => 'Cancel Url',
            'submit_url' => 'Submit Url',
            'backgroud_url' => 'Backgroud Url',
            'image_url' => 'Image Url',
            'logo_url' => 'Logo Url',
            'pending_url' => 'Pending Url',
            'rc' => 'Rc',
            'alg' => 'Alg',
            'bmod' => 'Bmod',
            'version' => 'Version',
            'email' => 'Email',
            'secret_key' => 'Secret Key',
            'merchantVerifyId' => 'Merchant Verify ID',
            'image' => 'Image',
            'type' => 'Type',
            'siteId' => 'Site ID',
            'storeId' => 'Store ID',
            'aes_iv' => 'Aes Iv',
            'portal' => 'Portal',
            'token' => 'Token',
            'wsdl' => 'Wsdl',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['DefaultPaymentProviderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodProviders()
    {
        return $this->hasMany(PaymentMethodProvider::className(), ['paymentProviderId' => 'id']);
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
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccountSystems()
    {
        return $this->hasMany(TransactionAccountSystem::className(), ['PaymentProviderId' => 'id']);
    }
}
