<?php
namespace addons\YunShop\html5\modules\shop\controllers;

use addons\YunShop\common\models\Shop;
use addons\YunStore\common\enums\AuditStateEnum;
use addons\YunStore\common\models\product\ProductCate;
use common\enums\WhetherEnum;
use common\helpers\ResultHelper;
use Yii;

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
        $cate = ProductCate::find()
            ->where( ['merchant_id'=>$model['merchant_id'],'store_id'=>$model['store_id']] )
            ->andWhere(['=','status',AuditStateEnum::ENABLED])
            ->all();
        return $this->render( $this->action->id,[
            'model' =>$model,
            'cate' => $cate
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