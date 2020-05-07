<?php


namespace addons\YunShop\merchant\modules\order\controllers;


use addons\YunShop\common\models\order\Order;
use addons\YunShop\common\models\order\Product;
use addons\YunShop\merchant\controllers\BaseController;
use common\helpers\ExcelHelper;
use common\helpers\ResultHelper;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class DeliveryController extends BaseController
{

    use MerchantCurd;

    public $modelClass = Order::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => ['id', 'mobile'], // 模糊查询
            'defaultOrder' => [
                'shipping_status' => SORT_ASC,
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            //->andWhere(['>=', 'status', StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    public function actionBatch()
    {

    }

    public function actionProduct()
    {
        $post = Yii::$app->request->get('ids');
        $ids = explode(',',$post);
        $ids = array_unique($ids);
        $product = Product::find()->select('order_id,product_id,product_name,num')
            ->where(['or',['order_id'=>$ids]])
            ->asArray()->all();
        $header = $list = [];
        foreach ( $product as $item ){
            $a[$item['product_id']] = $item['product_name'];
        }
        foreach ( array_unique($a) as $k => $v ) {
            $header[0][0] = '订单ID';
            $header[0][1] = 'id';
            $header[1][0] = '自提点';
            $header[1][1] = 'pick_title';
            $header[2][0] = '提货人';
            $header[2][1] = 'pick_name';
            $header[3][0] = '提货人电话';
            $header[3][1] = 'pick_mobile';
            $header[$v][] = $v;
            $header[$v][] = $v;

            foreach ( $ids as $a =>$d ){
                $pp = Product::find()->where(['order_id'=>$d])->one();
                $list[$d]['id'] = $d;
                $list[$d]['pick_title'] = $pp['order']['pick']['title'];
                $list[$d]['pick_name'] = $pp['order']['pick_name'];
                $list[$d]['pick_mobile'] = $pp['order']['pick_mobile'];
                $list[$d][$v] =  Product::find()->where(['order_id'=>$d])->andWhere(['product_id'=>$k])->sum('num');
            }
        }
        //var_dump($header,$list);die;
        $title = '商品汇总_'.date('YmdHis');
        return ExcelHelper::exportData($list, $header, $title, 'xlsx');

    }

}