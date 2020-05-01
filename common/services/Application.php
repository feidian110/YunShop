<?php
namespace addons\YunShop\common\services;

use common\components\Service;

/**
 * Class Application
 * @package addons\YunShop\common\services
 * @property \addons\YunShop\common\services\shop\ShopService $shop 快店
 * @property \addons\YunShop\common\services\cart\CartItemService  $cartShop 快点购物车
 */
class Application extends Service
{
    public $childService = [
        'shop' => 'addons\YunShop\common\services\shop\ShopService',
        'cartShop' => 'addons\YunShop\common\services\cart\CartItemService',
    ];
}