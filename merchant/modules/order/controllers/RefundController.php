<?php


namespace addons\YunShop\merchant\modules\order\controllers;


use addons\YunShop\merchant\controllers\BaseController;

class RefundController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}