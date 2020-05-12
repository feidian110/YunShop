<?php
namespace addons\YunShop\html5\modules\shop\controllers;

use addons\YunShop\common\models\CartItem;
use addons\YunShop\common\models\Shop;
use addons\YunStore\common\enums\AuditStateEnum;
use addons\YunStore\common\models\product\ProductCate;
use common\enums\StatusEnum;
use common\enums\WhetherEnum;
use common\helpers\ResultHelper;
use Yii;
use yii\db\Expression;

class ShopController extends BaseController
{


    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }

    public function actionDetail()
    {
        $id = Yii::$app->request->get('store_id');
        $model = $this->findModel($id);
        $open_time_one = strtotime($model['store']['hours']['open_time_one']);
        $close_time_one = strtotime($model['store']['hours']['close_time_one']);
        $open_time_two = strtotime($model['store']['hours']['open_time_two']);
        $close_time_two = strtotime($model['store']['hours']['close_time_two']);
        $open_time_three = strtotime($model['store']['hours']['open_time_three']);
        $close_time_three = strtotime($model['store']['hours']['close_time_three']);
        $now_time = time();
        $time=date("w",$now_time);
        $where = new Expression("FIND_IN_SET(:field, week_display)",[":field"=>$time]);
        $cate = ProductCate::find()
            ->where( ['merchant_id'=>$model['merchant_id'],'store_id'=>$model['store_id']] )
            ->andWhere($where)
            ->andWhere(['=','status',AuditStateEnum::ENABLED])
            ->all();


        $product = CartItem::findAll(['store_id'=>$id,'member_id'=>Yii::$app->user->getId(),'status'=>StatusEnum::ENABLED]);
        if( $open_time_one = $close_time_one == strtotime("00:00:00") ){

            return $this->render( $this->action->id,[
                'model' =>$model,
                'cate' => $cate,
                'store_id' =>$id,
                'product' => $product
            ] );
        }
        if( ($open_time_one < $now_time && $now_time < $close_time_one) || ($open_time_two < $now_time && $now_time < $close_time_two) || ($open_time_three < $now_time && $now_time < $close_time_three) ){
            return $this->render( $this->action->id,[
                'model' =>$model,
                'cate' => $cate,
                'store_id' =>$id,
                'product' => $product
            ] );
        }


        return $this->render( 'tips',[
            'type' => 'close',
            'store_id' => $id,
            'message' => '本店已打烊，休息中...！'
        ] );


    }


    protected function findModel($id)
    {
        $model = Shop::find()
            ->where( ['store_id' =>$id] )
            ->andWhere( ['>=','status', AuditStateEnum::DISABLED] )->one();
        if( $model == null ){
            $message['type'] = 'error';
            $message['data'] =  '门店不存在！';

        }

        return $model;
    }

}