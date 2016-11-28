<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_claim_file".
 *
 * @property integer $id
 * @property integer $claimId
 * @property integer $fileuploadId
 *
 * @property CustomerClaim $claim
 * @property FileUpload $fileupload
 */
class CustomerClaimFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_claim_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['claimId', 'fileuploadId'], 'integer'],
            [['claimId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerClaim::className(), 'targetAttribute' => ['claimId' => 'id']],
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
            'claimId' => 'Claim ID',
            'fileuploadId' => 'Fileupload ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaim()
    {
        return $this->hasOne(CustomerClaim::className(), ['id' => 'claimId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileupload()
    {
        return $this->hasOne(FileUpload::className(), ['id' => 'fileuploadId']);
    }
}
