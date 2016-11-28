<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "request_package_attachment".
 *
 * @property integer $id
 * @property integer $request_packages_id
 * @property string $name
 * @property string $path
 * @property string $extension
 * @property string $uploaded_time
 *
 * @property RequestPackages $requestPackages
 */
class RequestPackageAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_package_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_packages_id'], 'integer'],
            [['uploaded_time'], 'safe'],
            [['name', 'path'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 10],
            [['request_packages_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestPackages::className(), 'targetAttribute' => ['request_packages_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_packages_id' => 'Request Packages ID',
            'name' => 'Name',
            'path' => 'Path',
            'extension' => 'Extension',
            'uploaded_time' => 'Uploaded Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasOne(RequestPackages::className(), ['id' => 'request_packages_id']);
    }
}
