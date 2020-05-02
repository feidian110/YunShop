<?php
$this->title = '订单管理';
$this->params['breadcrumbs'][] = ['label' => '快店管理', 'url' => 'javascript:(0);'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

use common\enums\StatusEnum;
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
                            'headerOptions' => ['class' => 'col-md-1'],
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
                            'attribute' => 'pick.title'
                        ],
                        [
                            'attribute' => 'product_total_price'
                        ],
                        [
                            'attribute' => 'order_price'
                        ],

                        [
                            'header' => "门店基本信息",
                            'format' => 'raw',
                            'value' => function ( $model ){
                                return Html::a('点击查看', ['view', 'id' => $model->id], [
                                    'class' => 'blue',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#ajaxModal',
                                ]) ;
                            }
                        ],
                        [
                            'attribute' => 'message',
                        ],
                        [
                            'header' => '状态',

                        ],

                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => ' {edit}  {destroy}',
                            'buttons' => [
                                'edit' => function ($url, $model, $key) {
                                    return Html::a('编辑', ['edit', 'id' => $model->id], [
                                        'class' => 'green'
                                    ]);
                                },
                                'destroy' => function ($url, $model, $key) {
                                    return Html::a('删除', ['destroy', 'id' => $model->id], [
                                        'class' => 'red',
                                    ]) ;
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
