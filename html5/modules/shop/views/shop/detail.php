<?php
use common\helpers\ImageHelper;
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
                                        <div class="item-img"><img src="<?= ImageHelper::default($_item['picture']);?>" style="position: relative; height: 75px"></div>
                                    </div>
                                    <div class="item-right">
                                        <div class="title"><?= $_item['name'];?></div>
                                        <p class="list2">
                                            <b style="color: red; font-size: 12px">￥<?= $_item['price'];?>/<?=$_item['unit'];?></b>
                                        <div class="btn">
                                            <button class="minus">
                                                <strong></strong>
                                            </button>
                                            <i>0</i>
                                            <button class="add">
                                                <strong></strong>
                                            </button>

                                            <i class="price"><?= $_item['price'];?></i>
                                            <input type="hidden" name="product[][id]" value="<?=$_item['id'];?>">
                                            <input type="hidden" name="product[][name]" value="<?=$_item['name'];?>">
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
<div class="popup">
    <div class="uptitle">
        <span>已选菜品</span>
        <div class="tb">清空</div>
    </div>
    <div class="uplist" >
        <ul class="orderdetail" id="orderdetail">

        </ul>
    </div>
</div>

<div class="shop" id="cartN">
    <div class="shopico">
        <i></i>
        <div class="numspan"><span id="totalcountshow">0</span></div>
    </div>
    <div class="shopprice" >￥<span id="totalpriceshow">0.00</span>元</div>
    <div class="shopbut">提交订单</div>
</div>

<?php
$js = <<<JS
    //加的效果  
	$(".add").click(function () {  
		$(this).prevAll().css("display", "inline-block");  
		var n = $(this).prev().text();  
		var num = parseInt(n) + 1;  
		if (num == 0) { return; }  
		$(this).prev().text(num);  
		var id = $("input[name='product[]").val(); 
		var name = $("input[name='name']").val(); 
		alert(id)
		var danjia = $(this).next().text();//获取单价  
		var subtotal = num * danjia;
		var a = $("#totalpriceshow").html();//获取当前所选总价  
		$("#totalpriceshow").html((a * 1 + danjia * 1).toFixed(2));//计算当前所选总价  
		var nm = $("#totalcountshow").html();//获取数量  
		$("#totalcountshow").html(nm*1+1);  
		cartProduct(id,name,danjia,num,subtotal)
		jss();//<span style='font-family: Arial, Helvetica, sans-serif;'></span>   改变按钮样式
	});  
	//减的效果  
	$(".minus").click(function () {  
		var n = $(this).next().text();  
		var num = parseInt(n) - 1;  

		$(this).next().text(num);//减1  

		var danjia = $(this).nextAll(".price").text();//获取单价  
		var a = $("#totalpriceshow").html();//获取当前所选总价  
		$("#totalpriceshow").html((a * 1 - danjia * 1).toFixed(2));//计算当前所选总价  
		 
		var nm = $("#totalcountshow").html();//获取数量  
		$("#totalcountshow").html(nm * 1 - 1);  
		//如果数量小于或等于0则隐藏减号和数量  
		if (num <= 0) {  
			$(this).next().css("display", "none");  
			$(this).css("display", "none");  
			jss();//改变按钮样式  
			 return  
		}  
	});
	function cartProduct(id,name,price,num,subtotal) {
	    
	    $('.orderdetail').append('<li><div class="uppic"><img src="images/p1.jpg"></div><div class="listtitle"><h1>'+name+'</h1><h2>￥'+price+'</h2></div> <div class="btn"><button class="minus" style="display: inline-block;"><strong></strong></button><i style="display: inline-block;">'+num+'</i><button class="add"><strong></strong></button><i class="price">'+price+'</i><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="name" value="'+name+'"></div></li>');
	    
	   
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
JS;
$this->registerJs($js);
?>