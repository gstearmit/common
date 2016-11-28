<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "shipment_bulk_trackingcode_image".
 *
 * @property integer $id
 * @property integer $trackingCodeId
 * @property string $imgPath
 * @property string $uploadedTime
 *
 * @property ShipmentBulkTrackingcode $trackingCode
 */
class ShipmentBulkTrackingcodeImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment_bulk_trackingcode_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trackingCodeId'], 'integer'],
            [['uploadedTime'], 'safe'],
            [['imgPath'], 'string', 'max' => 255],
            [['trackingCodeId'], 'exist', 'skipOnError' => true, 'targetClass' => ShipmentBulkTrackingcode::className(), 'targetAttribute' => ['trackingCodeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trackingCodeId' => 'Tracking Code ID',
            'imgPath' => 'Img Path',
            'uploadedTime' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrackingCode()
    {
        return $this->hasOne(ShipmentBulkTrackingcode::className(), ['id' => 'trackingCodeId']);
    }
}
