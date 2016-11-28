<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_district_ward".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property integer $IsDefault
 * @property integer $DisplayOrder
 * @property integer $IsActive
 * @property integer $DistrictId
 * @property string $Abbreviation
 *
 * @property SystemDistrict $district
 */
class SystemDistrictWard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_district_ward';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsDefault', 'DisplayOrder', 'IsActive', 'DistrictId'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['SystemKeyword'], 'string', 'max' => 150],
            [['Abbreviation'], 'string', 'max' => 100],
            [['DistrictId'], 'exist', 'skipOnError' => true, 'targetClass' => SystemDistrict::className(), 'targetAttribute' => ['DistrictId' => 'id']],
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
            'SystemKeyword' => 'System Keyword',
            'IsDefault' => 'Is Default',
            'DisplayOrder' => 'Display Order',
            'IsActive' => 'Is Active',
            'DistrictId' => 'District ID',
            'Abbreviation' => 'Abbreviation',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(SystemDistrict::className(), ['id' => 'DistrictId']);
    }
}
