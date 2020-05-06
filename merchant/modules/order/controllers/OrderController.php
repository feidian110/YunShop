<?php


namespace addons\YunShop\merchant\modules\order\controllers;


use addons\YunShop\common\models\order\Order;
use addons\YunShop\merchant\controllers\BaseController;
use common\enums\StatusEnum;
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

    public function actionDelivery()
    {
        return $this->render( $this->action->id );
    }
}