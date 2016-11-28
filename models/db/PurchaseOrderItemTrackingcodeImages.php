<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "purchase_order_item_trackingcode_images".
 *
 * @property integer $id
 * @property integer $PurchaseOrderItemTrackingcodeId
 * @property string $url
 * @property string $session
 */
class PurchaseOrderItemTrackingcodeImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_item_trackingcode_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PurchaseOrderItemTrackingcodeId'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['session'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'PurchaseOrderItemTrackingcodeId' => 'Purchase Order Item Trackingcode ID',
            'url' => 'Url',
            'session' => 'Session',
        ];
    }
}
