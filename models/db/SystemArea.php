<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_area".
 *
 * @property integer $id
 * @property string $Name
 * @property string $SystemKeyword
 * @property string $Description
 * @property integer $Published
 * @property integer $DisplayOrder
 * @property integer $Deleted
 *
 * @property SystemCountry[] $systemCountries
 */
class SystemArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Published', 'DisplayOrder', 'Deleted'], 'integer'],
            [['Name'], 'string', 'max' => 50],
            [['SystemKeyword'], 'string', 'max' => 150],
            [['Description'], 'string', 'max' => 500],
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
            'Description' => 'Description',
            'Published' => 'Published',
            'DisplayOrder' => 'Display Order',
            'Deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemCountries()
    {
        return $this->hasMany(SystemCountry::className(), ['SystemAreaId' => 'id']);
    }
}
