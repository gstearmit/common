<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_helpdesk_file".
 *
 * @property integer $id
 * @property integer $helpdeskId
 * @property integer $fileuploadId
 *
 * @property CustomerHelpdesk $helpdesk
 * @property FileUpload $fileupload
 */
class CustomerHelpdeskFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_helpdesk_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['helpdeskId', 'fileuploadId'], 'integer'],
            [['helpdeskId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerHelpdesk::className(), 'targetAttribute' => ['helpdeskId' => 'id']],
            [['fileuploadId'], 'exist', 'skipOnError' => true, 'targetClass' => FileUpload::className(), 'targetAttribute' => ['fileuploadId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'helpdeskId' => 'Helpdesk ID',
            'fileuploadId' => 'Fileupload ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHelpdesk()
    {
        return $this->hasOne(CustomerHelpdesk::className(), ['id' => 'helpdeskId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileupload()
    {
        return $this->hasOne(FileUpload::className(), ['id' => 'fileuploadId']);
    }
}
