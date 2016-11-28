<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_bank".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Alias
 * @property string $Logo
 * @property string $Url
 * @property integer $SiteId
 * @property integer $StoreId
 *
 * @property PaymentMethodBank[] $paymentMethodBanks
 */
class SystemBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SiteId', 'StoreId'], 'integer'],
            [['Name', 'Logo', 'Url'], 'string', 'max' => 255],
            [['Alias'], 'string', 'max' => 50],
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
            'Alias' => 'Alias',
            'Logo' => 'Logo',
            'Url' => 'Url',
            'SiteId' => 'Site ID',
            'StoreId' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethodBanks()
    {
        return $this->hasMany(PaymentMethodBank::className(), ['BankId' => 'id']);
    }
}
