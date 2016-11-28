<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_employee".
 *
 * @property integer $id
 * @property string $FullName
 * @property string $Gender
 * @property string $BirthDate
 * @property string $Postion
 * @property string $EmailContact
 * @property string $Phone
 * @property string $Mobile
 * @property integer $DayBirth
 * @property integer $MonthBirth
 * @property integer $YearBirth
 * @property integer $IsActive
 * @property integer $DepartmentId
 * @property string $Note
 * @property integer $userId
 * @property integer $target
 * @property integer $type
 *
 * @property Affiliate[] $affiliates
 * @property AuctionInfos[] $auctionInfos
 * @property AuctionInfosNote[] $auctionInfosNotes
 * @property BannerLog[] $bannerLogs
 * @property CallLog[] $callLogs
 * @property Campaign[] $campaigns
 * @property Customer[] $customers
 * @property CustomerCall[] $customerCalls
 * @property CustomerCall[] $customerCalls0
 * @property CustomerClaim[] $customerClaims
 * @property CustomerClaim[] $customerClaims0
 * @property CustomerClaimConversation[] $customerClaimConversations
 * @property CustomerEmail[] $customerEmails
 * @property CustomerGift[] $customerGifts
 * @property CustomerHelpdesk[] $customerHelpdesks
 * @property CustomerHelpdesk[] $customerHelpdesks0
 * @property CustomerHelpdeskConversation[] $customerHelpdeskConversations
 * @property EmailTemplate[] $emailTemplates
 * @property Invoice[] $invoices
 * @property MembershipFeeRequestPayment[] $membershipFeeRequestPayments
 * @property Order[] $orders
 * @property Order[] $orders0
 * @property Order[] $orders1
 * @property OrderAdditionFee[] $orderAdditionFees
 * @property OrderAdditionFee[] $orderAdditionFees0
 * @property OrderAdditionFeeRequestPayment[] $orderAdditionFeeRequestPayments
 * @property OrderItem[] $orderItems
 * @property OrderItemFeeService[] $orderItemFeeServices
 * @property OrderItemRefund[] $orderItemRefunds
 * @property OrderItemRefund[] $orderItemRefunds0
 * @property OrderItemRefund[] $orderItemRefunds1
 * @property OrderItemRefund[] $orderItemRefunds2
 * @property OrderNote[] $orderNotes
 * @property OrderRefundRequestPayment[] $orderRefundRequestPayments
 * @property OrderService[] $orderServices
 * @property OrderSupportLog[] $orderSupportLogs
 * @property OrganizationDepartment $department
 * @property User $user
 * @property OrganizationEmployeeType[] $organizationEmployeeTypes
 * @property PosOrderRequest[] $posOrderRequests
 * @property PosSetting[] $posSettings
 * @property PurchaseOrder[] $purchaseOrders
 * @property PurchaseOrderItemRefund[] $purchaseOrderItemRefunds
 * @property PurchaseOrderNote[] $purchaseOrderNotes
 * @property RequestPackages[] $requestPackages
 * @property RequestPackages[] $requestPackages0
 * @property RequestPackagesItems[] $requestPackagesItems
 * @property RequestShipment[] $requestShipments
 * @property RequestShipmentService[] $requestShipmentServices
 * @property SaleCommissionSetting[] $saleCommissionSettings
 * @property SaleCommissionSettingDetail[] $saleCommissionSettingDetails
 * @property SaleCommissionSummary[] $saleCommissionSummaries
 * @property SaleTeam[] $saleTeams
 * @property SaleTeamMembers[] $saleTeamMembers
 * @property SeoLanding[] $seoLandings
 * @property Shipment[] $shipments
 * @property ShipmentBulk[] $shipmentBulks
 * @property ShipmentBulk[] $shipmentBulks0
 * @property ShipmentBulkCustom[] $shipmentBulkCustoms
 * @property ShipmentBulkCustomGate[] $shipmentBulkCustomGates
 * @property ShipmentBulkNote[] $shipmentBulkNotes
 * @property ShipmentLog[] $shipmentLogs
 * @property ShippingPackageLocalList[] $shippingPackageLocalLists
 * @property SystemAccount[] $systemAccounts
 * @property SystemAccountTransaction[] $systemAccountTransactions
 * @property SystemAccountTransactionVoucher[] $systemAccountTransactionVouchers
 * @property SystemAccountTransactionVoucher[] $systemAccountTransactionVouchers0
 * @property Transaction[] $transactions
 * @property Transaction[] $transactions0
 * @property TransactionAccount[] $transactionAccounts
 * @property TransactionAccountSystem[] $transactionAccountSystems
 * @property TransactionExternalVoucher[] $transactionExternalVouchers
 * @property TransactionExternalVoucher[] $transactionExternalVouchers0
 * @property TransactionNote[] $transactionNotes
 * @property TransactionQueue[] $transactionQueues
 * @property TransactionQueue[] $transactionQueues0
 * @property TransactionQueueProcessedList[] $transactionQueueProcessedLists
 * @property TransactionQueueProcessedList[] $transactionQueueProcessedLists0
 * @property TransactionQueueProcessedListAudit[] $transactionQueueProcessedListAudits
 * @property TransactionRequest[] $transactionRequests
 * @property TransactionRequest[] $transactionRequests0
 * @property TransactionVoucher[] $transactionVouchers
 * @property TransactionVoucher[] $transactionVouchers0
 * @property WarehousePackage[] $warehousePackages
 * @property WarehousePackage[] $warehousePackages0
 * @property WarehousePackageItemLog[] $warehousePackageItemLogs
 * @property WarehousePackageLog[] $warehousePackageLogs
 * @property WarehousePackageReturn[] $warehousePackageReturns
 * @property WarehousePackageService[] $warehousePackageServices
 */
class OrganizationEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BirthDate'], 'safe'],
            [['DayBirth', 'MonthBirth', 'YearBirth', 'IsActive', 'DepartmentId', 'userId', 'target', 'type'], 'integer'],
            [['DepartmentId'], 'required'],
            [['FullName', 'Gender', 'Postion', 'EmailContact', 'Phone', 'Mobile'], 'string', 'max' => 50],
            [['Note'], 'string', 'max' => 400],
            [['DepartmentId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationDepartment::className(), 'targetAttribute' => ['DepartmentId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FullName' => 'Full Name',
            'Gender' => 'Gender',
            'BirthDate' => 'Birth Date',
            'Postion' => 'Postion',
            'EmailContact' => 'Email Contact',
            'Phone' => 'Phone',
            'Mobile' => 'Mobile',
            'DayBirth' => 'Day Birth',
            'MonthBirth' => 'Month Birth',
            'YearBirth' => 'Year Birth',
            'IsActive' => 'Is Active',
            'DepartmentId' => 'Department ID',
            'Note' => 'Note',
            'userId' => 'User ID',
            'target' => 'Target',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAffiliates()
    {
        return $this->hasMany(Affiliate::className(), ['EmployeeInChargeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasMany(AuctionInfos::className(), ['employeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfosNotes()
    {
        return $this->hasMany(AuctionInfosNote::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerLogs()
    {
        return $this->hasMany(BannerLog::className(), ['UserId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCallLogs()
    {
        return $this->hasMany(CallLog::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaigns()
    {
        return $this->hasMany(Campaign::className(), ['CreatedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['ManageEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCalls()
    {
        return $this->hasMany(CustomerCall::className(), ['RecievedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerCalls0()
    {
        return $this->hasMany(CustomerCall::className(), ['EmployeeInChargeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims()
    {
        return $this->hasMany(CustomerClaim::className(), ['supportEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaims0()
    {
        return $this->hasMany(CustomerClaim::className(), ['closedbyEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerClaimConversations()
    {
        return $this->hasMany(CustomerClaimConversation::className(), ['organizationEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerEmails()
    {
        return $this->hasMany(CustomerEmail::className(), ['SendByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerGifts()
    {
        return $this->hasMany(CustomerGift::className(), ['SentByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['supportEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdesks0()
    {
        return $this->hasMany(CustomerHelpdesk::className(), ['closedbyEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerHelpdeskConversations()
    {
        return $this->hasMany(CustomerHelpdeskConversation::className(), ['employeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailTemplates()
    {
        return $this->hasMany(EmailTemplate::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoices()
    {
        return $this->hasMany(Invoice::className(), ['ManageEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipFeeRequestPayments()
    {
        return $this->hasMany(MembershipFeeRequestPayment::className(), ['ProcesssedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['ManageApprovedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Order::className(), ['PurchaseEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders1()
    {
        return $this->hasMany(Order::className(), ['LastUpdateByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFees0()
    {
        return $this->hasMany(OrderAdditionFee::className(), ['ApprovedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderAdditionFeeRequestPayments()
    {
        return $this->hasMany(OrderAdditionFeeRequestPayment::className(), ['ProcesssedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['Quotation_Supporter' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemFeeServices()
    {
        return $this->hasMany(OrderItemFeeService::className(), ['approvedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds()
    {
        return $this->hasMany(OrderItemRefund::className(), ['ProcessedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds0()
    {
        return $this->hasMany(OrderItemRefund::className(), ['ApprovedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds1()
    {
        return $this->hasMany(OrderItemRefund::className(), ['RefundedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItemRefunds2()
    {
        return $this->hasMany(OrderItemRefund::className(), ['preApproveEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderNotes()
    {
        return $this->hasMany(OrderNote::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderRefundRequestPayments()
    {
        return $this->hasMany(OrderRefundRequestPayment::className(), ['ProcesssedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['ProcesssedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderSupportLogs()
    {
        return $this->hasMany(OrderSupportLog::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(OrganizationDepartment::className(), ['id' => 'DepartmentId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationEmployeeTypes()
    {
        return $this->hasMany(OrganizationEmployeeType::className(), ['employeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosOrderRequests()
    {
        return $this->hasMany(PosOrderRequest::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosSettings()
    {
        return $this->hasMany(PosSetting::className(), ['InChargeEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['BuyerEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderItemRefunds()
    {
        return $this->hasMany(PurchaseOrderItemRefund::className(), ['ProcessedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderNotes()
    {
        return $this->hasMany(PurchaseOrderNote::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages()
    {
        return $this->hasMany(RequestPackages::className(), ['manage_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackages0()
    {
        return $this->hasMany(RequestPackages::className(), ['process_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestPackagesItems()
    {
        return $this->hasMany(RequestPackagesItems::className(), ['process_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipments()
    {
        return $this->hasMany(RequestShipment::className(), ['ProcesssedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestShipmentServices()
    {
        return $this->hasMany(RequestShipmentService::className(), ['ApprovedEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettings()
    {
        return $this->hasMany(SaleCommissionSetting::className(), ['CreatedById' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSettingDetails()
    {
        return $this->hasMany(SaleCommissionSettingDetail::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleCommissionSummaries()
    {
        return $this->hasMany(SaleCommissionSummary::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeams()
    {
        return $this->hasMany(SaleTeam::className(), ['TeamLeaderId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTeamMembers()
    {
        return $this->hasMany(SaleTeamMembers::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeoLandings()
    {
        return $this->hasMany(SeoLanding::className(), ['employee_Id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipments()
    {
        return $this->hasMany(Shipment::className(), ['employeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks()
    {
        return $this->hasMany(ShipmentBulk::className(), ['createByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulks0()
    {
        return $this->hasMany(ShipmentBulk::className(), ['ManageEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustoms()
    {
        return $this->hasMany(ShipmentBulkCustom::className(), ['customEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkCustomGates()
    {
        return $this->hasMany(ShipmentBulkCustomGate::className(), ['ProcessedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentBulkNotes()
    {
        return $this->hasMany(ShipmentBulkNote::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShipmentLogs()
    {
        return $this->hasMany(ShipmentLog::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShippingPackageLocalLists()
    {
        return $this->hasMany(ShippingPackageLocalList::className(), ['CreatedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccounts()
    {
        return $this->hasMany(SystemAccount::className(), ['CheckedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactions()
    {
        return $this->hasMany(SystemAccountTransaction::className(), ['CheckByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVouchers()
    {
        return $this->hasMany(SystemAccountTransactionVoucher::className(), ['OperationByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAccountTransactionVouchers0()
    {
        return $this->hasMany(SystemAccountTransactionVoucher::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['CheckByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions0()
    {
        return $this->hasMany(Transaction::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccounts()
    {
        return $this->hasMany(TransactionAccount::className(), ['CheckedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionAccountSystems()
    {
        return $this->hasMany(TransactionAccountSystem::className(), ['LastModifyEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternalVouchers()
    {
        return $this->hasMany(TransactionExternalVoucher::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionExternalVouchers0()
    {
        return $this->hasMany(TransactionExternalVoucher::className(), ['OperationByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionNotes()
    {
        return $this->hasMany(TransactionNote::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues()
    {
        return $this->hasMany(TransactionQueue::className(), ['CheckByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueues0()
    {
        return $this->hasMany(TransactionQueue::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedLists()
    {
        return $this->hasMany(TransactionQueueProcessedList::className(), ['CreatedByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedLists0()
    {
        return $this->hasMany(TransactionQueueProcessedList::className(), ['ProcessByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionQueueProcessedListAudits()
    {
        return $this->hasMany(TransactionQueueProcessedListAudit::className(), ['UploadByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests()
    {
        return $this->hasMany(TransactionRequest::className(), ['CheckByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionRequests0()
    {
        return $this->hasMany(TransactionRequest::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionVouchers()
    {
        return $this->hasMany(TransactionVoucher::className(), ['OperationByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionVouchers0()
    {
        return $this->hasMany(TransactionVoucher::className(), ['ApproveByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages()
    {
        return $this->hasMany(WarehousePackage::className(), ['ManageEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackages0()
    {
        return $this->hasMany(WarehousePackage::className(), ['employeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItemLogs()
    {
        return $this->hasMany(WarehousePackageItemLog::className(), ['EmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageLogs()
    {
        return $this->hasMany(WarehousePackageLog::className(), ['NotedEmployeedId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageReturns()
    {
        return $this->hasMany(WarehousePackageReturn::className(), ['ReturnByEmployeeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageServices()
    {
        return $this->hasMany(WarehousePackageService::className(), ['ProcesssedByEmployeeId' => 'id']);
    }
}
