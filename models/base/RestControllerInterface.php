<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/11/16
 * Time: 2:31 PM
 */

namespace common\models\base;


interface RestControllerInterface
{
    function actionList();

    function actionGet();

    function actionDelete();

    function actionPut();

    function actionPost();

}