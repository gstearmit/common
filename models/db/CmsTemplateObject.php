<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "cms_template_object".
 *
 * @property integer $id
 * @property integer $templateId
 * @property integer $objectId
 *
 * @property CmsTemplate $template
 * @property CmsObject $object
 */
class CmsTemplateObject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_template_object';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['templateId', 'objectId'], 'integer'],
            [['templateId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsTemplate::className(), 'targetAttribute' => ['templateId' => 'id']],
            [['objectId'], 'exist', 'skipOnError' => true, 'targetClass' => CmsObject::className(), 'targetAttribute' => ['objectId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'templateId' => 'Template ID',
            'objectId' => 'Object ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(CmsTemplate::className(), ['id' => 'templateId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CmsObject::className(), ['id' => 'objectId']);
    }
}
