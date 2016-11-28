<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_service".
 *
 * @property integer $id
 * @property integer $WarehousePackageId
 * @property string $TotalChargedItemsPackage
 * @property string $TotalChargedOnlyPackage
 * @property string $TotalCharged
 * @property integer $CurrencyId
 * @property string $CurrencyRate
 * @property string $TotalChargedInLocalCurrency
 * @property string $TotalChargedPaid
 * @property string $RemainChargedNotPaid
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property string $LastPaidTime
 * @property string $InvoiceNumber
 * @property string $RequestedTime
 * @property string $ProcessedTime
 * @property integer $ProcesssedByEmployeeId
 * @property integer $ProcessStatus
 * @property string $RejectedReason
 * @property integer $StoreId
 * @property string $Note
 *
 * @property InvoiceMapWahousePackageService[] $invoiceMapWahousePackageServices
 * @property WarehousePackage $warehousePackage
 * @property SystemCurrency $currency
 * @property OrganizationEmployee $processsedByEmployee
 * @property Store $store
 * @property WarehousePackageServiceDetail[] $warehousePackageServiceDetails
 */
class WarehousePackageService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WarehousePackageId', 'CurrencyId', 'PaymentStatus', 'ProcesssedByEmployeeId', 'ProcessStatus', 'StoreId'], 'integer'],
            [['TotalChargedItemsPackage', 'TotalChargedOnlyPackage', 'TotalCharged', 'CurrencyRate', 'TotalChargedInLocalCurrency', 'TotalChargedPaid', 'RemainChargedNotPaid'], 'number'],
            [['LastPaidTime', 'RequestedTime', 'ProcessedTime'], 'safe'],
            [['PaymentMethod'], 'string', 'max' => 50],
            [['PaymentToken', 'PaymentTransaction', 'RejectedReason'], 'string', 'max' => 255],
            [['InvoiceNumber'], 'string', 'max' => 20],
            [['Note'], 'string', 'max' => 1000],
            [['WarehousePackageId'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['WarehousePackageId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
            [['ProcesssedByEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['ProcesssedByEmployeeId' => 'id']],
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
            'WarehousePackageId' => 'Warehouse Package ID',
            'TotalChargedItemsPackage' => 'Total Charged Items Package',
            'TotalChargedOnlyPackage' => 'Total Charged Only Package',
            'TotalCharged' => 'Total Charged',
            'CurrencyId' => 'Currency ID',
            'CurrencyRate' => 'Currency Rate',
            'TotalChargedInLocalCurrency' => 'Total Charged In Local Currency',
            'TotalChargedPaid' => 'Total Charged Paid',
            'RemainChargedNotPaid' => 'Remain Charged Not Paid',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'LastPaidTime' => 'Last Paid Time',
            'InvoiceNumber' => 'Invoice Number',
            'RequestedTime' => 'Requested Time',
            'ProcessedTime' => 'Processed Time',
            'ProcesssedByEmployeeId' => 'Processsed By Employee ID',
            'ProcessStatus' => 'Process Status',
            'RejectedReason' => 'Rejected Reason',
            'StoreId' => 'Store ID',
            'Note' => 'Note',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapWahousePackageServices()
    {
        return $this->hasMany(InvoiceMapWahousePackageService::className(), ['warehouse_package_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackage()
    {
        return $this->hasOne(WarehousePackage::className(), ['id' => 'WarehousePackageId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcesssedByEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'ProcesssedByEmployeeId']);
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
    public function getWarehousePackageServiceDetails()
    {
        return $this->hasMany(WarehousePackageServiceDetail::className(), ['warehouse_package_service_id' => 'id']);
    }
}
