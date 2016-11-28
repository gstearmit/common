<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "membership_packages_detail".
 *
 * @property integer $id
 * @property string $system_name
 * @property string $name
 * @property string $description
 * @property integer $active
 * @property integer $display_order
 * @property integer $store_id
 *
 * @property Store $store
 * @property MembershipPackagesOffer[] $membershipPackagesOffers
 */
class MembershipPackagesDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membership_packages_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'display_order', 'store_id'], 'integer'],
            [['system_name', 'name', 'description'], 'string', 'max' => 255],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'system_name' => 'System Name',
            'name' => 'Name',
            'description' => 'Description',
            'active' => 'Active',
            'display_order' => 'Display Order',
            'store_id' => 'Store ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipPackagesOffers()
    {
        return $this->hasMany(MembershipPackagesOffer::className(), ['detail_id' => 'id']);
    }
}
