<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_item".
 *
 * @property integer $id
 * @property string $Name
 * @property integer $Quantity
 * @property string $Price
 * @property string $SubTotal
 * @property string $ExRate
 * @property integer $CurrencyId
 * @property string $TotalInLocalCurrency
 * @property string $description
 * @property integer $InvoiceId
 * @property integer $Deleted
 * @property string $TaxAmount
 * @property string $TaxRate
 *
 * @property Invoice $invoice
 * @property SystemCurrency $currency
 */
class InvoiceItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Quantity', 'CurrencyId', 'InvoiceId', 'Deleted'], 'integer'],
            [['Price', 'SubTotal', 'ExRate', 'TotalInLocalCurrency', 'TaxAmount', 'TaxRate'], 'number'],
            [['Name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 255],
            [['InvoiceId'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['InvoiceId' => 'id']],
            [['CurrencyId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemCurrency::className(), 'targetAttribute' => ['CurrencyId' => 'id']],
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
            'Quantity' => 'Quantity',
            'Price' => 'Price',
            'SubTotal' => 'Sub Total',
            'ExRate' => 'Ex Rate',
            'CurrencyId' => 'Currency ID',
            'TotalInLocalCurrency' => 'Total In Local Currency',
            'description' => 'Description',
            'InvoiceId' => 'Invoice ID',
            'Deleted' => 'Deleted',
            'TaxAmount' => 'Tax Amount',
            'TaxRate' => 'Tax Rate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'InvoiceId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }
}
