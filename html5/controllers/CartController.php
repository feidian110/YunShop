<?php

namespace addons\YunShop\html5\controllers;


use addons\TinyShop\common\enums\DecimalReservationEnum;
use addons\YunShop\common\models\CartItem;
use addons\YunStore\common\models\product\Product;
use common\helpers\ResultHelper;
use Yii;
class CartController extends BaseController
{

    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        return $this->render( $this->action->id );
    }

    public function actionCreate()
    {
        if( Yii::$app->request->isPost ){

            if( Yii::$app->user->isGuest ){
                return ResultHelper::json('402','还未登录，请登录后在操作！');
            }
            $product_id = (int)Yii::$app->request->post('id',0);
            $product = Product::findOne(['id'=>$product_id]);
            if( $product == null ){
                return ResultHelper::json('404','商品【'.(string)Yii::$app->request->post('name').'】已下架或已停售，请重新选择');
            }
            $model = CartItem::findOne(['product_id' => $product_id,'store_id'=>1,'member_id'=>Yii::$app->user->getId()]);
            if( $model == null ){
                $model = new CartItem();
                $model->product_id = $product_id;
                $model->product_name = $product['name'];
                $model->product_img = $product['picture'];
                $model->merchant_id = $product['merchant_id'];
                $model->store_id = $product['store_id'];
                $model->member_id = Yii::$app->user->getId();
            }

            $model->number = (int)Yii::$app->request->post('num');
            $model->price = $product['price'];

            if( !$model->save(0) ){
                return ResultHelper::json('402',$model->getErrors());
            }
            return ResultHelper::json('200','添加成功！',CartItem::findAll(['member_id'=>Yii::$app->user->getId(),'store_id'=>$product['store_id']]));
        }

    }

}