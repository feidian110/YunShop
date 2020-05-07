<?php
use common\enums\PayTypeEnum;
use addons\YunStore\common\enums\ShippingTypeEnum;
use common\helpers\Html;
use common\helpers\ImageHelper;
use yii\widgets\ActiveForm;

$this->title = "确认订单";
?>
<?php $form = ActiveForm::begin([

    'action' => '/html5/yun-shop/order/order/create',
    ])?>
<section class="aui-flexView">
    <header class="aui-navBar aui-navBar-fixed">
        <a href="javascript:history.go(-1)" class="aui-navBar-item">
            <i class="icon icon-return"></i>
        </a>
        <div class="aui-center">
            <span class="aui-center-title">确认订单</span>
        </div>
        <a href="javascript:;" class="aui-navBar-item">
            <i class="icon icon-sys"></i>
        </a>
    </header>
    <section class="aui-scrollView">
        <div class="aui-order-box">
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">配送方式</div>
                <div class=""><?= ShippingTypeEnum::getValue($store['shop']['delivery_method']);?></div>
                <?= $form->field($model,'merchant_id')->hiddenInput(['value'=>$store['merchant_id']])->label(false);?>
                <?= $form->field($model,'store_id')->hiddenInput(['value'=>$store['id']])->label(false);?>
            </div>
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">选择自提点</div>
                <?= $form->field($model,'pick_id')->dropDownList(Yii::$app->yunStoreService->storePick->getPickByStoreId($store['id']),['class'=> 'aui-flex-triangle'])->label(false);?>

            </div>
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">提货人姓名</div>
                <?= $form->field($model, 'pick_name')->textInput(['class'=>'aui-flex-triangle','value'=>Yii::$app->user->identity->realname])->label(false);?>

            </div>
            <div class="aui-flex aui-choice-white b-line aui-mar15">
                <div class="aui-flex-box">提货人电话</div>
                <?=$form->field($model,'pick_mobile')->textInput(['class'=> 'aui-flex-triangle','value'=>Yii::$app->user->identity->mobile])->label(false);?>


            </div>
            <div class="aui-flex aui-choice-white">
                <div class="aui-flex-box">
                    <h2>商品清单</h2>
                </div>
            </div>
            <?php foreach ( $detail as $item ):?>
                <div class="aui-flex aui-flex-default aui-mar15">
                    <div class="aui-flex-goods">
                        <img src="<?=ImageHelper::default($item['product_img']);?>" alt="">
                    </div>
                    <div class="aui-flex-box">
                        <h2><?= $item['product_name'];?></h2>
                        <p></p>
                        <div class="aui-flex aui-flex-clear">
                            <div class="aui-flex-box">￥<?=$item['price'];?></div>
                            <div>x<?=$item['number'];?></div>
                            <?= Html::hiddenInput('OrderDetail['.$item['product_id'].'][product_id]',$item['product_id']);?>
                            <?= Html::hiddenInput('OrderDetail['.$item['product_id'].'][num]',$item['number']);?>
                            <?= Html::hiddenInput('OrderDetail['.$item['product_id'].'][price]',$item['price']);?>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            <div class="aui-flex aui-choice-white b-line">
                <div class="aui-flex-box">支付方式</div>
                <?= $form->field($model,'payment')->hiddenInput(['value'=>PayTypeEnum::OFFLINE])->label(false)?>
                <div class="">线下支付</div>

            </div>

            <div class="aui-flex aui-choice-white ">
                <div class="aui-flex-box">
                    <h2>总份数</h2>

                </div>
                <div class="aui-flex-triangle aui-flex-triangle-clear">
                    <h4><?= Yii::$app->yunShopService->cartShop->getCartItemTotal($store['id']);?></h4>
                </div>
            </div>
        </div>
    </section>
    <footer class="aui-bar-footer">
        <div class="aui-flex">
            <div class="aui-flex-box">

            </div>
            <div class="aui-btn-button">
                <button type="submit">去下单</button>
            </div>
        </div>
    </footer>
</section>
<?php ActiveForm::end();?>
