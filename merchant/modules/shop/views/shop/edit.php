<?php

use addons\YunStore\common\enums\ShippingTypeEnum;
use addons\YunStore\common\enums\StateEnum;
use common\enums\WhetherEnum;
use yii\widgets\ActiveForm;

$this->title = $model->isNewRecord ? "添加门店" : "编辑门店";
$this->params['breadcrumbs'][] = ['label' => '商户管理'];
$this->params['breadcrumbs'][] = ['label' => '门店管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-horizontal'],
            'fieldConfig' => [
                'labelOptions' => ['class'=>'col-sm-1 control-label text-right'],
                'template' => "{label}<div class='col-sm-5'>{input}{hint}{error}</div>",
            ],
        ]); ?>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">基本设置</a></li>
                <li><a href="#tab_2" data-toggle="tab">选择分类</a></li>
                <li><a href="#tab_3" data-toggle="tab">配送方式</a></li>
                <li><a href="#tab_4" data-toggle="tab">线下零售</a></li>
                <li><a href="#tab_5" data-toggle="tab">秤码对接配置</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <?= $form->field($model,'store_id')->dropDownList($store)->hint('一个门店只允许开启一个快店，开启后不允许更换删除，请慎重选择');?>
                    <?= $form->field($model, 'open_pick')->radioList(StateEnum::getMap());?>
                    <?= $form->field($model, 'notice')->textarea() ?>
                    <?= $form->field($model, 'emergency_shutdown')->dropDownList(WhetherEnum::getMap())->hint('注：状态是“关闭”时店铺是正常状态，“开启”是店铺已关闭。【紧急关店用于临时有事需要暂停营业的情况下，开启后，用户前台不可下单，请谨慎使用】');?>
                    <?= $form->field($model, 'closing_reason')->textarea();?>
                    <?= $form->field($model, 'delivery_method')->dropDownList(ShippingTypeEnum::getMap());?>
                    <?= $form->field($model, 'level_cate')->radioList(StateEnum::getMap())->hint('开启多级分类后，快店商品将分三级分类展示，便于您更好的管理多类型商品，注意：开启多级分类后，前台只展示侧重文字模板，侧重图片模板将关闭。');?>
                    <?= $form->field($model, 'package_alias')->textInput();?>
                    <?= $form->field($model, 'freight_alias')->textInput() ?>



                </div>
                <div class="tab-pane" id="tab_2">

                    <?= $form->field($model, 'live_video')->textInput() ?>
                </div>
                <div class="tab-pane" id="tab_3">

                    <?= $form->field($model, 'live_video')->textInput() ?>
                </div>
                <div class="tab-pane" id="tab_4">
                    <?= $form->field($model, 'offline_retail')->radioList(StateEnum::getMap())->hint('是否开启线下零售');?>
                    <?= $form->field($model, 'offline_packing')->radioList(StateEnum::getMap())->hint('开启时线下零售售出的商品按照这个商品设置的打包费收取相应的打包费，关闭时，线下零售售出的商品不收打包费。');?>
                </div>
                <div class="tab-pane" id="tab_5">

                    <?= $form->field($model, 'live_video')->textInput() ?>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">保存</button>
                    <span class="btn btn-white" onclick="history.go(-1)">返回</span>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
