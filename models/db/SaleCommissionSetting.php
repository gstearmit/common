<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sale_commission_setting".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $TypeId
 * @property string $CreatedDate
 * @property string $LastedUpdate
 * @property integer $Active
 * @property integer $CreatedById
 * @property integer $CategoryId
 * @property integer $OrganizationId
 * @property integer $StoreId
 * @property string $PercentagePerOrder
 *
 * @property OrganizationEmployee $createdBy
 * @property Category $category
 * @property Organization $organization
 * @property Store $store
 * @property SaleCommissionSettingDetail[] $saleCommissionSettingDetails
 */
class SaleCommissionSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_commission_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedDate', 'LastedUpdate'], 'safe'],
            [['Active', 'CreatedById', 'CategoryId', 'OrganizationId', 'StoreId'], 'integer'],
            [['PercentagePerOrder'], 'number'],
            [['Name'], 'string', 'max' => 50],
            [['Description'], 'string', 'max' => 500],
            [['TypeId'], 'string', 'max' => 10],
            [['CreatedById'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['CreatedById' => 'id']],
            [['CategoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['CategoryId' => 'id']],
            [['OrganizationId'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['OrganizationId' => 'id']],
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
            'Name' => 'Name',
            'Description' => 'Description',
            'TypeId' => 'Type ID',
            'CreatedDate' => 'Created Date',
            'LastedUpdate' => 'Lasted Update',
            'Active' => 'Active',
            'CreatedById' => 'Created By ID',
            'CategoryId' => 'Category ID',
            'OrganizationId' => 'Organization ID',
            'StoreId' => 'Store ID',
            'PercentagePerOrder' => 'Percentage Per Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'CreatedById']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'CategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'OrganizationId']);
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
    public function getSaleCommissionSettingDetails()
    {
        return $this->hasMany(SaleCommissionSettingDetail::className(), ['CommissionId' => 'id']);
    }
}
