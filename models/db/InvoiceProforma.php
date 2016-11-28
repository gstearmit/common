<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_proforma".
 *
 * @property integer $id
 * @property integer $InvoiceStatus
 * @property string $CreateTime
 * @property string $UpdateTime
 * @property integer $CustomerId
 * @property integer $TypeInvoice
 * @property string $BillName
 * @property string $BillEmail
 * @property string $BillPhone
 * @property string $BillMobilePhone
 * @property string $BillAddress
 * @property string $BillZipCode
 * @property string $BillDistrict
 * @property string $BillProvince
 * @property string $BillCountry
 * @property string $SuiteNumber
 * @property string $RefOrderNumber
 * @property string $RefOrderTime
 * @property string $RefOrderProcessTime
 * @property string $RefOrderProcessBy
 * @property string $AirwayBillNumber
 * @property integer $ShipInBoxes
 * @property integer $SizeBoxes
 * @property integer $PackagesConsolidated
 * @property string $DeclarationValue
 * @property string $BillWeight
 * @property integer $WeightUnit
 * @property string $PaymentMethod
 * @property string $PaymentToken
 * @property integer $PaymentStatus
 * @property string $PaymentTransaction
 * @property string $LastPaidTime
 * @property string $Note
 * @property string $TotalExclTax
 * @property string $InvoiceTax
 * @property string $TotalInclTax
 * @property string $CurrencyName
 * @property string $CurrencyRate
 * @property string $TotalInLocalCurrency
 * @property string $TotalPaidAmount
 * @property string $RemainAmount
 * @property integer $TotalQuantityItems
 * @property integer $NumberOfLines
 * @property integer $ManageEmployeeId
 * @property integer $ManageOrganizationId
 * @property integer $StoreId
 * @property integer $SiteId
 * @property string $ShipName
 * @property string $ShipEmail
 * @property string $ShipPhone
 * @property string $ShipMobilePhone
 * @property string $ShipAddress
 * @property string $ShipZipCode
 * @property string $ShipDistrict
 * @property string $ShipProvince
 * @property string $ShipCountry
 * @property integer $InvoiceId
 * @property integer $CurrencyId
 *
 * @property InvoiceItemProforma[] $invoiceItemProformas
 * @property SystemWeightUnit $weightUnit
 * @property Invoice $invoice
 */
class InvoiceProforma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_proforma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['InvoiceStatus', 'CustomerId', 'TypeInvoice', 'ShipInBoxes', 'SizeBoxes', 'PackagesConsolidated', 'WeightUnit', 'PaymentStatus', 'TotalQuantityItems', 'NumberOfLines', 'ManageEmployeeId', 'ManageOrganizationId', 'StoreId', 'SiteId', 'InvoiceId', 'CurrencyId'], 'integer'],
            [['CreateTime', 'UpdateTime', 'RefOrderTime', 'RefOrderProcessTime', 'LastPaidTime'], 'safe'],
            [['DeclarationValue', 'BillWeight', 'TotalExclTax', 'InvoiceTax', 'TotalInclTax', 'CurrencyRate', 'TotalInLocalCurrency', 'TotalPaidAmount', 'RemainAmount'], 'number'],
            [['BillName', 'ShipName'], 'string', 'max' => 220],
            [['BillEmail', 'ShipEmail'], 'string', 'max' => 100],
            [['BillPhone', 'BillMobilePhone', 'PaymentMethod', 'ShipPhone', 'ShipMobilePhone'], 'string', 'max' => 50],
            [['BillAddress', 'ShipAddress'], 'string', 'max' => 500],
            [['BillZipCode', 'BillCountry', 'SuiteNumber', 'ShipZipCode', 'ShipCountry'], 'string', 'max' => 10],
            [['BillDistrict', 'BillProvince', 'RefOrderNumber', 'ShipDistrict', 'ShipProvince'], 'string', 'max' => 20],
            [['RefOrderProcessBy', 'AirwayBillNumber', 'PaymentToken', 'PaymentTransaction'], 'string', 'max' => 255],
            [['Note'], 'string', 'max' => 1000],
            [['CurrencyName'], 'string', 'max' => 11],
            [['WeightUnit'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['WeightUnit' => 'id']],
            [['InvoiceId'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['InvoiceId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'InvoiceStatus' => 'Invoice Status',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'CustomerId' => 'Customer ID',
            'TypeInvoice' => 'Type Invoice',
            'BillName' => 'Bill Name',
            'BillEmail' => 'Bill Email',
            'BillPhone' => 'Bill Phone',
            'BillMobilePhone' => 'Bill Mobile Phone',
            'BillAddress' => 'Bill Address',
            'BillZipCode' => 'Bill Zip Code',
            'BillDistrict' => 'Bill District',
            'BillProvince' => 'Bill Province',
            'BillCountry' => 'Bill Country',
            'SuiteNumber' => 'Suite Number',
            'RefOrderNumber' => 'Ref Order Number',
            'RefOrderTime' => 'Ref Order Time',
            'RefOrderProcessTime' => 'Ref Order Process Time',
            'RefOrderProcessBy' => 'Ref Order Process By',
            'AirwayBillNumber' => 'Airway Bill Number',
            'ShipInBoxes' => 'Ship In Boxes',
            'SizeBoxes' => 'Size Boxes',
            'PackagesConsolidated' => 'Packages Consolidated',
            'DeclarationValue' => 'Declaration Value',
            'BillWeight' => 'Bill Weight',
            'WeightUnit' => 'Weight Unit',
            'PaymentMethod' => 'Payment Method',
            'PaymentToken' => 'Payment Token',
            'PaymentStatus' => 'Payment Status',
            'PaymentTransaction' => 'Payment Transaction',
            'LastPaidTime' => 'Last Paid Time',
            'Note' => 'Note',
            'TotalExclTax' => 'Total Excl Tax',
            'InvoiceTax' => 'Invoice Tax',
            'TotalInclTax' => 'Total Incl Tax',
            'CurrencyName' => 'Currency Name',
            'CurrencyRate' => 'Currency Rate',
            'TotalInLocalCurrency' => 'Total In Local Currency',
            'TotalPaidAmount' => 'Total Paid Amount',
            'RemainAmount' => 'Remain Amount',
            'TotalQuantityItems' => 'Total Quantity Items',
            'NumberOfLines' => 'Number Of Lines',
            'ManageEmployeeId' => 'Manage Employee ID',
            'ManageOrganizationId' => 'Manage Organization ID',
            'StoreId' => 'Store ID',
            'SiteId' => 'Site ID',
            'ShipName' => 'Ship Name',
            'ShipEmail' => 'Ship Email',
            'ShipPhone' => 'Ship Phone',
            'ShipMobilePhone' => 'Ship Mobile Phone',
            'ShipAddress' => 'Ship Address',
            'ShipZipCode' => 'Ship Zip Code',
            'ShipDistrict' => 'Ship District',
            'ShipProvince' => 'Ship Province',
            'ShipCountry' => 'Ship Country',
            'InvoiceId' => 'Invoice ID',
            'CurrencyId' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItemProformas()
    {
        return $this->hasMany(InvoiceItemProforma::className(), ['InvoiceProforma' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeightUnit()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'WeightUnit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'InvoiceId']);
    }
}
