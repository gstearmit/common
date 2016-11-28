<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "auction_infos".
 *
 * @property integer $id
 * @property integer $itemId
 * @property string $itemName
 * @property integer $bidTime
 * @property string $itemUrl
 * @property integer $itemEndtime
 * @property string $itemImage
 * @property integer $userId
 * @property string $email
 * @property integer $outBidTime
 * @property string $deposit
 * @property string $bidPrice
 * @property string $bidUSPrice
 * @property integer $status
 * @property integer $outType
 * @property string $log
 * @property string $orderBinCode
 * @property integer $orderId
 * @property integer $supportStatus
 * @property string $supportInfo
 * @property integer $supportTime
 * @property integer $supportDoneTime
 * @property string $supportLog
 * @property string $supporterUsername
 * @property string $supporterInfo
 * @property integer $issueStatus
 * @property string $issueLog
 * @property integer $issueTime
 * @property string $issueInfo
 * @property integer $bidCount
 * @property string $itemPrice
 * @property string $bidTimeDate
 * @property string $endTimeDate
 * @property integer $depositStatus
 * @property string $depositAmount
 * @property string $depositPaidAmount
 * @property string $bidTokenAuction
 * @property integer $currencySystemId
 * @property string $currencyExchangeRate
 * @property integer $storeId
 * @property integer $siteId
 * @property integer $supporterId
 * @property integer $employeeId
 * @property string $employeeName
 * @property integer $isCheck
 *
 * @property Customer $user
 * @property Store $store
 * @property Site $site
 * @property OrganizationEmployee $employee
 * @property AuctionInfosNote[] $auctionInfosNotes
 * @property AuctionTransaction[] $auctionTransactions
 * @property InvoiceMapAuctionInfos[] $invoiceMapAuctionInfos
 */
class AuctionInfos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auction_infos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemId', 'itemName', 'bidTime', 'userId', 'email', 'deposit', 'bidPrice', 'status'], 'required'],
            [['itemId', 'bidTime', 'itemEndtime', 'userId', 'outBidTime', 'status', 'outType', 'orderId', 'supportStatus', 'supportTime', 'supportDoneTime', 'issueStatus', 'issueTime', 'bidCount', 'depositStatus', 'currencySystemId', 'storeId', 'siteId', 'supporterId', 'employeeId', 'isCheck'], 'integer'],
            [['deposit', 'bidPrice', 'bidUSPrice', 'itemPrice', 'depositAmount', 'depositPaidAmount', 'currencyExchangeRate'], 'number'],
            [['log', 'supportInfo', 'supportLog', 'supporterInfo', 'issueLog', 'issueInfo'], 'string'],
            [['bidTimeDate', 'endTimeDate'], 'safe'],
            [['itemName', 'itemUrl', 'email', 'bidTokenAuction', 'employeeName'], 'string', 'max' => 255],
            [['itemImage', 'supporterUsername'], 'string', 'max' => 250],
            [['orderBinCode'], 'string', 'max' => 15],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['userId' => 'id']],
            [['storeId'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['storeId' => 'id']],
            [['siteId'], 'exist', 'skipOnError' => true, 'targetClass' => Site::className(), 'targetAttribute' => ['siteId' => 'id']],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationEmployee::className(), 'targetAttribute' => ['employeeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'itemName' => 'Item Name',
            'bidTime' => 'Bid Time',
            'itemUrl' => 'Item Url',
            'itemEndtime' => 'Item Endtime',
            'itemImage' => 'Item Image',
            'userId' => 'User ID',
            'email' => 'Email',
            'outBidTime' => 'Out Bid Time',
            'deposit' => 'Deposit',
            'bidPrice' => 'Bid Price',
            'bidUSPrice' => 'Bid Usprice',
            'status' => 'Status',
            'outType' => 'Out Type',
            'log' => 'Log',
            'orderBinCode' => 'Order Bin Code',
            'orderId' => 'Order ID',
            'supportStatus' => 'Support Status',
            'supportInfo' => 'Support Info',
            'supportTime' => 'Support Time',
            'supportDoneTime' => 'Support Done Time',
            'supportLog' => 'Support Log',
            'supporterUsername' => 'Supporter Username',
            'supporterInfo' => 'Supporter Info',
            'issueStatus' => 'Issue Status',
            'issueLog' => 'Issue Log',
            'issueTime' => 'Issue Time',
            'issueInfo' => 'Issue Info',
            'bidCount' => 'Bid Count',
            'itemPrice' => 'Item Price',
            'bidTimeDate' => 'Bid Time Date',
            'endTimeDate' => 'End Time Date',
            'depositStatus' => 'Deposit Status',
            'depositAmount' => 'Deposit Amount',
            'depositPaidAmount' => 'Deposit Paid Amount',
            'bidTokenAuction' => 'Bid Token Auction',
            'currencySystemId' => 'Currency System ID',
            'currencyExchangeRate' => 'Currency Exchange Rate',
            'storeId' => 'Store ID',
            'siteId' => 'Site ID',
            'supporterId' => 'Supporter ID',
            'employeeId' => 'Employee ID',
            'employeeName' => 'Employee Name',
            'isCheck' => 'Is Check',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Customer::className(), ['id' => 'userId']);
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
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
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
    public function getAuctionInfosNotes()
    {
        return $this->hasMany(AuctionInfosNote::className(), ['auction_infos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionTransactions()
    {
        return $this->hasMany(AuctionTransaction::className(), ['AuctionInfoId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapAuctionInfos()
    {
        return $this->hasMany(InvoiceMapAuctionInfos::className(), ['auction_infos_id' => 'id']);
    }
}
