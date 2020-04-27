<?php
use common\enums\WhetherEnum;
use yii\widgets\ActiveForm;
use common\helpers\Url;
use common\enums\StatusEnum;

$form = ActiveForm::begin([
    'options' => [ 'class'=>'form-horizontal' ],
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(['ajax-edit', 'id' => $model['id']]),
    'fieldConfig' => [
        'labelOptions' => [ 'class' => 'col-sm-3 text-right' ]  ,
        'template' => "{label}<div class='col-sm-8'>{input}\n{hint}\n{error}</div>",
    ],
]);

?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
        <h4 class="modal-title">基本信息</h4>
    </div>
    <div class="modal-body">
        <?= $form->field($model, 'store_id')->dropDownList($store);?>
        <?= $form->field($model, 'pid')->dropDownList($dropDown); ?>
        <?= $form->field($model, 'title')->textInput(); ?>
        <?= $form->field($model, 'is_sub_cate')->radioList(WhetherEnum::getMap())->hint('如果麻辣烫、奶茶、火锅等存在配菜、配料的情况，请您选中该分类为“附属菜品分类”。选中后，在附属菜品分类里创建的菜品，不会在用户端的餐厅菜品列表中显示');?>
        <?= $form->field($model, 'product_discount')->input('number',['value'=>$model->isNewRecord ? 0 : $model->product_discount])->hint('0~10之间的数字，支持一位小数！8代表8折，8.5代表85折，0与10代表无折扣');?>
        <?= $form->field($model, 'week_display')->checkboxList(\addons\YunStore\common\enums\WeekEnum::getMap())->hint('全不选择与全选均代表用户前台一周都显示该商品信息');?>
        <?= $form->field($model, 'sort')->textInput(); ?>
        <?= $form->field($model, 'status')->radioList(StatusEnum::getMap()); ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
        <button class="btn btn-primary" type="submit">保存</button>
    </div>
<?php ActiveForm::end(); ?>