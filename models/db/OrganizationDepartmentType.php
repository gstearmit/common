<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "organization_department_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $alias
 *
 * @property OrganizationEmployeeType[] $organizationEmployeeTypes
 */
class OrganizationDepartmentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_department_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 255],
            [['alias'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationEmployeeTypes()
    {
        return $this->hasMany(OrganizationEmployeeType::className(), ['departmentTypeId' => 'id']);
    }
}
