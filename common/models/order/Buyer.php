<?php

namespace addons\YunShop\common\models\order;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_order_buyer".
 *
 * @property string $id 主键
 * @property string $order_id 订单编号
 * @property string $buyer_id 买家会员ID
 * @property string $buyer_username 买家用户名
 * @property string $buyer_ip 买家IP
 * @property string $receiver_name 收货人姓名
 * @property string $receiver_mobile 收货人手机号码
 * @property int $province_id 省份
 * @property int $city_id 城市
 * @property int $area_id 区域
 * @property string $address 收货人地址
 * @property string $region_address 收货人详细地址
 * @property int $zip 邮政编码
 * @property string $merchant_id 商户ID
 * @property string $store_id 门店D
 * @property int $created_at 创建时间
 * @property int $updated_at 最后更新时间
 */
class Buyer extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_shop_order_buyer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'buyer_id', 'province_id', 'city_id', 'area_id', 'zip', 'merchant_id', 'store_id', 'created_at', 'updated_at'], 'integer'],
            [['buyer_username'], 'string', 'max' => 64],
            [['buyer_ip', 'receiver_mobile'], 'string', 'max' => 20],
            [['receiver_name'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 100],
            [['region_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'buyer_id' => 'Buyer ID',
            'buyer_username' => 'Buyer Username',
            'buyer_ip' => 'Buyer Ip',
            'receiver_name' => 'Receiver Name',
            'receiver_mobile' => 'Receiver Mobile',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'area_id' => 'Area ID',
            'address' => 'Address',
            'region_address' => 'Region Address',
            'zip' => 'Zip',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
