<?php
namespace addons\YunShop\html5\modules\order\controllers;


use addons\YunShop\html5\modules\shop\controllers\BaseController;
use Yii;

class OrderController extends BaseController
{

    public function actionIndex()
    {
        if( Yii::$app->user->isGuest ){
            return $this->redirect( ['/yun-user/public/login'] );
        }
        return $this->render( $this->action->id );
    }

    public function actionConfirm()
    {
        return $this->render( $this->action->id );
    }

    public function actionDetail()
    {

    }
}