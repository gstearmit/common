<?php
/**
 * Created by PhpStorm.
 * User: ducquan
 * Date: 28/8/2015
 * Time: 14:42 PM
 */

namespace common\models\output;

use yii\db\ActiveQuery;

class DataPage
{
    public $page = 1;
    public $pageSize = 20;
    public $pageCount = 0;
    public $dataCount = 0;
    public $data = [];
    public $other = [];

    public function setData(ActiveQuery $activeQuery)
    {
        $dataCount = clone $activeQuery;
        $dataCount->orderBy = null;
        $this->dataCount = $dataCount->count('0');
        $activeQuery->limit($this->pageSize);
        $activeQuery->offset($this->page * $this->pageSize - $this->pageSize);
        $this->pageCount = ceil($this->dataCount / $this->pageSize);
        $this->data = $activeQuery->all();
    }
}