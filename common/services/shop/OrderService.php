<?php
namespace addons\YunShop\common\services\shop;


use addons\YunShop\common\models\order\Order;
use addons\YunShop\common\models\order\Product;
use common\components\Service;
use Yii;

class OrderService extends Service
{
    /**
     * 获取订单商品价格未调整前的合计总价
     * @param $orderId
     * @param $storeId
     * @return mixed
     */
    public function getProductTotalByOrderId($orderId,$storeId)
    {
        $sum = Product::find()
            ->where(['merchant_id'=>Yii::$app->services->merchant->getId()])
            ->andWhere(['store_id'=>$storeId])
            ->andWhere(['order_id'=>$orderId])
            ->sum('product_money');
        return $sum;
    }

}