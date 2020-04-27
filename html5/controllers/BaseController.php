<?php

namespace addons\YunShop\html5\controllers;

use common\behaviors\ActionLogBehavior;
use common\traits\BaseAction;
use Yii;
use common\controllers\AddonsController;

/**
 * 默认控制器
 *
 * Class DefaultController
 * @package addons\YunShop\html5\controllers
 */
class BaseController extends AddonsController
{
    use BaseAction;
    /**
    * @var string
    */
    public $layout = "@addons/YunShop/html5/views/layouts/main";

    public function behaviors()
    {
        return [
            'actionLog' => [
                'class' => ActionLogBehavior::class
            ]
        ];
    }
}