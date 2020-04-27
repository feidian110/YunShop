<?php
$this->title = "快店管理";
$this->params['breadcrumbs'][] = ['label' => '商户管理', 'url' => 'javascript:(0);'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

use addons\YunStore\common\enums\AuditStateEnum;
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
                            'attribute' => 'store.id',
                            'headerOptions' => ['class' => 'col-md-1'],
                        ],

                        [

                            'attribute' => 'store.title',
                            'filter' => false, //不显示搜索框
                            'value' => function( $model ){
                                return $model->merchant['title'].'【'.$model->store['title'].'】';
                            }
                        ],

                        [
                            'header' => "完善门店信息",
                            'format' => 'raw',
                            'value' => function ( $model ){
                                return Html::a('修改门店信息',['edit','id'=>$model['id']],['class' => 'green']);
                            }

                        ],
                        [
                            'header' => "视频直播",
                            'format' => 'raw',

                        ],
                        [
                            'header' => "页面装修",
                            'format' => 'raw',

                        ],
                        [
                            'header' => "快店资质审核",
                            'format' => 'raw',

                        ],
                        [
                            'attribute' => 'store.sort',
                            'filter' => false, //不显示搜索框
                            'format' => 'raw',
                            'headerOptions' => ['class' => 'col-md-1'],
                            'value' => function ($model, $key, $index, $column) {
                                return Html::sort($model->store['sort']);
                            }
                        ],
                        [
                            'attribute' => 'status',
                            'filter' => false, //不显示搜索框
                            'value' => function($model){
                                return AuditStateEnum::getValue($model->status);
                            }
                        ],
                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{ajax-edit} {address} {recharge} {edit} {status} {destroy}',
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