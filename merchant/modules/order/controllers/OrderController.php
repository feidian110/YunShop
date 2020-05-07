<?php


namespace addons\YunShop\merchant\modules\order\controllers;


use addons\YunShop\common\models\order\Order;
use addons\YunShop\merchant\controllers\BaseController;
use common\enums\StatusEnum;
use common\helpers\ExcelHelper;
use common\helpers\ResultHelper;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class OrderController extends BaseController
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

    public function actionEdit()
    {
        return $this->render( $this->action->id );
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        return $this->render( $this->action->id,[
            'model' =>$model
        ] );
    }

    public function actionExport()
    {

        $post = Yii::$app->request->get('ids');

        $ids = explode(',',$post);
        $ids = array_unique($ids);
        $order = Order::find()
            ->select('id,order_sn,buyer_id,pick_id,pick_name,pick_mobile,message,created_at')
            ->where(['or',['id'=>$ids]])->with('profile')->with('pick')->with('buyer')
            ->asArray()->all();
        $list = [];
        foreach ( $order as $item ){
            $product = [];
            foreach ( $item['profile'] as $_item ){
                $product[] = $_item['product_name'] .'*'.$_item['num'];
            }
            $list[$item['id']]['sn'] = $item['order_sn'];
            $list[$item['id']]['pick_title'] = $item['pick']['title'];
            $list[$item['id']]['username'] = $item['buyer']['username'];
            $list[$item['id']]['pick_name'] = $item['pick_name'];
            $list[$item['id']]['pick_mobile'] = $item['pick_mobile'];
            $list[$item['id']]['product'] =implode(',',$product);
            $list[$item['id']]['message'] = $item['message'];
            $list[$item['id']]['created_at'] = date('Y-m-d H:i:s',$item['created_at']);
            $list[$item['id']]['remark'] = "";
        }
        // [名称, 字段名, 类型, 类型规则]
        $header = [
            ['订单编号', 'sn', 'text'],
            ['自提点', 'pick_title'], // 规则不填默认text
            ['会员名', 'username'],
            ['提货人', 'pick_name'],
            ['提货人联系方式', 'pick_mobile'],
            ['商品信息', 'product'],
            ['买家留言','message'],
            ['下单时间','created_at'],
            ['备注','remark']
        ];
        var_dump($header,$list);die;
        $title = '订单明细_'.date('YmdHis');
        return ResultHelper::json(200,'成功！',ExcelHelper::exportData($list, $header, $title, 'xlsx'));
    }

    public function actionDelivery()
    {
        return $this->render( $this->action->id );
    }
}