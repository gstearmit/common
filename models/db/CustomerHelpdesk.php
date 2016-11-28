<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_helpdesk".
 *
 * @property integer $id
 * @property integer $customerId
 * @property string $customerEmail
 * @property string $customerPhone
 * @property string $content
 * @property string $createdTime
 * @property integer $orderItemId
 * @property integer $supportEmployeeId
 * @property string $supportTime
 * @property string $estimateReplyTime
 * @property string $supportChannel
 * @property string $status
 * @property integer $siteId
 * @property integer $typeId
 * @property integer $closedbyEmployeeId
 * @property string $closedTime
 * @property integer $storeId
 * @property integer $priority
 * @property string $requestTime
 * @property string $deadlineTime
 *
 * @property Customer $customer
 * @property OrganizationEmployee $supportEmployee
 * @property Site $site
 * @property OrderItem $orderItem
 * @property CustomerClaimType $type
 * @property OrganizationEmployee $closedbyEmployee
 * @property Store $store
 * @property CustomerHelpdeskConversation[] $customerHelpdeskConversations
 * @property CustomerHelpdeskFile[] $customerHelpdeskFiles
 */
class CustomerHelpdesk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_helpdesk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'orderItemId', 'supportEmployeeId', 'siteId', 'typeId', 'closedbyEmployeeId', 'storeId', 'priority'], 'integer'],
            [['createdTime', 'supportTime', 'estimateReplyTime', 'closedTime', 'requestTime', 'deadlineTime'], 'safe'],
            [['customerEmail', 'customerPhone', 'content', 'supportChannel', 'status'], 'string', 'max' => 255],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['supportEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['supportEmployeeId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['orderItemId'], 'exist', 'skipOnError' => true, 'targetClass' => OrderItem::className(), 'targetAttribute' => ['orderItemId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerClaimType::className(), 'targetAttribute' => ['typeId' => 'Id']],
            [['closedbyEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['closedbyEmployeeId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerId' => 'Customer ID',
            'customerEmail' => 'Customer Email',
            'customerPhone' => 'Customer Phone',
            'content' => 'Content',
            'createdTime' => 'Created Time',
            'orderItemId' => 'Order Item ID',
            'supportEmployeeId' => 'Support Employee ID',
            'supportTime' => 'Support Time',
            'estimateReplyTime' => 'Estimate Reply Time',
            'supportChannel' => 'Support Channel',
            'status' => 'Status',
            'siteId' => 'Site ID',
            'typeId' => 'Type ID',
            'closedbyEmployeeId' => 'Closedby Employee ID',
            'closedTime' => 'Closed Time',
            'storeId' => 'Store ID',
            'priority' => 'Priority',
            'requestTime' => 'Request Time',
            'deadlineTime' => 'Deadline Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'supportEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['id' => 'orderItemId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CustomerClaimType::className(), ['Id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClosedbyEmployee()
    {
        return $this->hasOne(OrganizationEmployee::className(), ['id' => 'closedbyEmployeeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'storeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdeskConversations()
    {
        return $this->hasMany(CustomerHelpdeskConversation::className(), ['helpdeskId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdeskFiles()
    {
        return $this->hasMany(CustomerHelpdeskFile::className(), ['helpdeskId' => 'id']);
    }
}
