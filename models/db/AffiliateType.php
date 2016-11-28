<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "affiliate_type".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property integer $DisplayOrder
 *
 * @property Affiliate[] $affiliates
 */
class AffiliateType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'affiliate_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DisplayOrder'], 'integer'],
            [['Name', 'Description'], 'string', 'max' => 500],
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
            'Description' => 'Description',
            'DisplayOrder' => 'Display Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliates()
    {
        return $this->hasMany(Affiliate::className(), ['AffiliateTypeId' => 'id']);
    }
}
