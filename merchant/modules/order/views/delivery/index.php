<?php
$this->title = '发货管理';
$this->params['breadcrumbs'][] = ['label' => '快店管理', 'url' => 'javascript:(0);'];
$this->params['breadcrumbs'][] = ['label' => '订单管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];


use addons\YunStore\common\enums\ShippingStatusEnum;
use common\helpers\Html;
use yii\grid\GridView;

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title; ?></h3>
                <div class="box-tools">
                    <?= Html::a('<i></i>订单数据','javascript:0;',['class'=> 'btn btn-primary btn-sm product']);?>
                    <?= Html::a('<i class="fa fa-fw fa-download"></i> 批量发货','javascript:(0);',['class'=> 'btn btn-primary btn-sm delivery']);?>
                </div>
            </div>
            <div class="box-body table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'options' => ['id'=> 'order'],
                    //重新定义分页样式
                    'tableOptions' => [
                        'class' => 'table table-hover rf-table',
                        'fixedNumber' => 2,
                        'fixedRightNumber' => 1,
                    ],
                    'columns' => [

                        [
                            'class' => 'yii\grid\CheckboxColumn',
                            'name' => 'id',
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
                            'attribute' => 'pick.title',
                            'filter' => Html::activeDropDownList($searchModel, 'pick_id', Yii::$app->yunStoreService->storePick->getPickByMerchantId(), [
                                    'prompt' => '全部',
                                    'class' => 'form-control'
                                ]
                            ),
                            'format' => 'raw',
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
                            'header' => '订单状态',
                        ],
                        [
                            'header' => '发货状态',
                            'attribute' => 'shipping_status',
                            'filter' => Html::activeDropDownList($searchModel, 'shipping_status', ShippingStatusEnum::getMap(), [
                                    'prompt' => '全部',
                                    'class' => 'form-control'
                                ]
                            ),
                            'format' => 'raw',
                            'value' => function($model) {
                                return ShippingStatusEnum::getValue($model['shipping_status']);
                            }
                        ],

                        [
                            'attribute' => 'message',
                            'filter' => false, //不显示搜索框
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

<?php
$js = <<<JS
    $(".product").click(function (){
        var keys = $("#order").yiiGridView("getSelectedRows");
        var url = 'product'+'?ids='+keys;
        window.location.href = url;
    });
    $(".delivery").click(function (){
        var keys = $("#order").yiiGridView("getSelectedRows");
        var url = 'batch'+'?ids='+keys;
        window.location.href = url;
    });
JS;
$this->registerJs($js);
?>
