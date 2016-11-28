<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_note".
 *
 * @property integer $id
 * @property integer $EmployeeId
 * @property integer $PurchaseOrderId
 * @property string $Note
 * @property string $CreatedTime
 *
 * @property PurchaseOrder $purchaseOrder
 * @property OrganizationEmployee $employee
 */
class PurchaseOrderNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeId', 'PurchaseOrderId'], 'integer'],
            [['Note'], 'string'],
            [['CreatedTime'], 'safe'],
            [['PurchaseOrderId'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['PurchaseOrderId' => 'id']],
            [['EmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['EmployeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'EmployeeId' => 'Employee ID',
            'PurchaseOrderId' => 'Purchase Order ID',
            'Note' => 'Note',
            'CreatedTime' => 'Created Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'PurchaseOrderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'EmployeeId']);
    }
}
