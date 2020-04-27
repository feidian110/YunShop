<?php


namespace addons\YunShop\merchant\controllers;


class MainController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}