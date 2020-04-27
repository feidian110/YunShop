<?php


namespace addons\YunShop\merchant\modules\shop\controllers;


use addons\YunShop\common\models\Shop;
use addons\YunShop\merchant\controllers\BaseController;
use addons\YunStore\common\models\Store;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class ShopController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Shop::class;

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
            ->andWhere(['>=', 'status', StatusEnum::DISABLED])
            ->andFilterWhere(['merchant_id' => $this->getMerchantId()]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        if( Yii::$app->request->isPost ){
            $post = Yii::$app->request->post();
            // ajax 校验
            $this->activeFormValidate($model);

            if( $model->load($post) && $model->save() ){
                return $this->message($model->isNewRecord ? "快店创建成功！" : "快店信息修改成功！", $this->redirect(['index']), 'success');
            }
            return $this->message($this->getError($model), $this->redirect(['index']), 'error');
        }
        return $this->render( $this->action->id,[
            'model' => $model,
            'store' =>Yii::$app->yunStoreService->store->getDropDown(),
        ] );
    }


}