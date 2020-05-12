<?php


namespace addons\YunShop\html5\modules\shop\controllers;


class ProductController extends BaseController
{
    public function actionIndex()
    {

    }

    public function actionView()
    {
        return $this->render( $this->action->id );
    }
}