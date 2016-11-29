<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/29/16
 * Time: 4:36 PM
 */

namespace common\models\enum;


class HttpStatusCode
{
    const HTTP_STATUS_OK = 200;
    const HTTP_STATUS_NO_CONTENT = 204;
    const HTTP_STATUS_NOT_MODIFY = 304;
    const HTTP_STATUS_UNAUTHORIZED = 401;
}