<?php
use common\helpers\Url;
use common\helpers\Html;
$this->title = '快店购物车';
?>
<div class="hui-common-title" style="margin-top:15px;">
    <div class="hui-common-title-line"></div>
    <div class="hui-common-title-txt">购物车</div>
    <div class="hui-common-title-line"></div>
</div>
<div class="shopping">
    <?php if(!Yii::$app->user->isGuest){
        echo '<div class="shop-group-item" style="padding-top: 5px">
		<div class="shop-name">
			<input type="checkbox" class="check goods-check shopCheck">
			<h4><a href="#">苹果专卖店</a></h4>
			<div class="coupons"><span>领券</span><em>|</em><span>编辑</span></div>
		</div>
		<ul>
			<li>
				<div class="shop-info">
					<input type="checkbox" class="check goods-check goodsCheck">
					<div class="shop-info-img"><a href="#"><img src="/html5/resources/shop/img/computer.jpg" /></a></div>
					<div class="shop-info-text">
						<h4>Apple MacBook Pro 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB SSD闪存/Retina屏 MF839CH/A)</h4>
						<div class="shop-brief"><span>重量:3.3kg</span><span>颜色:标配版</span><span>版本:13.3英寸</span></div>
						<div class="shop-price">
							<div class="shop-pices">￥<b class="price">100.00</b></div>
							<div class="shop-arithmetic">
								<a href="javascript:;" class="minus">-</a>
								<span class="num" >1</span>
								<a href="javascript:;" class="plus">+</a>
							</div>
						</div>
					</div>
				</div>
			</li>
				<div class="shop-info">
					<input type="checkbox" class="check goods-check goodsCheck">
					<div class="shop-info-img"><a href="#"><img src="/html5/resources/shop/img/computer.jpg" /></a></div>
					<div class="shop-info-text">
						<h4>Apple MacBook Pro 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB SSD闪存/Retina屏 MF839CH/A)</h4>
						<div class="shop-brief"><span>重量:3.3kg</span><span>颜色:标配版</span><span>版本:13.3英寸</span></div>
						<div class="shop-price">
							<div class="shop-pices">￥<b class="price">100.00</b></div>
							<div class="shop-arithmetic">
								<a href="javascript:;" class="minus">-</a>
								<span class="num" >1</span>
								<a href="javascript:;" class="plus">+</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="shop-info">
					<input type="checkbox" class="check goods-check goodsCheck">
					<div class="shop-info-img"><a href="#"><img src="/html5/resources/shop/img/computer.jpg" /></a></div>
					<div class="shop-info-text">
						<h4>Apple MacBook Pro 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB SSD闪存/Retina屏 MF839CH/A)</h4>
						<div class="shop-brief"><span>重量:3.3kg</span><span>颜色:标配版</span><span>版本:13.3英寸</span></div>
						<div class="shop-price">
							<div class="shop-pices">￥<b class="price">100.00</b></div>
							<div class="shop-arithmetic">
								<a href="javascript:;" class="minus">-</a>
								<span class="num" >1</span>
								<a href="javascript:;" class="plus">+</a>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<div class="shopPrice">本店总计：￥<span class="shop-total-amount ShopTotal">0.00</span></div>
	</div>

	<div class="shop-group-item">
		<div class="shop-name">
			<input type="checkbox" class="check goods-check shopCheck">
			<h4><a href="#">苹果专卖店</a></h4>
			<div class="coupons"><span>领券</span><em>|</em><span>编辑</span><!--<span class="shop-total-amount ShopTotal">0</span>--></div>
		</div>
		<ul>
			<li>
				<div class="shop-info">
					<input type="checkbox" class="check goods-check goodsCheck">
					<div class="shop-info-img"><a href="#"><img src="/html5/resources/shop/img/computer.jpg" /></a></div>
					<div class="shop-info-text">
						<h4>Apple MacBook Pro 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB SSD闪存/Retina屏 MF839CH/A)</h4>
						<div class="shop-brief"><span>重量:3.3kg</span><span>颜色:标配版</span><span>版本:13.3英寸</span></div>
						<div class="shop-price">
							<div class="shop-pices">￥<b class="price">100.00</b></div>
							<div class="shop-arithmetic">
								<a href="javascript:;" class="minus">-</a>
								<span class="num" >1</span>
								<a href="javascript:;" class="plus">+</a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="shop-info">
					<input type="checkbox" class="check goods-check goodsCheck">
					<div class="shop-info-img"><a href="#"><img src="/html5/resources/shop/img/computer.jpg" /></a></div>
					<div class="shop-info-text">
						<h4>Apple MacBook Pro 13.3英寸笔记本电脑 银色(Core i5 处理器/8GB内存/128GB SSD闪存/Retina屏 MF839CH/A)</h4>
						<div class="shop-brief"><span>重量:3.3kg</span><span>颜色:标配版</span><span>版本:13.3英寸</span></div>
						<div class="shop-price">
							<div class="shop-pices">￥<b class="price">100.00</b></div>
							<div class="shop-arithmetic">
								<a href="javascript:;" class="minus">-</a>
								<span class="num" >1</span>
								<a href="javascript:;" class="plus">+</a>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<div class="shopPrice">本店总计：￥<span class="shop-total-amount ShopTotal">0.00</span></div>
	</div>';
    }?>
</div>
<?php if( Yii::$app->user->isGuest ){
    echo '<div style="width: 100%;position: relative;text-align: center"><span class="hui-icons hui-icons-shopping-cart" style="font-size: 100px;width: 100px;color: gray"></span><br/>'.'空空如也，'.Html::a('去登录','/html5/yun-user/public/login').'</div>';
}else{
    echo '<div class="payment-bar" style="padding-bottom: 5px">
   
	<div class="all-checkbox">
        <input type="checkbox" class="check goods-check" id="AllCheck">全选</div>
	<div class="shop-total">
		<strong>总价：<i class="total" id="AllTotal">0.00</i></strong>
	</div>
	<a href="#" class="settlement">结算</a>
</div>';
}?>

<div id="hui-footer" style="height: 55px">
    <a href="<?= Url::to(['/shop/shop/index']);?>" id="nav-home" style="width: 33%">
        <div class="hui-footer-icons hui-icons-home"></div>
        <div class="hui-footer-text">首页</div>
    </a>
    <a href="<?=Url::to(['/cart/index']);?>" id="nav-news" style="width: 33%">
        <div class="hui-footer-icons hui-icons-news"></div>
        <div class="hui-footer-text">购物车</div>
    </a>

    <a href="/html5/yun-user/public/index" id="nav-my" style="width: 33%">
        <div class="hui-footer-icons hui-icons-my"></div>
        <div class="hui-footer-text">我的</div>
    </a>
</div>
