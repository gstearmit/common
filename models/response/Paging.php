<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/11/16
 * Time: 3:04 PM
 */

namespace common\models\response;


class Paging
{
    const MAX_PAGE_SIZE = 48;

    public $total = 0, $total_page = 0, $page_size = 48, $page = 1, $data = [];

    function valid()
    {
        $this->page = intval($this->page);
        $this->page_size = intval($this->page_size);

        if ($this->page < 1) {
            $this->page = 1;
        }

        if ($this->page_size < 1 || $this->page_size > static::MAX_PAGE_SIZE) {
            $this->page_size = static::MAX_PAGE_SIZE;
        }

    }

}