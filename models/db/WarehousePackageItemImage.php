<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_item_image".
 *
 * @property integer $id
 * @property string $description
 * @property integer $warehouse_package_item_id
 * @property string $imgPath
 * @property string $uploadedTime
 * @property integer $TypeOfImage
 *
 * @property WarehousePackageItem $warehousePackageItem
 */
class WarehousePackageItemImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_item_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_package_item_id', 'TypeOfImage'], 'integer'],
            [['uploadedTime'], 'safe'],
            [['description', 'imgPath'], 'string', 'max' => 255],
            [['warehouse_package_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackageItem::className(), 'targetAttribute' => ['warehouse_package_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'warehouse_package_item_id' => 'Warehouse Package Item ID',
            'imgPath' => 'Img Path',
            'uploadedTime' => 'Uploaded Time',
            'TypeOfImage' => 'Type Of Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackageItem()
    {
        return $this->hasOne(WarehousePackageItem::className(), ['id' => 'warehouse_package_item_id']);
    }
}
