<?php
use common\helpers\Url;
$this->title = "下单成功";
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center" style="margin-top:100px;">
            <div class=""><i class="iconfont text-dining" style="font-size:2em;">&#xe60e;</i>&nbsp;&nbsp;<span class="text-dining font16">下单成功</span></div>
            <div class="text-muted">
                如有任何问题，请联系商家或<a href="<?= Url::to(['detail','order_id'=>$order_id]);?>">查看订单</a>
            </div>
        </div>
    </div>
</div>