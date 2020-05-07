<?php
use common\helpers\Html;
use common\helpers\ImageHelper;
use yii\widgets\ActiveForm;
$this->title= "店铺首页";
?>
    <style>
       .btn{background-color:transparent;position:absolute;right:0px;top:45%;cursor:pointer;padding:20px 20px;height:38px;float: left}
       .btn button.minus{margin-right:-10px;display:none;}
       .btn button{width:40px;height:40px;border:0;background:transparent;padding:0;}
       .btn button strong{padding:5px 10px;font-size:15px;display:inline-block;text-indent:-100px;padding:7px 11px;height:12px;}
       .btn button.minus strong{background:url(images/down.png) no-repeat;background-size:18px 18px;}
       .btn i{display:none;width:22px;text-align:center;font-style:normal;vertical-align:top;margin-top:5px;line-height:18px;}
       .btn button.add{margin-left:-10px;}
       .btn button.add strong{background:url(images/up.png) no-repeat;background-size:18px 18px;}
       .btn .price{display:none;}
    </style>
<div class="header">
    <div class="leftlogo">
        <img src="<?= ImageHelper::default($model['store']['store_logo']);?>">

    </div>
    <div class="righttitle">
        <h1><?=$model['merchant']['title'].'【'.$model['store']['title'].'】';?></h1>
        <h2><?=$model['store']['province']['title'].'-'.$model['store']['city']['title'].'-'.$model['store']['area']['title'].'-'.$model['store']['address'] ;?></h2>
    </div>
    <div class="bulletin"><span class="bulletin-title"></span><?= $model['notice'] ? $model['notice'] : "无";?></div>
</div>

<div class="swiper-container">
    <!--<ul class="swiper-container-ul" style="">
      <li class="swiper-container-ul-li actives">商品</li>
      <li class="swiper-container-ul-li">店铺</li>
    </ul>-->
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="content" style="height: 2216px;">
                <div id="left" class="left" style="">
                    <ul>
                        <?php foreach ( $cate as $item ):?>
                        <li><?=$item['title'];?></li>
                        <?php endforeach;?>

                    </ul>
                </div>
                <div id="right" class="right-con right" style="">
                    <ul>
                        <?php foreach ( $cate as $item ):?>
                        <li>
                            <div class="class-title"><?=$item['title'];?></div>
                            <?php foreach ( $item['product'] as $_item ):?>
                            <div>
                                <div class="menu-txt item">
                                    <div class="item-left">
                                        <div class="item-img" style="width: 75px"><img src="<?= ImageHelper::default($_item['picture']);?>" style="position: relative; height: 75px;width: 75px"></div>
                                    </div>
                                    <div class="item-right">
                                        <div class="title"><?= $_item['name'];?></div>
                                        <p class="list2">
                                            <b style="color: red; font-size: 12px">￥<?= $_item['price'];?>/<?=$_item['unit'];?></b>
                                        <div class="btn">
                                            <button class="minus" <?php if( Yii::$app->yunShopService->cartShop->findProductCountByCart($store_id,$_item['id']) > 0 ){ echo 'style="display: inline-block;"';}else{}?>>
                                                <strong></strong>
                                            </button>
                                            <i id="<?=$_item['id'];?>" data-id="<?=$_item['id'];?>" <?php if( Yii::$app->yunShopService->cartShop->findProductCountByCart($store_id,$_item['id']) > 0 ){ echo 'style="display: inline-block;"';}else{}?>><?= Yii::$app->yunShopService->cartShop->findProductCountByCart($store_id,$_item['id']) ?? 0;?></i>
                                            <button class="add">
                                                <strong></strong>
                                            </button>

                                            <i class="price" data-id="<?=$_item['name'];?>"><?= $_item['price'];?></i>
                                        </div>
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <?php endforeach;?>
                        </li>
                        <?php endforeach;?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="mask"></div>

    <?php $form = ActiveForm::begin([
        'id' => 'form',
    'action' => '/html5/yun-shop/order/order/confirm',

])?>
    <div class="popup">
        <div class="uptitle">
            <span>已选菜品</span>
            <div class="tb delete">清空</div>
        </div>
        <div class="uplist">
            <input name="store_id" type="hidden" value="<?=$store_id;?>">
            <ul id="cart_product">
                <?php foreach ( $product as $p ):?>
                <li>
                    <div class="uppic">
                        <img src="<?= ImageHelper::default($p['product_img']);?>" height="60px">
                    </div>
                    <div class="listtitle">
                        <input type="hidden" name="OrderDetail[<?=$p['product_id'];?>][id]" value="<?=$p['product_id'];?>">
                        <input type="hidden" name="OrderDetail[<?=$p['product_id'];?>][num]" value="<?=$p['number'];?>">
                        <input type="hidden" name="OrderDetail[<?=$p['product_id'];?>][price]" value="<?=$p['price'];?>">
                        <h1><?= $p['product_name'];?></h1>
                        <h2>￥<?=$p['price'];?></h2>
                    </div>
                    <div class="listright">
                        <span  data-id="<?=$p['product_id'];?>" data-name="<?=$p['product_name'];?>" ></span>
                        <p >x<?=$p['number'];?></p>
                        <span  data-id="<?=$p['product_id'];?>" data-name="<?=$p['product_name'];?>"></span>
                    </div>
                </li>
                <?php endforeach;?>

            </ul>

        </div>
    </div>
    <div>
    <div class="shop" id="cartN">
        <div class="shop shopico">
            <i></i>
            <div class="numspan"><span id="totalcountshow"><?= Yii::$app->yunShopService->cartShop->getCartItemCount($store_id) ?? 0;?></span></div>
        </div>

    </div>

    <div style="<?php if(empty($product)){echo 'display: none';}else{};?>" id="pay"><button class="shop_submit" type="submit">去结算</button></div>
</div>
    <?php ActiveForm::end()?>

<?php
$js = <<<JS
    //加的效果  
	$(".add").click(function () {
		$(this).prevAll().css("display", "inline-block");  
		var url = '/html5/yun-shop/cart/create';
		var n = $(this).prev().text();  
		var num = parseInt(n) + 1;  
		if (num == 0) { return; }  
		$(this).prev().text(num);  
		var id = $(this).prev().attr('data-id');
		var name = $(this).next().attr('data-id');
		var danjia = $(this).next().text();//获取单价  
		var data = {'id':id,'name':name,'num':num,'price':danjia,'store_id':$store_id};
		var a = $("#totalpriceshow").html();//获取当前所选总价  
		 $("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价  
		 var nm = $("#totalcountshow").html();//获取数量  
		 $("#totalcountshow").html(nm*1+1);
		$.post(url,data,function(result){
		    if( result.code == 402 ){
		        layer.confirm(result.message, {
		            btn: ['确定','取消'] 
		            }, function(){
		            window.location.href = '/html5/yun-user/public/login';
		            return false;
		            }, function(){
		            
            });
		    }else if( result.code == 200 ){
		        setCartProduct(result.data);
		        if( result.data == "" ){
		            document.getElementById("pay").style.display="none";
		        }else{
		            document.getElementById("pay").style.display="";
		        }
		        jss();//<span style='font-family: Arial, Helvetica, sans-serif;'></span>   改变按钮样式
		        return false;
		    }
		    
		    },"JSON");
		
		
		
	});  
	//减的效果  
	$(".minus").click(function () {  
		var n = $(this).next().text();  
		var num = parseInt(n) - 1;  

		$(this).next().text(num);//减1  

		var danjia = $(this).nextAll(".price").text();//获取单价  
		var url = '/html5/yun-shop/cart/edit';
		var id = $(this).next().attr('data-id');
		var name = $(this).next().next().next().attr('data-id');
		var data = {'id':id,'name':name,'num':num,'price':danjia,'store_id':$store_id};
		var a = $("#totalpriceshow").html();//获取当前所选总价  
		$("#totalpriceshow").html((a * 1 - danjia * 1).toFixed(2));//计算当前所选总价  
		var nm = $("#totalcountshow").html();//获取数量  
		$("#totalcountshow").html(nm * 1 - 1);
		//如果数量小于或等于0则隐藏减号和数量  
		if (num <= 0) {
		    $(this).next().css("display", "none");
		    $(this).css("display", "none");
		} 
		$.post(url,data,function(result){
		    if( result.code == 402 ){
		        layer.confirm(result.message, {
		            btn: ['确定','取消'] 
		            }, function(){
		            window.location.href = '/html5/yun-user/public/login';
		            return false;
		            }, function(){
		            
            });
		    }else if( result.code == 200 ){
		        setCartProduct(result.data);
		        if( result.data == "" ){
		            document.getElementById("pay").style.display="none";
		        }else{
		            document.getElementById("pay").style.display="";
		        }
		        jss();//改变按钮样式 
		    }
		    },"JSON");
		
	});
	function setCartProduct(data) {
	    product_html = "";
	     $(data).each(function (i) {
                product_html += '<li>' +
                    '<div class="uppic"><img src="'+this.product_img+'"></div>'+
                	'<div class="listtitle"><h1>'+this.product_name+'</h1><h2>￥'+this.price+'</h2></div>'+
                	'<input type="hidden" name="OrderDetail['+this.product_id+'][id]" value="'+this.product_id+'"><input type="hidden" name="OrderDetail['+this.product_id+'][num]" value="'+this.number+'"><input type="hidden" name="OrderDetail['+this.product_id+'][price]" value="'+this.price+'">'+
                    '<div class="listright"><span ></span><p>x'+this.number+'</p><span></span></div>'+
                    '</li>';
               
            });
	     $('#cart_product').html(product_html);
	}
	
	function jss() {  
		var m = $("#totalcountshow").html();  
		if (m > 0) {  
			$(".right").find("a").removeClass("disable");  
		} else {  
		   $(".right").find("a").addClass("disable");  
		}  
	};
	$(function(){
	    
        $('.content').css('height',$('.right').height());
        $('.left ul li').eq(0).addClass('active');
        $(window).scroll(function(){
            if($(window).scrollTop() >= 150){
                $('.swiper-container-ul').css('position','fixed');
                $('.left').css('position','fixed');
                $('.right').css('margin-left',$('.left').width());
            }else {
                $('.swiper-container-ul').css('position','');
                $('.left').css('position','');
                $('.right').css('margin-left','');
            };
            //滚动到标杆位置,左侧导航加active
            $('.right ul li').each(function(){
                var target = parseInt($(this).offset().top-$(window).scrollTop()-150);
                //alert(target);
                var i = $(this).index();
                if (target<=0) {
                    $('.left ul li').removeClass('active');
                    $('.left ul li').eq(i).addClass('active');
                }
            });
        });
        $('.left ul li').click(function(){
            var i = $(this).index('.left ul li');
            $('body, html').animate({scrollTop:$('.right ul li').eq(i).offset().top-40},500);
        });
        
        //购物车点击
	$('.shop').click(function(){
      $('.mask').show();
	  $('.popup').css("bottom","50px");
    });
	$('.mask').click(function(){
      $('.mask').hide();
	  $('.popup').css("bottom","-300px");
    });
    });
	$('.delete').click(function() {
	    var url = '/html5/yun-shop/cart/delete';
	    var data = {'store_id': $store_id};
	    $.post(url,data,function(result) {
	        if( result.code != 200 ){
	            layer.msg(result.message);
	            return false; 
	        }
	        
	        layer.msg(result.message);
	        window.location = window.location;
	        return false;
	    })
	    
	});
	//购物车加减
	$(".lessnum").click(function() {
	    var n = $(this).next().text();
	    var num = parseInt(n) - 1; 
	    var id =$("#+id").text();
	    alert(id)
	  
	});
	$(".addnum").click(function() {
	    var n = $(this).prev().text();
	    var num = parseInt(n) + 1;
	    $(this).prev().text(num);
	    var a = $(".add").next().next().next().text();
	    alert(parseInt(a))
	});
	
	
JS;
$this->registerJs($js);
?>