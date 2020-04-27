<?php
namespace addons\YunShop\common\services\shop;

use addons\YunShop\common\models\Shop;
use common\components\Service;
use common\enums\StatusEnum;
use Yii;

class ShopService extends Service
{
    public function getDropDown()
    {
        $store = Yii::$app->yunStoreService->store->getAllData();
        $shop = $this->findAllData();

        $tr = $this->DelValue($store,$shop);
        var_dump($tr);
    }

    public function DelValue($arr,$id)
    {
        foreach ($arr as $key=>$value){
            if($value==$id||$value==""){
                return false;
            }
            return true;
        }
    }

    public function findAllData()
    {
        return Shop::find()->select('id,store_id,merchant_id')
            ->where(['merchant_id'=>$this->getMerchantId()])
            ->andWhere(['>=','status',StatusEnum::ENABLED])
            ->asArray()->all();
    }
}