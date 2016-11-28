<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_packages".
 *
 * @property integer $id
 * @property integer $warehouse_id
 * @property string $vendor_name
 * @property string $order_date
 * @property string $order_number
 * @property string $total_amount
 * @property integer $currency_id
 * @property string $currency_rate
 * @property string $customer_note
 * @property string $created_time
 * @property integer $customer_id
 * @property string $customer_email
 * @property string $customer_name
 * @property string $customer_phone
 * @property integer $support_status
 * @property integer $manage_employee_id
 * @property string $processed_time
 * @property integer $process_employee_id
 * @property integer $notify_status
 * @property integer $received_status
 * @property string $received_time
 * @property string $stocked_in_time
 * @property string $rejected_reason
 * @property integer $rejected_type_id
 * @property string $rejected_time
 * @property integer $siteId
 * @property integer $storeId
 * @property integer $active
 * @property integer $package_type
 *
 * @property RequestPackageAttachment[] $requestPackageAttachments
 * @property Warehouse $warehouse
 * @property SystemCurrency $currency
 * @property OrganizationEmployee $manageEmployee
 * @property OrganizationEmployee $processEmployee
 * @property Store $store
 * @property Customer $customer
 * @property RequestPackagesItems[] $requestPackagesItems
 * @property WarehousePackage[] $warehousePackages
 */
class RequestPackages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_id', 'currency_id', 'customer_id', 'support_status', 'manage_employee_id', 'process_employee_id', 'notify_status', 'received_status', 'rejected_type_id', 'siteId', 'storeId', 'active', 'package_type'], 'integer'],
            [['order_date', 'created_time', 'processed_time', 'received_time', 'stocked_in_time', 'rejected_time'], 'safe'],
            [['total_amount', 'currency_rate'], 'number'],
            [['vendor_name', 'order_number', 'customer_note'], 'string', 'max' => 255],
            [['customer_email', 'customer_name', 'customer_phone'], 'string', 'max' => 50],
            [['rejected_reason'], 'string', 'max' => 4000],
            [['warehouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::className(), 'targetAttribute' => ['warehouse_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['manage_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['manage_employee_id' => 'id']],
            [['process_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['process_employee_id' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'warehouse_id' => 'Warehouse ID',
            'vendor_name' => 'Vendor Name',
            'order_date' => 'Order Date',
            'order_number' => 'Order Number',
            'total_amount' => 'Total Amount',
            'currency_id' => 'Currency ID',
            'currency_rate' => 'Currency Rate',
            'customer_note' => 'Customer Note',
            'created_time' => 'Created Time',
            'customer_id' => 'Customer ID',
            'customer_email' => 'Customer Email',
            'customer_name' => 'Customer Name',
            'customer_phone' => 'Customer Phone',
            'support_status' => 'Support Status',
            'manage_employee_id' => 'Manage Employee ID',
            'processed_time' => 'Processed Time',
            'process_employee_id' => 'Process Employee ID',
            'notify_status' => 'Notify Status',
            'received_status' => 'Received Status',
            'received_time' => 'Received Time',
            'stocked_in_time' => 'Stocked In Time',
            'rejected_reason' => 'Rejected Reason',
            'rejected_type_id' => 'Rejected Type ID',
            'rejected_time' => 'Rejected Time',
            'siteId' => 'Site ID',
            'storeId' => 'Store ID',
            'active' => 'Active',
            'package_type' => 'Package Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackageAttachments()
    {
        return $this->hasMany(RequestPackageAttachment::className(), ['request_packages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::className(), ['id' => 'warehouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManageEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'manage_employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'process_employee_id']);
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackagesItems()
    {
        return $this->hasMany(RequestPackagesItems::className(), ['request_packages_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['RequestPackagesId' => 'id']);
    }
}
