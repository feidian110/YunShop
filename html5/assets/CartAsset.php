<?php


namespace addons\YunShop\html5\assets;


use yii\web\AssetBundle;

class CartAsset extends AssetBundle
{
    public $sourcePath = '@addons/YunShop/html5/resources/';

    public $css = [
    ];

    public $js = [
        'shop/plugins/layer/layer.js',
        'shop/js/common.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}