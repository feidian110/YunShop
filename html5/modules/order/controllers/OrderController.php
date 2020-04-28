<?php


namespace addons\YunShop\html5\modules\order\controllers;


use addons\YunShop\html5\modules\shop\controllers\BaseController;

class OrderController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }

}