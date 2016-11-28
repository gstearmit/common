<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_order_request_images".
 *
 * @property integer $id
 * @property string $Name
 * @property resource $ContentBinary
 * @property integer $PosOrderRequestId
 * @property string $Path
 * @property string $Extension
 * @property string $UploadedTime
 *
 * @property PosOrderRequest $posOrderRequest
 */
class PosOrderRequestImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_order_request_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ContentBinary'], 'string'],
            [['PosOrderRequestId'], 'integer'],
            [['UploadedTime'], 'safe'],
            [['Name', 'Path'], 'string', 'max' => 255],
            [['Extension'], 'string', 'max' => 10],
            [['PosOrderRequestId'], 'exist', 'skipOnError' => true, 'targetClass' => PosOrderRequest::className(), 'targetAttribute' => ['PosOrderRequestId' => 'id']],
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
            'ContentBinary' => 'Content Binary',
            'PosOrderRequestId' => 'Pos Order Request ID',
            'Path' => 'Path',
            'Extension' => 'Extension',
            'UploadedTime' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequest()
    {
        return $this->hasOne(PosOrderRequest::className(), ['id' => 'PosOrderRequestId']);
    }
}
