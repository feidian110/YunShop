<?php
namespace addons\YunShop\html5\modules\order\controllers;


use addons\YunShop\common\models\CartItem;
use addons\YunShop\common\models\order\Buyer;
use addons\YunShop\common\models\order\Order;
use addons\YunShop\html5\modules\shop\controllers\BaseController;
use addons\YunStore\common\models\product\Product;
use addons\YunStore\common\models\Store;
use common\enums\PayTypeEnum;
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
        if( Yii::$app->user->isGuest ){
            return $this->redirect( '/yun-user/public/login' );
        }
        if( Yii::$app->request->isPost ){
            $data = Yii::$app->request->post();

            $tran = Yii::$app->db->beginTransaction();
            try{
                $order = new Order();
                if( !$order -> create($data)){
                    throw  new \Exception();
                }
                $buyer =new Buyer();
                $buyer -> order_id = $order->id;
                $buyer -> merchant_id = $data['Order']['merchant_id'];
                $buyer -> store_id = $data['Order']['store_id'];
                $buyer -> buyer_id = Yii::$app->user->getId();
                $buyer -> buyer_username = Yii::$app->user->identity->username ?? "";
                $buyer -> buyer_ip = Yii::$app->request->userIP;
                if( !$buyer ->save() ){
                    throw  new \Exception();
                }

                foreach ( $data['OrderDetail'] as $product ){
                    $detail = new \addons\YunShop\common\models\order\Product();
                    $product['order_id'] = $order->id;
                    $product['merchant_id'] = $data['Order']['merchant_id'];
                    $product['store_id'] = $data['Order']['store_id'];
                    $product['buyer_id'] = Yii::$app->user->getId();
                    $product['product_money'] = $product['num'] * $product['price'];
                    $data['OrderDetail'] = $product;
                    if( !$detail->create($product) ){
                        throw  new \Exception();
                    }
                    CartItem::deleteAll(['product_id'=> $product['product_id'],'member_id' =>Yii::$app->user->getId() ]);
                }
                $tran->commit();
            }catch ( \Exception $e ){

                $tran->rollBack();
                throw $e;
            }
            if( $data['Order']['payment'] != PayTypeEnum::OFFLINE ){
                return $this->redirect( ['pay','order_id'=>$order->id] );
            }
            return $this->redirect( ['success','order_id'=>$order->id] );
        }
    }

    public function actionConfirm()
    {
        if( Yii::$app->request->isPost ){
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
            $model = new Order();

            $this->layout = 'main';
            return $this->render( $this->action->id,[
                'model' => $model,
                'store' =>$store,
                'detail' =>$detail,
            ] );
        }
    }

    public function actionDetail()
    {
        $order_id = (int)Yii::$app->request->get('order_id',0);
        $model = Order::findOne(['id'=>$order_id,'buyer_id'=>Yii::$app->user->getId()]);
        return $this->render( $this->action->id,[
            'model' =>$model
        ] );
    }

    public function actionPay()
    {

    }

    public function actionSuccess()
    {
        $order_id = (int)Yii::$app->request->get('order_id',0);
        $this->layout = 'main';
        return $this->render( $this->action->id,[
            'order_id' =>$order_id
        ] );
    }
}