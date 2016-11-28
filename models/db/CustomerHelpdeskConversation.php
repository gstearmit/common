<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_helpdesk_conversation".
 *
 * @property integer $id
 * @property integer $employeeId
 * @property string $createdTime
 * @property string $content
 * @property integer $helpdeskId
 *
 * @property OrganizationEmployee $employee
 * @property CustomerHelpdesk $helpdesk
 */
class CustomerHelpdeskConversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_helpdesk_conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employeeId', 'helpdeskId'], 'integer'],
            [['createdTime'], 'safe'],
            [['content'], 'string', 'max' => 255],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employeeId' => 'id']],
            [['helpdeskId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerHelpdesk::className(), 'targetAttribute' => ['helpdeskId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employeeId' => 'Employee ID',
            'createdTime' => 'Created Time',
            'content' => 'Content',
            'helpdeskId' => 'Helpdesk ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'employeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHelpdesk()
    {
        return $this->hasOne(CustomerHelpdesk::className(), ['id' => 'helpdeskId']);
    }
}
