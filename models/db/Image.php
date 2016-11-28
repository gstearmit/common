<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $targetId
 * @property integer $position
 * @property string $type
 * @property integer $width
 * @property integer $height
 * @property string $extension
 * @property string $imageId
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'width', 'height'], 'integer'],
            [['targetId', 'imageId'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 20],
            [['extension'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'targetId' => 'Target ID',
            'position' => 'Position',
            'type' => 'Type',
            'width' => 'Width',
            'height' => 'Height',
            'extension' => 'Extension',
            'imageId' => 'Image ID',
        ];
    }
}
