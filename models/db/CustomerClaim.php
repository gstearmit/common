<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "customer_claim".
 *
 * @property integer $id
 * @property integer $customerId
 * @property string $customerEmail
 * @property string $customerPhone
 * @property string $content
 * @property string $createdTime
 * @property string $orderBinCode
 * @property string $orderItemId
 * @property string $orderItemImage
 * @property string $orderItemTitle
 * @property integer $supportEmployeeId
 * @property string $supportTime
 * @property string $estimateReplyTime
 * @property string $supportChannel
 * @property integer $status
 * @property integer $siteId
 * @property integer $typeId
 * @property integer $closedbyEmployeeId
 * @property string $closedTime
 * @property integer $storeId
 * @property integer $priority
 * @property string $requestTime
 * @property string $deadlineTime
 * @property string $claimImage
 * @property integer $orderId
 *
 * @property Customer $customer
 * @property OrganizationEmployee $supportEmployee
 * @property Site $site
 * @property CustomerClaimType $type
 * @property OrganizationEmployee $closedbyEmployee
 * @property Store $store
 * @property Order $order
 * @property CustomerClaimConversation[] $customerClaimConversations
 * @property CustomerClaimFile[] $customerClaimFiles
 * @property OrderItemRefund[] $orderItemRefunds
 */
class CustomerClaim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_claim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerId', 'supportEmployeeId', 'status', 'siteId', 'typeId', 'closedbyEmployeeId', 'storeId', 'priority', 'orderId'], 'integer'],
            [['createdTime', 'supportTime', 'estimateReplyTime', 'closedTime', 'requestTime', 'deadlineTime'], 'safe'],
            [['customerEmail', 'customerPhone', 'content', 'orderItemTitle', 'supportChannel'], 'string', 'max' => 255],
            [['orderBinCode', 'orderItemId'], 'string', 'max' => 11],
            [['orderItemImage'], 'string', 'max' => 500],
            [['claimImage'], 'string', 'max' => 1000],
            [['customerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerId' => 'id']],
            [['supportEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['supportEmployeeId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerClaimType::className(), 'targetAttribute' => ['typeId' => 'Id']],
            [['closedbyEmployeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['closedbyEmployeeId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['orderId' => 'id']],
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
            'orderBinCode' => 'Order Bin Code',
            'orderItemId' => 'Order Item ID',
            'orderItemImage' => 'Order Item Image',
            'orderItemTitle' => 'Order Item Title',
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
            'claimImage' => 'Claim Image',
            'orderId' => 'Order ID',
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
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'orderId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaimConversations()
    {
        return $this->hasMany(CustomerClaimConversation::className(), ['claimId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaimFiles()
    {
        return $this->hasMany(CustomerClaimFile::className(), ['claimId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['ClaimId' => 'id']);
    }
}
