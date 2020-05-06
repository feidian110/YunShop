<?php
$this->title = '订单管理';
$this->params['breadcrumbs'][] = ['label' => '快店管理', 'url' => 'javascript:(0);'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

use common\enums\PayStatusEnum;
use addons\YunStore\common\enums\ShippingTypeEnum;
use addons\YunStore\common\enums\ShippingStatusEnum;
use common\enums\PayTypeEnum;

use common\helpers\Html;
use yii\grid\GridView;

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title; ?></h3>
                <div class="box-tools">
                    <?= Html::create(['edit'], '创建') ?>
                </div>
            </div>
            <div class="box-body table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //重新定义分页样式
                    'tableOptions' => [
                        'class' => 'table table-hover rf-table',
                        'fixedNumber' => 2,
                        'fixedRightNumber' => 1,
                    ],
                    'columns' => [

                        [
                            'attribute' => 'id',
                        ],
                        [
                            'header' => "所属门店",
                            'attribute' => 'title',
                            'filter' => false, //不显示搜索框
                            'value' => function( $model ){
                                return $model->merchant['title'].'【'.$model['store']['title'].'】';
                            }
                        ],
                        [
                            'header' => "自提点信息",
                            'attribute' => 'pick.title'
                        ],
                        [
                            'header' => "会员信息",
                            'value' => function ($model){
                                return $model['buyer']['nickname'] ? $model['buyer']['nickname'] : $model['buyer']['username'];
                            }
                        ],
                        [
                            'header' => "提货人信息",
                            'attribute' => 'pick_name',
                            'value' => function($model){
                                return $model['pick_name'].'：'.$model['pick_mobile'];
                            }
                        ],
                        [
                            'attribute' => 'order_price'
                        ],

                        [
                            'attribute' => 'payment',
                            'value' => function ($model){
                                 return PayTypeEnum::getValue($model['payment']);
                            }
                        ],
                        [
                            'attribute' => 'shipping_type',
                            'value' => function ($model){
                                return ShippingTypeEnum::getValue($model['shipping_type']);
                            }
                        ],
                        [
                            'header' => '订单状态',
                        ],
                        [
                            'header' => '发货状态',
                            'attribute' => 'shipping_status',
                            'value' => function($model) {
                                return ShippingStatusEnum::getValue($model['shipping_status']);
                            }
                        ],
                        [
                            'header' => '付款状态',
                            'attribute' =>'pay_status',
                            'value' => function($model){
                                return PayStatusEnum::getValue($model['pay_status']);
                            }
                        ],
                        [
                            'attribute' => 'message',
                        ],
                        [
                            'header' => '订单售后',
                            'value' => function( $model ){

                            }
                        ],
                        [
                            'header' => '下单时间',
                            'value' => function ($model){
                                return Yii::$app->formatter->asDatetime($model->created_at);
                            }
                        ],
                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => ' {view}',
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('查看', ['view', 'id' => $model->id], [
                                        'class' => 'green'
                                    ]);
                                },

                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
