<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_package_images".
 *
 * @property integer $id
 * @property integer $request_packages_item_id
 * @property string $name
 * @property string $path
 * @property string $extension
 * @property string $uploaded_time
 *
 * @property RequestPackagesItems $requestPackagesItem
 */
class RequestPackageImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_package_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_packages_item_id'], 'integer'],
            [['uploaded_time'], 'safe'],
            [['name', 'path'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 10],
            [['request_packages_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestPackagesItems::className(), 'targetAttribute' => ['request_packages_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_packages_item_id' => 'Request Packages Item ID',
            'name' => 'Name',
            'path' => 'Path',
            'extension' => 'Extension',
            'uploaded_time' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackagesItem()
    {
        return $this->hasOne(RequestPackagesItems::className(), ['id' => 'request_packages_item_id']);
    }
}
