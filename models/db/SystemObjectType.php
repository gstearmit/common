<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "system_object_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $TableName
 *
 * @property DiscountObject[] $discountObjects
 */
class SystemObjectType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_object_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'string', 'max' => 50],
            [['TableName'], 'string', 'max' => 255],
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
            'TableName' => 'Table Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountObjects()
    {
        return $this->hasMany(DiscountObject::className(), ['ObjectTypeId' => 'id']);
    }
}
