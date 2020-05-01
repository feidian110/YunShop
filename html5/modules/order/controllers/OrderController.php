<?php
namespace addons\YunShop\html5\modules\order\controllers;


use addons\YunShop\common\models\order\Order;
use addons\YunShop\html5\modules\shop\controllers\BaseController;
use addons\YunStore\common\models\product\Product;
use addons\YunStore\common\models\Store;
use Yii;

class OrderController extends BaseController
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        if( Yii::$app->user->isGuest ){
            return $this->redirect( ['/yun-user/public/login'] );
        }
        return $this->render( $this->action->id );
    }

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $store = Store::findOne(['id'=>$post['store_id']]);
        $detail = [];
        foreach ( $post['OrderDetail'] as $item ){
            $product = Product::findOne( ['id'=>$item['id']] );
            $detail[$item['id']]['product_id'] = $item['id'];
            $detail[$item['id']]['product_name'] = $product['name'];
            $detail[$item['id']]['price'] = $item['price'];
            $detail[$item['id']]['number'] = $item['num'];
            $detail[$item['id']]['product_img'] = $product['picture'];
            $detail[$item['id']]['merchant_id'] = $product['merchant_id'];
            $detail[$item['id']]['store_id'] = $post['store_id'];
        }
        $order = new Order();
        var_dump($store['pick']['title'],$detail);die;
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