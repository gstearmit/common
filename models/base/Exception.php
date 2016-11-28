<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/11/16
 * Time: 12:01 PM
 */

namespace common\models\base;


class Exception extends \yii\base\Exception
{
    public $data = [], $success = false;

    public function __construct($success = false, $data = [], $message = '', $code = 500, \Exception $previous = null)
    {
        $this->data = $data;
        $this->success = $success;
        \Exception::__construct($message, $code, $previous);
    }

}