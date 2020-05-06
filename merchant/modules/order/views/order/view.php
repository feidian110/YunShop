<?php
use addons\YunStore\common\enums\OrderStatusEnum;
use common\enums\PayTypeEnum;
use addons\YunStore\common\enums\ShippingTypeEnum;
use addons\YunStore\common\enums\ShippingStatusEnum;
use common\helpers\Html;
use common\helpers\ImageHelper;

$this->title = '订单详情';
?>
<style>
    dl{margin:0;padding:0}
    dl.row,dd.opt{font-size:0;color:#333;padding:12px 0;position:relative;z-index:1}
    dl.row:first-child,dd.opt:first-child{border-top-color:#FFF}
    dl.row:nth-child(even),dd.opt:nth-child(even){background-color:#FDFDFD}
    dl.row:hover p.notic{color:#148eff;}
    dt.tit,dd.opt{font-size:12px;line-height:24px;vertical-align:top;letter-spacing:normal;display:inline-block;*display:inline;*zoom:1}
    dt.tit{text-align:right; min-width:100px;padding-right:2%}
    dd.opt{text-align:left;width:70%}
    dd.opt #district{
        min-width: 50px;
        display: inline-block !important;
    }
    @media screen and (max-width: 1366px) {
        dt.tit{text-align:right; min-width:100px;padding-right:2%}
        dd.opt{text-align:left;width:70%}
    }
    .order-style{
        width: 1000px;
        margin: 0 auto;
    }
    .order-style h4{font-size:12px;line-height:20px;font-weight:600;color:#333;height:20px;margin-bottom:8px}
    .order-style .order-base_info,.order-style .order-addr-note,.order-style .contact-info{padding-bottom:10px;margin-bottom:10px;border-bottom:solid 1px #E6E6E6}
    .order-style table{border:solid 1px #D7D7D7;width:100%}
    .order-style table thead th,.order-style table tbody td{text-align:center;min-height:20px;padding:9px}
    .order-style table thead th{background-color:#edfbf8;border-bottom:solid 1px #D7D7D7}
    .order-style table tbody td{border-bottom:solid 1px #D7D7D7;word-break:break-all}
    .order-style table .goods-thumb{width:40px;height:30px}
    .order-style table thead tr th:last-child,.order-style table tbody tr td:last-child{width:20%}
    .order-style table .goods-thumb a{line-height:0;background-color:#FFF;text-align:center;vertical-align:middle;display:table-cell;*display:block;width:30px;height:30px;overflow:hidden}
    .order-style table .goods-thumb a img{max-width:30px;max-height:30px;margin-top:expression(30-this.height/2)}
    .order-style .total-amount{text-align:right;padding:10px 0}
    .order-style .total-amount h3{font-size:14px;font-weight:normal;color:#777;line-height:24px}
    .order-style .total-amount h3 strong{font-size:20px;color:#ff3300}
    .order-style .total-amount h4{color:#999;font-size:12px;font-weight:normal;line-height:20px}
    .order-style .total-amount h5{}
    .order-profile{
        margin:0 auto;
        border: solid 1px #C0C0C0;
        position: relative;
        z-index: 1;
    }
    .order-panels{
        padding: 9px 19px;
    }
    .order-panels dl{font-size: 0;padding-bottom: 5px;}
    .order-panels dt, .order-panels dd{font-size:12px;line-height:20px;vertical-align:top;display:inline-block;max-width:720px}
    .order-panels dt{color:#999;width:100px;text-align:right}
    .order-panels dd{color:#333;min-width:200px}
    .order-product-info{
        word-wrap: break-word;
        outline: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> 操作提示：</h4>
                    <ul>
                        <li>可在订单详情里完成配货、发货操作</li>
                        <li>订单确认是指订单手动确认后才可进行发货操作，如果想自动确认需要在购物流程里进行设置</li>
                        <li>修改订单费用，一般建议先与客户协商一致再进行操作或在商品页面显眼处标明价格浮动规则</li>
                    </ul>
                </div>
                <div class="order-style">
                    <div class="order-profile">
                        <div class="order-panels">
                            <div class="order-base_info">
                                <h5>基本信息</h5>
                                <dl>
                                    <dt>订单ID：</dt>
                                    <dd><?=$model['id'];?></dd>
                                    <dt>订单编号：</dt>
                                    <dd><?=$model['order_sn'];?></dd>
                                    <dt>会员：</dt>
                                    <dd><?=$model['buyer']['username'];?></dd>
                                </dl>
                                <dl>
                                    <dt>E-mail：</dt>
                                    <dd><?=$model['buyer']['email'];?></dd>
                                    <dt>电话：</dt>
                                    <dd><?=$model['buyer']['mobile'];?></dd>
                                    <dt>应付金额：</dt>
                                    <dd>￥<?=Yii::$app->yunShopService->orderShop->getProductTotalByOrderId($model['id'],$model['store_id'])?></dd>
                                </dl>
                                <dl>
                                    <dt>订单状态：</dt>
                                    <dd></dd>
                                    <dt>下单时间：</dt>
                                    <dd><?=Yii::$app->formatter->asDatetime($model->created_at);?></dd>
                                    <dt>支付方式：</dt>
                                    <dd><?=PayTypeEnum::getValue($model['payment']);?></dd>
                                </dl>
                                <dl>
                                    <dt>支付时间：</dt>
                                    <dd><?=$model['pay_time'] ? Yii::$app->formatter->asDatetime($model->pay_time) : '未支付';?></dd>
                                    <dt>发票抬头：</dt>
                                    <dd>无</dd>
                                    <dt>纳税人识别号：</dt>
                                    <dd>无</dd>
                                </dl>
                            </div>
                            <div class="order-addr-note">
                                <h5>收货信息</h5>
                                <dl>
                                    <dt>配送方式：</dt>
                                    <dd><?=ShippingTypeEnum::getValue($model['shipping_type']);?></dd>
                                </dl>
                                <dl>
                                    <dt>收货人：</dt>
                                    <dd><?=$model['consignee']['receiver_name'];?></dd>
                                    <dt>联系方式：</dt>
                                    <dd><?=$model['consignee']['receiver_mobile'];?></dd>

                                </dl>
                                <dl>
                                    <dt>收货地址：</dt>
                                    <dd><?=$model['consignee']['address'];?></dd>
                                    <dt>邮编：</dt>
                                    <dd><?=$model['consignee']['zip'];?></dd>
                                </dl>
                                <dl>
                                    <dt>自提点：</dt>
                                    <dd><?=$model['pick']['title'];?></dd>
                                    <dt>提货人：</dt>
                                    <dd><?=$model['pick_name'];?></dd>
                                    <dt>联系方式：</dt>
                                    <dd><?=$model['pick_mobile'];?></dd>
                                </dl>
                                <dl>
                                    <dt>留言：</dt>
                                    <dd><?=$model['message'];?></dd>
                                </dl>
                            </div>
                            <div class="order-product-info">
                                <h5>商品信息</h5>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>商品编码</th>
                                        <th>商品图片</th>
                                        <th>商品</th>
                                        <th>规格属性</th>
                                        <th>数量</th>
                                        <th>商品价格</th>
                                        <th>折扣价格</th>
                                        <th>商品小计</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ( $model['profile'] as $item ):?>
                                    <tr>
                                        <td><?=$item['product_id'];?></td>
                                        <td><div class="goods-thumb"><a href="<?=ImageHelper::default($item['product_picture']);?>" target="_blank"><img src="<?=ImageHelper::default($item['product_picture']);?>"></a></div></td>
                                        <td style="text-align: left;"><?=$item['product_name'];?></td>
                                        <td></td>
                                        <td><?=$item['num'];?></td>
                                        <td style="text-align: right;">￥<?=$item['price'];?></td>
                                        <td style="text-align: right">￥0.00</td>
                                        <td>￥<?=$item['product_money'];?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-amount contact-info">
                                <h4>订单总额：￥<?=Yii::$app->yunShopService->orderShop->getProductTotalByOrderId($model['id'],$model['store_id'])?></h4>
                            </div>
                            <div class="contact-info">
                                <h5>费用信息</h5>
                                <dl>
                                    <dt>小计：</dt>
                                    <dd>￥<?=Yii::$app->yunShopService->orderShop->getProductTotalByOrderId($model['id'],$model['store_id'])?></dd>
                                    <dt>运费：+</dt>
                                    <dd>￥0.00</dd>
                                    <dt>积分(-0)：</dt>
                                    <dd>0.00</dd>
                                </dl>
                                <dl>
                                    <dt>余额抵扣：-</dt>
                                    <dd>￥0.00</dd>
                                    <dt>优惠券抵扣：-</dt>
                                    <dd>￥0.00</dd>
                                    <dt>价格调整：减</dt>
                                    <dd>￥0.00</dd>
                                </dl>
                                <dl>
                                    <dt>订单促销：-</dt>
                                    <dd>￥0.00</dd>
                                    <dt>应付：</dt>
                                    <dd><strong class="red_common">￥<?=Yii::$app->yunShopService->orderShop->getProductTotalByOrderId($model['id'],$model['store_id'])?></strong></dd>

                                </dl>
                            </div>
                            <div class="contact-info">
                                <h5>操作信息</h5>
                                <dl class="row">
                                    <dt class="tit">
                                        操作备注：
                                    </dt>
                                    <dd class="opt">
                                        <?= Html::textarea('remark','',['class'=>'form-control','rows'=>4,'style'=>'width:850px']);?>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="tit">可执行操作：</dt>
                                    <dd class="opt">
                                        <?php if( $model['shipping_status'] == ShippingStatusEnum::UN_SHIPPED || ShippingStatusEnum::STOCK_UP ){
                                            echo Html::a('去发货',[''],['class'=> 'btn btn-primary btn-sm']).'&nbsp;'. Html::a('无效',[''],['class'=> 'btn btn-primary btn-sm']);
                                        }else{
                                            echo Html::a('订单完成',[''],['class'=> 'btn btn-primary btn-sm']);
                                        }?>

                                    </dd>
                                </dl>
                            </div>
                            <div class="order-product-info">
                                <h5>操作记录</h5>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>操作人</th>
                                        <th>操作时间</th>
                                        <th>订单状态</th>
                                        <th>配货状态</th>
                                        <th>发货状态</th>
                                        <th>付款状态</th>
                                        <th>描述</th>
                                        <th>备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
