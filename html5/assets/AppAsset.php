<?php

namespace addons\YunShop\html5\assets;

use yii\web\AssetBundle;

/**
 * 静态资源管理
 *
 * Class AppAsset
 * @package addons\YunShop\html5\assets
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@addons/YunShop/html5/resources/';

    public $css = [
        'shop/css/hui.css',
        'shop/css/login.css',

    ];

    public $js = [
        'shop/js/hui.js',
        'shop/js/common.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}