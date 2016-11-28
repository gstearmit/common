<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "auction_transaction".
 *
 * @property integer $id
 * @property string $Note
 * @property integer $CustomerId
 * @property integer $ProductId
 * @property string $ProductOriginPrice
 * @property string $ProductAutionPrice
 * @property string $FreezeAmount
 * @property string $FreezeAmountFinishTime
 * @property string $FreezeAmountTime
 * @property string $OutbidAumount
 * @property integer $CannelBidAmount
 * @property string $TransactionCode
 * @property string $TransactionTime
 * @property integer $TracsactionType
 * @property string $OutbitPaid
 * @property integer $CannelPaid
 * @property string $RefundAmount
 * @property integer $AuctionInfoId
 *
 * @property Customer $customer
 * @property AuctionInfos $auctionInfo
 * @property InvoiceMapAuctionInfos[] $invoiceMapAuctionInfos
 */
class AuctionTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auction_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerId', 'ProductId', 'CannelBidAmount', 'TracsactionType', 'CannelPaid', 'AuctionInfoId'], 'integer'],
            [['ProductOriginPrice', 'ProductAutionPrice', 'FreezeAmount', 'OutbidAumount', 'OutbitPaid', 'RefundAmount'], 'number'],
            [['FreezeAmountFinishTime', 'FreezeAmountTime', 'TransactionTime'], 'safe'],
            [['Note'], 'string', 'max' => 500],
            [['TransactionCode'], 'string', 'max' => 255],
            [['CustomerId'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerId' => 'id']],
            [['AuctionInfoId'], 'exist', 'skipOnError' => true, 'targetClass' => AuctionInfos::className(), 'targetAttribute' => ['AuctionInfoId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Note' => 'Note',
            'CustomerId' => 'Customer ID',
            'ProductId' => 'Product ID',
            'ProductOriginPrice' => 'Product Origin Price',
            'ProductAutionPrice' => 'Product Aution Price',
            'FreezeAmount' => 'Freeze Amount',
            'FreezeAmountFinishTime' => 'Freeze Amount Finish Time',
            'FreezeAmountTime' => 'Freeze Amount Time',
            'OutbidAumount' => 'Outbid Aumount',
            'CannelBidAmount' => 'Cannel Bid Amount',
            'TransactionCode' => 'Transaction Code',
            'TransactionTime' => 'Transaction Time',
            'TracsactionType' => 'Tracsaction Type',
            'OutbitPaid' => 'Outbit Paid',
            'CannelPaid' => 'Cannel Paid',
            'RefundAmount' => 'Refund Amount',
            'AuctionInfoId' => 'Auction Info ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'CustomerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfo()
    {
        return $this->hasOne(AuctionInfos::className(), ['id' => 'AuctionInfoId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceMapAuctionInfos()
    {
        return $this->hasMany(InvoiceMapAuctionInfos::className(), ['auction_transaction_id' => 'id']);
    }
}
