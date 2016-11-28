<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "pos_customer_images".
 *
 * @property integer $id
 * @property string $Name
 * @property resource $ContentBinary
 * @property integer $PosCustomerId
 * @property string $Path
 * @property string $Extension
 * @property string $UploadedTime
 *
 * @property PosCustomer $posCustomer
 */
class PosCustomerImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pos_customer_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ContentBinary'], 'string'],
            [['PosCustomerId'], 'integer'],
            [['UploadedTime'], 'safe'],
            [['Name', 'Path'], 'string', 'max' => 255],
            [['Extension'], 'string', 'max' => 10],
            [['PosCustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => PosCustomer::className(), 'targetAttribute' => ['PosCustomerId' => 'id']],
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
            'PosCustomerId' => 'Pos Customer ID',
            'Path' => 'Path',
            'Extension' => 'Extension',
            'UploadedTime' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosCustomer()
    {
        return $this->hasOne(PosCustomer::className(), ['id' => 'PosCustomerId']);
    }
}
