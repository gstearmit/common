<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "file_upload".
 *
 * @property integer $id
 * @property string $Title
 * @property string $Description
 * @property string $KeywordSearch
 * @property string $CreatedTime
 * @property string $PhysicalPath
 * @property string $UrlPath
 * @property integer $IsDownload
 * @property integer $IsActive
 * @property integer $Deleted
 *
 * @property CustomerClaimFile[] $customerClaimFiles
 * @property CustomerHelpdeskFile[] $customerHelpdeskFiles
 * @property Order[] $orders
 * @property Order[] $orders0
 */
class FileUpload extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_upload';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreatedTime'], 'safe'],
            [['PhysicalPath'], 'string'],
            [['IsDownload', 'IsActive', 'Deleted'], 'integer'],
            [['Title', 'Description', 'KeywordSearch', 'UrlPath'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'KeywordSearch' => 'Keyword Search',
            'CreatedTime' => 'Created Time',
            'PhysicalPath' => 'Physical Path',
            'UrlPath' => 'Url Path',
            'IsDownload' => 'Is Download',
            'IsActive' => 'Is Active',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaimFiles()
    {
        return $this->hasMany(CustomerClaimFile::className(), ['fileuploadId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdeskFiles()
    {
        return $this->hasMany(CustomerHelpdeskFile::className(), ['fileuploadId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['FileSentToCustomerId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['FileStoreId' => 'id']);
    }
}
