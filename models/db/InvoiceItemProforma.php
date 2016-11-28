<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_item_proforma".
 *
 * @property integer $id
 * @property string $Name
 * @property integer $Quantity
 * @property string $Price
 * @property string $SubTotal
 * @property string $ExRate
 * @property string $TotalInLocalCurrency
 * @property string $description
 * @property integer $InvoiceProforma
 * @property integer $CurrencyId
 *
 * @property InvoiceProforma $invoiceProforma
 * @property SystemCurrency $currency
 */
class InvoiceItemProforma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_item_proforma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Quantity', 'InvoiceProforma', 'CurrencyId'], 'integer'],
            [['Price', 'SubTotal', 'ExRate', 'TotalInLocalCurrency'], 'number'],
            [['Name'], 'string', 'max' => 500],
            [['description'], 'string', 'max' => 255],
            [['InvoiceProforma'], 'exist', 'skipOnError' => true, 'targetClass' => InvoiceProforma::className(), 'targetAttribute' => ['InvoiceProforma' => 'id']],
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
            'TotalInLocalCurrency' => 'Total In Local Currency',
            'description' => 'Description',
            'InvoiceProforma' => 'Invoice Proforma',
            'CurrencyId' => 'Currency ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceProforma()
    {
        return $this->hasOne(InvoiceProforma::className(), ['id' => 'InvoiceProforma']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(SystemCurrency::className(), ['id' => 'CurrencyId']);
    }
}
