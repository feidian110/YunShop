<?php
namespace addons\YunShop\merchant\modules\product\controllers;

use addons\YunShop\merchant\controllers\BaseController;
use addons\YunStore\common\models\product\Spec;
use common\enums\StatusEnum;
use common\models\base\SearchModel;
use common\traits\MerchantCurd;
use Yii;

class SpecController extends BaseController
{
    use MerchantCurd;

    public $modelClass = Spec::class;

    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => Spec::class,
            'scenario' => 'default',
            'partialMatchAttributes' => ['title'], // 模糊查询
            'defaultOrder' => [
                'sort' => SORT_ASC,
                'id' => SORT_DESC,
            ],
            'pageSize' => $this->pageSize,
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        $dataProvider->query
            ->andWhere(['status' => StatusEnum::ENABLED])
            ->andWhere(['merchant_id' => $this->getMerchantId()])
            ->with(['value']);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'showTypeExplain' => Spec::$showTypeExplain,
        ]);
    }

    public function actionEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id', null);
        $model = $this->findModel($id);
        if ($model->load($request->post()) && $model->save()) {
            return $this->referrer();
        }

        return $this->render($this->action->id, [
            'model' => $model,
            'showTypeExplain' => Spec::$showTypeExplain,
        ]);
    }
}