<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_expense_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 *
 * @property ShipmentBulkExpense[] $shipmentBulkExpenses
 */
class ShipmentBulkExpenseType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_expense_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Description'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkExpenses()
    {
        return $this->hasMany(ShipmentBulkExpense::className(), ['ExpenseTypeId' => 'id']);
    }
}
