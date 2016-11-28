<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_helpdesk_type".
 *
 * @property integer $Id
 * @property string $Name
 * @property string $Description
 */
class CustomerHelpdeskType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_helpdesk_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Name',
            'Description' => 'Description',
        ];
    }
}
