<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_order_request".
 *
 * @property integer $id
 * @property integer $TypeReceive
 * @property string $CustomerFullName
 * @property integer $CustomerPosId
 * @property string $CustomerPhone
 * @property string $CustomerEmail
 * @property string $CustomerSocialNumber
 * @property resource $CustomerImageBlob
 * @property string $CustomerImagePath
 * @property string $TrackingCodePackage
 * @property string $SecurityCodePackage
 * @property integer $AgreedReceiptPackage
 * @property integer $RejectedPackage
 * @property integer $RejectedReasonType
 * @property string $RejectedDesciption
 * @property string $SenderFullName
 * @property string $SenderSocialNumber
 * @property string $SenderPhone
 * @property string $SenderHomePhone
 * @property string $SenderEmail
 * @property string $SenderAddressLine1
 * @property string $SenderAddressLine2
 * @property string $SenderPostalCode
 * @property integer $SenderDistrictId
 * @property integer $SenderProvinceId
 * @property integer $SenderCountryId
 * @property string $ReceiverFullName
 * @property string $ReceiverSocialNumber
 * @property string $ReceiverPhone
 * @property string $ReceiverHomePhone
 * @property string $ReceiverEmail
 * @property string $ReceiverAddressLine1
 * @property string $ReceiverAddressLine2
 * @property string $ReceiverPostalCode
 * @property integer $ReceiverDistrictId
 * @property integer $ReceiverProvinceId
 * @property integer $ReceiverCountryId
 * @property string $PackageCode
 * @property string $PackageDescription
 * @property integer $PackageProductQuantity
 * @property resource $PackageImageBlob
 * @property integer $SystemWeightUnitId
 * @property string $ActualWeight
 * @property string $DimensionWeight
 * @property integer $SystemDimensionId
 * @property integer $Length
 * @property integer $Width
 * @property integer $Height
 * @property string $ChargedWeight
 * @property integer $TotalItems
 * @property string $TotalDelareValues
 * @property string $TotalInsuranceValues
 * @property string $TotalFee
 * @property string $TotalFeeInLocalCurrency
 * @property integer $ReceiptMethodId
 * @property integer $PaymentMethodProviderId
 * @property string $PaymentMethodName
 * @property integer $ConfirmPayment
 * @property string $Note
 * @property string $ItemName
 * @property string $ItemDescription
 * @property integer $ItemCategoryCustomerPolicyId
 * @property string $ItemUnitPrice
 * @property integer $ItemCurrencyId
 * @property integer $ItemQuantity
 * @property string $ItemSubTotal
 * @property string $ItemInsurancedSubTotal
 * @property string $ItemCurrencyRate
 * @property string $ItemSubTotalInLocalCurrency
 * @property integer $PosSettingId
 * @property integer $StoreId
 * @property integer $ShippingAddressId
 * @property integer $BillingAddressId
 * @property integer $AssigneToStoreId
 * @property string $EmployeeName
 * @property integer $EmployeeId
 * @property string $EmployeeEmail
 * @property integer $ActualDimensionX
 * @property integer $ActualDimensionY
 * @property integer $ActualDimensionZ
 * @property integer $DimensionUnitId
 *
 * @property PosCustomer $customerPos
 * @property CategoryCustomPolicy $itemCategoryCustomerPolicy
 * @property Store $store
 * @property PosAddress $shippingAddress
 * @property PosAddress $billingAddress
 * @property Store $assigneToStore
 * @property OrganizationEmployee $employee
 * @property SystemDistrict $senderDistrict
 * @property SystemStateProvince $senderProvince
 * @property SystemCountry $senderCountry
 * @property SystemDistrict $receiverDistrict
 * @property SystemStateProvince $receiverProvince
 * @property SystemCountry $receiverCountry
 * @property SystemWeightUnit $systemWeightUnit
 * @property PosSetting $posSetting
 * @property PosOrderRequestImages[] $posOrderRequestImages
 * @property PosOrderRequestItems[] $posOrderRequestItems
 * @property PosOrderRequestServices[] $posOrderRequestServices
 */
class PosOrderRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_order_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TypeReceive', 'CustomerPosId', 'AgreedReceiptPackage', 'RejectedPackage', 'RejectedReasonType', 'SenderDistrictId', 'SenderProvinceId', 'SenderCountryId', 'ReceiverDistrictId', 'ReceiverProvinceId', 'ReceiverCountryId', 'PackageProductQuantity', 'SystemWeightUnitId', 'SystemDimensionId', 'Length', 'Width', 'Height', 'TotalItems', 'ReceiptMethodId', 'PaymentMethodProviderId', 'ConfirmPayment', 'ItemCategoryCustomerPolicyId', 'ItemCurrencyId', 'ItemQuantity', 'PosSettingId', 'StoreId', 'ShippingAddressId', 'BillingAddressId', 'AssigneToStoreId', 'EmployeeId', 'ActualDimensionX', 'ActualDimensionY', 'ActualDimensionZ', 'DimensionUnitId'], 'integer'],
            [['CustomerImageBlob', 'PackageImageBlob'], 'string'],
            [['ActualWeight', 'DimensionWeight', 'ChargedWeight', 'TotalDelareValues', 'TotalInsuranceValues', 'TotalFee', 'TotalFeeInLocalCurrency', 'ItemUnitPrice', 'ItemSubTotal', 'ItemInsurancedSubTotal', 'ItemCurrencyRate', 'ItemSubTotalInLocalCurrency'], 'number'],
            [['CustomerFullName', 'CustomerPhone', 'CustomerEmail', 'CustomerImagePath', 'TrackingCodePackage', 'SecurityCodePackage', 'SenderFullName', 'SenderSocialNumber', 'SenderPhone', 'SenderHomePhone', 'SenderEmail', 'SenderAddressLine1', 'SenderAddressLine2', 'SenderPostalCode', 'ReceiverFullName', 'ReceiverSocialNumber', 'ReceiverPhone', 'ReceiverHomePhone', 'ReceiverEmail', 'ReceiverAddressLine1', 'ReceiverAddressLine2', 'ReceiverPostalCode', 'PackageCode', 'PackageDescription', 'PaymentMethodName', 'ItemName', 'ItemDescription', 'EmployeeName', 'EmployeeEmail'], 'string', 'max' => 255],
            [['CustomerSocialNumber'], 'string', 'max' => 50],
            [['RejectedDesciption', 'Note'], 'string', 'max' => 1000],
            [['CustomerPosId'], 'exist', 'skipOnError' => true, 'targetClass' => PosCustomer::className(), 'targetAttribute' => ['CustomerPosId' => 'id']],
            [['ItemCategoryCustomerPolicyId'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCustomPolicy::className(), 'targetAttribute' => ['ItemCategoryCustomerPolicyId' => 'id']],
            [['StoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['StoreId' => 'id']],
            [['ShippingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => PosAddress::className(), 'targetAttribute' => ['ShippingAddressId' => 'id']],
            [['BillingAddressId'], 'exist', 'skipOnError' => true, 'targetClass' => PosAddress::className(), 'targetAttribute' => ['BillingAddressId' => 'id']],
            [['AssigneToStoreId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['AssigneToStoreId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
            [['SenderDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['SenderDistrictId' => 'id']],
            [['SenderProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['SenderProvinceId' => 'id']],
            [['SenderCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['SenderCountryId' => 'id']],
            [['ReceiverDistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['ReceiverDistrictId' => 'id']],
            [['ReceiverProvinceId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemStateProvince::className(), 'targetAttribute' => ['ReceiverProvinceId' => 'id']],
            [['ReceiverCountryId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCountry::className(), 'targetAttribute' => ['ReceiverCountryId' => 'id']],
            [['SystemWeightUnitId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemWeightUnit::className(), 'targetAttribute' => ['SystemWeightUnitId' => 'id']],
            [['PosSettingId'], 'exist', 'skipOnError' => true, 'targetClass' => PosSetting::className(), 'targetAttribute' => ['PosSettingId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'TypeReceive' => 'Type Receive',
            'CustomerFullName' => 'Customer Full Name',
            'CustomerPosId' => 'Customer Pos ID',
            'CustomerPhone' => 'Customer Phone',
            'CustomerEmail' => 'Customer Email',
            'CustomerSocialNumber' => 'Customer Social Number',
            'CustomerImageBlob' => 'Customer Image Blob',
            'CustomerImagePath' => 'Customer Image Path',
            'TrackingCodePackage' => 'Tracking Code Package',
            'SecurityCodePackage' => 'Security Code Package',
            'AgreedReceiptPackage' => 'Agreed Receipt Package',
            'RejectedPackage' => 'Rejected Package',
            'RejectedReasonType' => 'Rejected Reason Type',
            'RejectedDesciption' => 'Rejected Desciption',
            'SenderFullName' => 'Sender Full Name',
            'SenderSocialNumber' => 'Sender Social Number',
            'SenderPhone' => 'Sender Phone',
            'SenderHomePhone' => 'Sender Home Phone',
            'SenderEmail' => 'Sender Email',
            'SenderAddressLine1' => 'Sender Address Line1',
            'SenderAddressLine2' => 'Sender Address Line2',
            'SenderPostalCode' => 'Sender Postal Code',
            'SenderDistrictId' => 'Sender District ID',
            'SenderProvinceId' => 'Sender Province ID',
            'SenderCountryId' => 'Sender Country ID',
            'ReceiverFullName' => 'Receiver Full Name',
            'ReceiverSocialNumber' => 'Receiver Social Number',
            'ReceiverPhone' => 'Receiver Phone',
            'ReceiverHomePhone' => 'Receiver Home Phone',
            'ReceiverEmail' => 'Receiver Email',
            'ReceiverAddressLine1' => 'Receiver Address Line1',
            'ReceiverAddressLine2' => 'Receiver Address Line2',
            'ReceiverPostalCode' => 'Receiver Postal Code',
            'ReceiverDistrictId' => 'Receiver District ID',
            'ReceiverProvinceId' => 'Receiver Province ID',
            'ReceiverCountryId' => 'Receiver Country ID',
            'PackageCode' => 'Package Code',
            'PackageDescription' => 'Package Description',
            'PackageProductQuantity' => 'Package Product Quantity',
            'PackageImageBlob' => 'Package Image Blob',
            'SystemWeightUnitId' => 'System Weight Unit ID',
            'ActualWeight' => 'Actual Weight',
            'DimensionWeight' => 'Dimension Weight',
            'SystemDimensionId' => 'System Dimension ID',
            'Length' => 'Length',
            'Width' => 'Width',
            'Height' => 'Height',
            'ChargedWeight' => 'Charged Weight',
            'TotalItems' => 'Total Items',
            'TotalDelareValues' => 'Total Delare Values',
            'TotalInsuranceValues' => 'Total Insurance Values',
            'TotalFee' => 'Total Fee',
            'TotalFeeInLocalCurrency' => 'Total Fee In Local Currency',
            'ReceiptMethodId' => 'Receipt Method ID',
            'PaymentMethodProviderId' => 'Payment Method Provider ID',
            'PaymentMethodName' => 'Payment Method Name',
            'ConfirmPayment' => 'Confirm Payment',
            'Note' => 'Note',
            'ItemName' => 'Item Name',
            'ItemDescription' => 'Item Description',
            'ItemCategoryCustomerPolicyId' => 'Item Category Customer Policy ID',
            'ItemUnitPrice' => 'Item Unit Price',
            'ItemCurrencyId' => 'Item Currency ID',
            'ItemQuantity' => 'Item Quantity',
            'ItemSubTotal' => 'Item Sub Total',
            'ItemInsurancedSubTotal' => 'Item Insuranced Sub Total',
            'ItemCurrencyRate' => 'Item Currency Rate',
            'ItemSubTotalInLocalCurrency' => 'Item Sub Total In Local Currency',
            'PosSettingId' => 'Pos Setting ID',
            'StoreId' => 'Store ID',
            'ShippingAddressId' => 'Shipping Address ID',
            'BillingAddressId' => 'Billing Address ID',
            'AssigneToStoreId' => 'Assigne To Store ID',
            'EmployeeName' => 'Employee Name',
            'EmployeeId' => 'Employee ID',
            'EmployeeEmail' => 'Employee Email',
            'ActualDimensionX' => 'Actual Dimension X',
            'ActualDimensionY' => 'Actual Dimension Y',
            'ActualDimensionZ' => 'Actual Dimension Z',
            'DimensionUnitId' => 'Dimension Unit ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerPos()
    {
        return $this->hasOne(PosCustomer::className(), ['id' => 'CustomerPosId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategoryCustomerPolicy()
    {
        return $this->hasOne(CategoryCustomPolicy::className(), ['id' => 'ItemCategoryCustomerPolicyId']);
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
    public function getShippingAddress()
    {
        return $this->hasOne(PosAddress::className(), ['id' => 'ShippingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingAddress()
    {
        return $this->hasOne(PosAddress::className(), ['id' => 'BillingAddressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigneToStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'AssigneToStoreId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'SenderDistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'SenderProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSenderCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'SenderCountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'ReceiverDistrictId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverProvince()
    {
        return $this->hasOne(SystemStateProvince::className(), ['id' => 'ReceiverProvinceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiverCountry()
    {
        return $this->hasOne(SystemCountry::className(), ['id' => 'ReceiverCountryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemWeightUnit()
    {
        return $this->hasOne(SystemWeightUnit::className(), ['id' => 'SystemWeightUnitId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSetting()
    {
        return $this->hasOne(PosSetting::className(), ['id' => 'PosSettingId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestImages()
    {
        return $this->hasMany(PosOrderRequestImages::className(), ['PosOrderRequestId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItems()
    {
        return $this->hasMany(PosOrderRequestItems::className(), ['PosOrderRequestId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestServices()
    {
        return $this->hasMany(PosOrderRequestServices::className(), ['PosOrderRequestId' => 'id']);
    }
}
