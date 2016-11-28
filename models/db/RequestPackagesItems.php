<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_packages_items".
 *
 * @property integer $id
 * @property string $tracking_number
 * @property string $vendor_name
 * @property integer $shipping_provider_id
 * @property string $product_link
 * @property string $product_description
 * @property string $product_name
 * @property string $unit_price
 * @property integer $quantity
 * @property string $total_amount
 * @property integer $request_packages_id
 * @property integer $currency_id
 * @property string $currency_rate
 * @property string $customer_note
 * @property string $created_time
 * @property string $processed_time
 * @property integer $process_employee_id
 * @property integer $notify_status
 * @property integer $received_status
 * @property string $received_time
 * @property string $warehouse_package_no
 * @property string $stocked_in_time
 * @property string $rejected_reason
 * @property integer $rejected_type_id
 * @property string $rejected_time
 * @property string $note
 * @property integer $customer_id
 * @property integer $received_quantity
 *
 * @property RequestPackageImages[] $requestPackageImages
 * @property RequestPackages $requestPackages
 * @property SystemCurrency $currency
 * @property OrganizationEmployee $processEmployee
 * @property Customer $customer
 */
class RequestPackagesItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_packages_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shipping_provider_id', 'quantity', 'request_packages_id', 'currency_id', 'process_employee_id', 'notify_status', 'received_status', 'rejected_type_id', 'customer_id', 'received_quantity'], 'integer'],
            [['unit_price', 'total_amount', 'currency_rate'], 'number'],
            [['created_time', 'processed_time', 'received_time', 'stocked_in_time', 'rejected_time'], 'safe'],
            [['tracking_number', 'vendor_name', 'product_description', 'product_name', 'customer_note'], 'string', 'max' => 255],
            [['product_link', 'note'], 'string', 'max' => 1000],
            [['warehouse_package_no'], 'string', 'max' => 100],
            [['rejected_reason'], 'string', 'max' => 4000],
            [['request_packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestPackages::className(), 'targetAttribute' => ['request_packages_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['process_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['process_employee_id' => 'id']],
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
            'tracking_number' => 'Tracking Number',
            'vendor_name' => 'Vendor Name',
            'shipping_provider_id' => 'Shipping Provider ID',
            'product_link' => 'Product Link',
            'product_description' => 'Product Description',
            'product_name' => 'Product Name',
            'unit_price' => 'Unit Price',
            'quantity' => 'Quantity',
            'total_amount' => 'Total Amount',
            'request_packages_id' => 'Request Packages ID',
            'currency_id' => 'Currency ID',
            'currency_rate' => 'Currency Rate',
            'customer_note' => 'Customer Note',
            'created_time' => 'Created Time',
            'processed_time' => 'Processed Time',
            'process_employee_id' => 'Process Employee ID',
            'notify_status' => 'Notify Status',
            'received_status' => 'Received Status',
            'received_time' => 'Received Time',
            'warehouse_package_no' => 'Warehouse Package No',
            'stocked_in_time' => 'Stocked In Time',
            'rejected_reason' => 'Rejected Reason',
            'rejected_type_id' => 'Rejected Type ID',
            'rejected_time' => 'Rejected Time',
            'note' => 'Note',
            'customer_id' => 'Customer ID',
            'received_quantity' => 'Received Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackageImages()
    {
        return $this->hasMany(RequestPackageImages::className(), ['request_packages_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasOne(RequestPackages::className(), ['id' => 'request_packages_id']);
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
    public function getProcessEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'process_employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
