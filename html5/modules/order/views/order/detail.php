<?php
use common\helpers\Url;
use common\helpers\ImageHelper;
$this->title = "订单详情"
?>
<style>
    .footer{
        width:100%; height:57px; background:#FCFCFC; padding:5px 0px; bottom:0px; left:0px; position:fixed; overflow:hidden; z-index:10; box-shadow:1px -1px 3px #D1D1D1; display:flex;
    }
    .icons-home:before{content:"\e611";}
    .footer-icons{font-family:"hui-font"; text-align:center; font-size:20px; height:26px; line-height:26px;}
    .footer-text{text-align:center; font-size:13px; height:18px; line-height:18px; padding-top:2px;}
</style>
<section class="aui-flexView">
    <header class="aui-navBar aui-navBar-fixed">
        <a href="javascript:;" class="aui-navBar-item">
            <i class="icon icon-return"></i>
        </a>
        <div class="aui-center">
            <span class="aui-center-title">订单详情</span>
        </div>
        <a href="javascript:;" class="aui-navBar-item">
            <i class="icon icon-sys"></i>
        </a>
    </header>
    <section class="aui-scrollView" style="padding-bottom: 70px">
        <div class="aui-order-box">
            <div class="aui-flex aui-choice-white">
                <div class="aui-flex-box">自提点信息</div>
                <div class="aui-flex-triangle"><?=$model['pick']['title'];?></div>
            </div>
            <div class="aui-flex aui-choice-white">
                <div class="aui-flex-box">提货人</div>
                <div class="aui-flex-triangle"><?=$model['pick_name'];?></div>
            </div>
            <div class="aui-flex aui-choice-white aui-mar15">
                <div class="aui-flex-box">提货人电话：</div>
                <div class="aui-flex-triangle"><?=$model['pick_mobile'];?></div>
            </div>
            <div class="aui-flex aui-choice-white">
                <div class="aui-flex-box">
                    <h2>商品清单</h2>
                </div>
            </div>
            <?php foreach ($model['profile'] as $item):?>
            <div class="aui-flex aui-flex-default aui-mar15">
                <div class="aui-flex-goods">
                    <img src="<?= ImageHelper::default($item['product_picture'])?>" alt="">
                </div>
                <div class="aui-flex-box">
                    <h2><?= $item['product_name'];?></h2>
                    <p></p>
                    <div class="aui-flex aui-flex-clear">
                        <div class="aui-flex-box">￥<?=$item['price'];?></div>
                        <div>x<?=$item['num'];?></div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">配送方式</div>
                <div class="aui-flex-triangle">买家自提</div>
            </div>
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">付款方式</div>
                <div class="aui-flex-triangle">线下付款</div>
            </div>
            <div class="aui-flex aui-choice-white  aui-mar15">
                <div class="aui-flex-box">发票信息</div>
                <div class="aui-flex-triangle">不可开发票</div>
            </div>
            <div class="aui-flex aui-choice-white aui-mar15">
                <div class="aui-flex-box">
                    <h2>商品总价</h2>
                    <h3>运费总额</h3>
                </div>
                <div class="aui-flex-triangle aui-flex-triangle-clear">
                    <h4>￥</h4>
                    <p>+￥0元</p>
                </div>
            </div>
            <div class="aui-flex aui-choice-white ">
                <div class="aui-flex-box">
                    <h3>订单编号</h3>
                    <h3>下单时间</h3>
                </div>
                <div class="aui-flex-triangle aui-flex-triangle-clear">
                    <h5><?=$model['order_sn'];?></h5>
                    <p><?=date('Y-m-d H:i:s',$model['created_at'])?></p>
                </div>
            </div>
        </div>
    </section>
    <div class="footer">
        <a href="<?=Url::to(['/shop/shop/detail','store_id'=>$model['store_id']]);?>" style="width: 33%">
            <div class="footer-icons"></div>
            <div class="footer-text">首页</div>
        </a>
        <a href="<?=Url::to(['order/index']);?>" style="width: 34%">
            <div class="footer-icons"></div>
            <div class="footer-text">订单</div>
        </a>
        <a href="/html5/yun-user/public/index" style="width: 33%">
            <div class="footer-icons"></div>
            <div class="footer-text">我的</div>
        </a>
    </div>
</section>

