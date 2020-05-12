<?php
namespace addons\YunShop\merchant\modules\product\controllers;

use addons\YunShop\merchant\controllers\BaseController;
use addons\YunStore\common\models\product\ProductCate;
use common\traits\MerchantCurd;
use Yii;
use yii\data\ActiveDataProvider;

class CategoryController extends BaseController
{
    use MerchantCurd;

    public $modelClass =ProductCate::class;

    public function actionIndex()
    {

        $query = ProductCate::find()
            ->orderBy('sort asc, created_at asc')
            ->andWhere(['merchant_id' => $this->getMerchantId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAjaxEdit()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $model = $this->findModel($id);
        $model->pid = $request->get('pid', null) ?? $model->pid; // 父id
        if( Yii::$app->request->isPost ){
            $this->activeFormValidate($model);
            $data = Yii::$app->request->post();
            $model->week_display = $data['ProductCate']['week_display'] ? implode(',',$data['ProductCate']['week_display']) : "";
            if ($model->load($data)) {
                return $model->save()
                    ? $this->redirect(['index'])
                    : $this->message($this->getError($model), $this->redirect(['index']), 'error');
            }
        }

        return $this->renderAjax($this->action->id, [
            'model' => $model,
            'store' => Yii::$app->yunStoreService->store->getDropDown(),
            'dropDown' => Yii::$app->yunStoreService->productCate->getDropDownForEdit($id),
        ]);
    }
}