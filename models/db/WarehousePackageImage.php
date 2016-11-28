<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "warehouse_package_image".
 *
 * @property integer $id
 * @property string $description
 * @property integer $warehouse_package_id
 * @property string $imgPath
 * @property string $uploadedTime
 * @property integer $TypeOfImage
 *
 * @property WarehousePackage $warehousePackage
 */
class WarehousePackageImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'warehouse_package_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['warehouse_package_id', 'TypeOfImage'], 'integer'],
            [['uploadedTime'], 'safe'],
            [['description', 'imgPath'], 'string', 'max' => 255],
            [['warehouse_package_id'], 'exist', 'skipOnError' => true, 'targetClass' => WarehousePackage::className(), 'targetAttribute' => ['warehouse_package_id' => 'id']],
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
            'warehouse_package_id' => 'Warehouse Package ID',
            'imgPath' => 'Img Path',
            'uploadedTime' => 'Uploaded Time',
            'TypeOfImage' => 'Type Of Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWarehousePackage()
    {
        return $this->hasOne(WarehousePackage::className(), ['id' => 'warehouse_package_id']);
    }
}
