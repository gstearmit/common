<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_order_request_items_images".
 *
 * @property integer $id
 * @property string $Name
 * @property resource $ContentBinary
 * @property integer $PosOrderRequestItemsId
 * @property string $Path
 * @property string $Extension
 * @property string $UploadedTime
 *
 * @property PosOrderRequestItems $posOrderRequestItems
 */
class PosOrderRequestItemsImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_order_request_items_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ContentBinary'], 'string'],
            [['PosOrderRequestItemsId'], 'integer'],
            [['UploadedTime'], 'safe'],
            [['Name', 'Path'], 'string', 'max' => 255],
            [['Extension'], 'string', 'max' => 10],
            [['PosOrderRequestItemsId'], 'exist', 'skipOnError' => true, 'targetClass' => PosOrderRequestItems::className(), 'targetAttribute' => ['PosOrderRequestItemsId' => 'id']],
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
            'PosOrderRequestItemsId' => 'Pos Order Request Items ID',
            'Path' => 'Path',
            'Extension' => 'Extension',
            'UploadedTime' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequestItems()
    {
        return $this->hasOne(PosOrderRequestItems::className(), ['id' => 'PosOrderRequestItemsId']);
    }
}
