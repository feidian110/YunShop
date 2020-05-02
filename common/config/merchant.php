<?php

return [

    // ----------------------- 菜单配置 ----------------------- //
    'config' => [
        // 菜单配置
        'menu' => [
            'location' => 'addons', // default:系统顶部菜单;addons:应用中心菜单
            'icon' => 'fa fa-puzzle-piece',
        ],
        // 子模块配置
        'modules' => [
            'shop' => [
                'class' => 'addons\YunShop\merchant\modules\shop\Module',
            ],
            'product' => [
                'class' => 'addons\YunShop\merchant\modules\product\Module',
            ],
            'order' => [
                'class' => 'addons\YunShop\merchant\modules\order\Module',
            ],
        ],
    ],

    // ----------------------- 快捷入口 ----------------------- //

    'cover' => [

    ],

    // ----------------------- 菜单配置 ----------------------- //

    'menu' => [
        [
            'title' => '快店管理',
            'route' => 'main/index',
            'icon' => 'fa fa-heart',
        ],

    ],

    // ----------------------- 权限配置 ----------------------- //

    'authItem' => [
        [
            'title' => '所有权限',
            'name' => '*',
        ],
    ],
];