<?php
namespace addons\YunShop\common\services\cart;

use addons\YunShop\common\models\CartItem;
use common\components\Service;
use common\enums\StatusEnum;
use Yii;

class CartItemService extends Service
{

    /**
     * 计算快店购物车物品总数量
     * @param $store_id
     * @return int|string
     */
    public function getCartItemCount($store_id)
    {
        $count = CartItem::find()
            ->where(['store_id'=>$store_id])
            ->andWhere(['member_id'=>Yii::$app->user->getId()])
            ->andWhere(['status'=>StatusEnum::ENABLED])
            ->sum('number');
        return $count;
    }

    /**
     * 计算快店购物车物品总价格
     * @param $store_id
     * @return mixed
     */
    public function getCartItemTotal($store_id)
    {
        $sum = CartItem::find()
            ->where(['store_id'=>$store_id])
            ->andWhere(['member_id'=>Yii::$app->user->getId()])
            ->andWhere(['status'=>StatusEnum::ENABLED])
            ->sum('price');
        return $sum;
    }

    /**
     * 获取某件商品在购物车的数量是多少
     * @param $store_id
     * @param $product_id
     * @return mixed
     */
    public function findProductCountByCart($store_id,$product_id)
    {
        $product =CartItem::find()->where(['store_id'=>$store_id,'product_id'=>$product_id])
            ->andWhere(['member_id'=>Yii::$app->user->getId(),'status'=>StatusEnum::ENABLED])
            ->one();
        return $product['number'] ?? 0;
    }

}