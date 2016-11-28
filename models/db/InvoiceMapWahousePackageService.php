<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_wahouse_package_service".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $warehouse_package_service_id
 * @property integer $system_account_transaction_id
 *
 * @property Invoice $invoice
 * @property WarehousePackageService $warehousePackageService
 * @property SystemAccountTransaction $systemAccountTransaction
 */
class InvoiceMapWahousePackageService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_wahouse_package_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'warehouse_package_service_id', 'system_account_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['warehouse_package_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageService::className(), 'targetAttribute' => ['warehouse_package_service_id' => 'id']],
            [['system_account_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAccountTransaction::className(), 'targetAttribute' => ['system_account_transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'warehouse_package_service_id' => 'Warehouse Package Service ID',
            'system_account_transaction_id' => 'System Account Transaction ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageService()
    {
        return $this->hasOne(WarehousePackageService::className(), ['id' => 'warehouse_package_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransaction()
    {
        return $this->hasOne(SystemAccountTransaction::className(), ['id' => 'system_account_transaction_id']);
    }
}
