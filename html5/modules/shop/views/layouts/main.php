<?php
use addons\YunShop\html5\assets\CartAsset;
CartAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<html class="js cssanimations">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>点餐DEMO</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
        .shop{ position:fixed; bottom:0px; width:100%; height:50px; background:#070f1a;transition: all 0.5s ease 0s;transition: all 0.5s ease 0s;}
        .shop .shopico{ position:relative;width:70px; height:70px; border-radius:50%; float:left;background:#070f1a; margin:-15px 0 0 10px;}
        .shop .shopico i{ width:50px; height:50px; background:url(images/shop.png) no-repeat; background-size:contain; display:inline-block; margin:8px 0 0 10px;}
        .shop .shopprice{ float:left; line-height:50px; font-size:18px; font-weight:bold; color:#FFF; margin-left:10px;}
        .shop_submit{ position:fixed; bottom: 0; right: 0px; height: 50px; background:#00a1d7; float:right; width: 40% color:#FFF; font-size:16px; font-weight:bold; line-height:50px; padding:0 20px;}
        .shop .numspan{ position:absolute; top:-5px; right:5px;width:20px; height:20px; text-align:center; font-size:12px; line-height:20px;color:#FFFF; border-radius:50%;background: -webkit-linear-gradient(left top, #f07c49 , #ff0000); /* Safari 5.1 - 6.0 */background: -o-linear-gradient(bottom right, #f07c49, #ff0000); /* Opera 11.1 - 12.0 */background: -moz-linear-gradient(bottom right, #f07c49, #ff0000); /* Firefox 3.6 - 15 */background: linear-gradient(to bottom right, #f07c49 , #ff0000); /* 标准的语法 */}
        .mask {width: 100%;background: #000;opacity: 0.5;top: 0;height: 100%;display: none;position:fixed;}
        .popup{ position:fixed;width:100%; height:300px; background:#FFF; bottom:-300px;transition: all 0.5s ease 0s;transition: all 0.5s ease 0s;}
        .popup .uptitle{height:40px; line-height:40px; padding:0 15px; border-bottom: solid 1px #f9f9f9;}
        .popup .uptitle span{ font-size:16px; color:#000;}
        .popup .uptitle .tb{height:16px; line-height:20px; font-size:13px; float:right;margin:0;background:url(images/del.png) no-repeat left center; background-size:contain;padding-left:20px; color:#a1a1a1; margin:13px 0 0 0;}
        .popup .uplist{ width:100%; height:270px; overflow-y:scroll;}
        .popup .uplist ul li{ width:100%; height:auto; overflow:hidden; margin:10px 0;}
        .popup .uplist .uppic{ width:80px; height:auto; float:left; margin:10px 10px 10px 15px;}
        .popup .uplist .listtitle{ width:40%;float:left; margin:10px 0 0 0; line-height:25px;}
        .popup .uplist .listtitle h1{ font-size:16px; font-weight:bold; color:#000;}
        .popup .uplist .listtitle h2{ font-size:14px; font-weight:bold; color:#f60002;}
        .popup .uplist .listright{ width:30%; height:auto;float:right;margin:20px 0 0 0;}
        .popup .uplist .listright span{ display:block; width:30px; height:30px; float:left;}
        .popup .uplist .listright p{ width:30px; float:left; font-size:14px; text-align:center; line-height:30px;}
        .addnum{ background:url(images/jiah.png) no-repeat; background-size:contain;}
        .lessnum{ background:url(images/jianh.png) no-repeat; background-size:contain;}
    </style>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>