<?php


namespace addons\YunShop\html5\assets;


use yii\web\AssetBundle;

class OrderAsset extends AssetBundle
{
    public $sourcePath = '@addons/YunShop/html5/resources/order';

    public $css = [
        'css/bootstrap.min.css',
        'css/style.css',
        'css/iconfont/iconfont.css'
    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}