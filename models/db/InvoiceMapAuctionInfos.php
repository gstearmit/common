<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "invoice_map_auction_infos".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $auction_infos_id
 * @property integer $auction_transaction_id
 *
 * @property Invoice $invoice
 * @property AuctionInfos $auctionInfos
 * @property AuctionTransaction $auctionTransaction
 */
class InvoiceMapAuctionInfos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_map_auction_infos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'auction_infos_id', 'auction_transaction_id'], 'integer'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::className(), 'targetAttribute' => ['invoice_id' => 'id']],
            [['auction_infos_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuctionInfos::className(), 'targetAttribute' => ['auction_infos_id' => 'id']],
            [['auction_transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuctionTransaction::className(), 'targetAttribute' => ['auction_transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'auction_infos_id' => 'Auction Infos ID',
            'auction_transaction_id' => 'Auction Transaction ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionInfos()
    {
        return $this->hasOne(AuctionInfos::className(), ['id' => 'auction_infos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuctionTransaction()
    {
        return $this->hasOne(AuctionTransaction::className(), ['id' => 'auction_transaction_id']);
    }
}
