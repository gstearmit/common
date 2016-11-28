<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_tracking_code_expense".
 *
 * @property integer $id
 * @property integer $ShipmentBulkTrackingCodeId
 * @property integer $ShipmentBulkExpenseId
 * @property string $ExpenseAmountInLocalCurrency
 *
 * @property ShipmentBulkTrackingcode $shipmentBulkTrackingCode
 * @property ShipmentBulkExpense $shipmentBulkExpense
 */
class ShipmentBulkTrackingCodeExpense extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_tracking_code_expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShipmentBulkTrackingCodeId', 'ShipmentBulkExpenseId'], 'integer'],
            [['ExpenseAmountInLocalCurrency'], 'number'],
            [['ShipmentBulkTrackingCodeId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkTrackingcode::className(), 'targetAttribute' => ['ShipmentBulkTrackingCodeId' => 'id']],
            [['ShipmentBulkExpenseId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkExpense::className(), 'targetAttribute' => ['ShipmentBulkExpenseId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ShipmentBulkTrackingCodeId' => 'Shipment Bulk Tracking Code ID',
            'ShipmentBulkExpenseId' => 'Shipment Bulk Expense ID',
            'ExpenseAmountInLocalCurrency' => 'Expense Amount In Local Currency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkTrackingCode()
    {
        return $this->hasOne(ShipmentBulkTrackingcode::className(), ['id' => 'ShipmentBulkTrackingCodeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkExpense()
    {
        return $this->hasOne(ShipmentBulkExpense::className(), ['id' => 'ShipmentBulkExpenseId']);
    }
}
