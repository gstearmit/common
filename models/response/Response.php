<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/11/16
 * Time: 11:56 AM
 */

namespace common\models\response;


class Response
{
    public $status = 200, $success = false, $messages = [], $data = [];

    public function __construct($success = false, $data = null, $messages = '', $status = 200)
    {
        if (!is_array($messages)) {
            $messages = [$messages];
        }
        if ($status == 0) {
            $status = 404;
        }
        if ($success == null) {
            $success = false;
        }
        $this->messages = $messages;
        $this->success = $success;
        $this->status = $status;
        $this->data = $data;
    }

}