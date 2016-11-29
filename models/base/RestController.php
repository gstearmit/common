<?php
/**
 * Created by PhpStorm.
 * User: mrdoall
 * Date: 11/29/16
 * Time: 2:28 PM
 */

namespace common\models\base;

use common\models\enum\HttpStatusCode;
use common\models\response\Paging;
use common\models\response\Response;
use yii\rest\Controller;

abstract class RestController extends Controller implements RestControllerInterface
{
    protected $isPublic = false;

    protected $objectClass = null;

    public function beforeAction($action)
    {
        if (\Yii::$app->user->getIsGuest() && !$this->isPublic) {
            throw new Exception(false, null, 'Please login for access this resource', HttpStatusCode::HTTP_STATUS_UNAUTHORIZED);
        }
        return parent::beforeAction($action);
    }

    /**
     * Get đối tượng
     * @return Response
     */
    public function actionGet()
    {
        if ($this->objectClass != null) {
            $object = call_user_func([$this->objectClass, 'findOne'], \Yii::$app->request->get('id'));
            if (!empty($object)) {
                return new Response(true, $object, 'Get successfully', HttpStatusCode::HTTP_STATUS_OK);
            }
        }
        return new Response(false, null, 'Resource not found', HttpStatusCode::HTTP_STATUS_NO_CONTENT);
    }

    /**
     * Get List
     * @return Response
     */
    public function actionList()
    {
        $condition = \Yii::$app->request->get('condition', null);
        $object = call_user_func([$this->objectClass, 'find']);
        if (empty($condition)) {
            $object->where($condition);
        }
        $paging = new Paging();
        $paging->page = \Yii::$app->request->get('page', 1);
        $paging->page_size = \Yii::$app->request->get('size', 48);
        $paging->valid();
        $paging->total = $object->count('0');
        if ($paging->total == 0) {
            return new Response(true, $paging, 'Empty data', HttpStatusCode::HTTP_STATUS_NO_CONTENT);
        }
        $paging->total_page = ceil($paging->total / $paging->page_size);
        $offset = $paging->page_size * $paging->page - $paging->page_size;
        $paging->data = $object->offset($offset)->limit($paging->page_size)->all();

        return new Response(true, $paging, 'Get successfully', HttpStatusCode::HTTP_STATUS_OK);
    }

    /**
     * Xóa đối tượng
     * @return Response
     */
    function actionDelete()
    {
        if ($this->objectClass != null) {
            $object = call_user_func([$this->objectClass, 'findOne'], \Yii::$app->request->get('id'));
            if (!empty($object)) {
                try {
                    $object->delete();
                    return new Response(true, $object, 'Delete successfully', HttpStatusCode::HTTP_STATUS_OK);
                } catch (\Exception $ex) {
                    return new Response($ex->getMessage(), false, $object, HttpStatusCode::HTTP_STATUS_NOT_MODIFY);
                }
            }
        }
        return new Response(false, null, 'Resource not found', HttpStatusCode::HTTP_STATUS_NO_CONTENT);
    }

    /**
     * Update đối tượng cũ
     * @return Response
     */
    function actionPut()
    {
        if ($this->objectClass != null) {

            $newObject = call_user_func([$this->objectClass, 'findOne'], \Yii::$app->request->get('id'));
            if (empty($newObject)) {
                return new Response(false, null, 'Resource not found', HttpStatusCode::HTTP_STATUS_NO_CONTENT);
            }
            $newObject->isNewRecord = false;
            foreach (\Yii::$app->request->post() as $attr => $value) {
                if ($newObject->hasAttribute($attr)) {
                    $newObject->$attr = $value;
                }
            }
            if ($newObject->save()) {
                return new Response(true, $newObject, 'Save successfully', HttpStatusCode::HTTP_STATUS_OK);
            } else {
                return new Response(false, $newObject, $newObject->getFirstErrors(), HttpStatusCode::HTTP_STATUS_NOT_MODIFY);
            }
        }
    }

    /**
     * Tạo đối tượng mới
     * @return Response
     */
    function actionPost()
    {
        if ($this->objectClass != null) {
            $newObject = new $this->objectClass();
            $newObject->loadDefaultValues();
            $newObject->id = null;
            $newObject->isNewRecord = true;
            foreach (\Yii::$app->request->post() as $attr => $value) {
                if ($newObject->hasAttribute($attr)) {
                    $newObject->$attr = $value;
                }
            }
            if ($newObject->save()) {
                return new Response('Save successfully', true, $newObject, HttpStatusCode::HTTP_STATUS_OK);
            } else {
                return new Response(false, $newObject, $newObject->getFirstErrors(), HttpStatusCode::HTTP_STATUS_NOT_MODIFY);
            }
        }
    }
}