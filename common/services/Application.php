<?php
namespace addons\YunShop\common\services;

use common\components\Service;

/**
 * Class Application
 * @package addons\YunShop\common\services
 * @property \addons\YunShop\common\services\shop\ShopService $shop 快店
 */
class Application extends Service
{
    public $childService = [
        'shop' => 'addons\YunShop\common\services\shop\ShopService',
    ];
}