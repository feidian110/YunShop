<?php

namespace addons\YunShop\common\models\order;

use addons\YunStore\common\models\Pick;
use addons\YunStore\common\models\Store;
use common\helpers\StringHelper;
use common\models\member\Member;
use common\models\merchant\Merchant;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_order".
 *
 * @property string $id 主键
 * @property string $order_sn 订单编号
 * @property string $merchant_id 商家编号
 * @property string $store_id 门店编号
 * @property string $buyer_id 买家编号
 * @property string $payment 支付方式
 * @property int $shipping_type 配送方式
 * @property int $order_from 订单来源
 * @property string $message 买家留言
 * @property string $product_total_price 商品合计金额
 * @property string $order_price 订单金额
 * @property string $shipping_price 运费
 * @property string $order_pay 订单实付金额
 * @property int $pay_time 支付时间
 * @property int $shipping_status 订单状态
 * @property int $order_status 订单状态
 * @property int $review_status 评价状态
 * @property int $feedback_status 维权状态
 * @property int $pay_status 支付状态
 * @property int $shipping_time 买家要求配送时间
 * @property int $sign_time 签收时间
 * @property int $consign_time 卖家发货时间
 * @property int $finish_time 完成时间
 * @property int $sort 排序
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Order extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_shop_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pick_id','pick_name', 'pick_mobile'], 'required'],
            [['merchant_id', 'store_id', 'buyer_id', 'shipping_type', 'order_from', 'pay_time', 'shipping_status', 'order_status', 'review_status', 'feedback_status', 'pay_status', 'shipping_time', 'sign_time', 'consign_time', 'finish_time', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['product_total_price', 'order_price', 'shipping_price', 'order_pay'], 'number'],
            [['order_sn'], 'string', 'max' => 64],
            [['payment'], 'string', 'max' => 30],
            [['message'], 'string', 'max' => 200],
        ];
    }

    public function create($data)
    {
        $this->order_sn= date('YmdHis') .$data['Order']['merchant_id'].$data['Order']['store_id']. StringHelper::random(10, true);
        $this->buyer_id = Yii::$app->user->getId();
        if( $this->load($data) && $this->save() ){
            return true;
        }
    }


    public function getMerchant()
    {
        return $this->hasOne( Merchant::class,['id'=>'merchant_id'] );
    }

    public function getStore()
    {
        return $this->hasOne( Store::class,['id'=>'store_id'] );
    }

    public function getPick()
    {
        return $this->hasOne( Pick::class,['id'=>'pick_id'] );
    }

    public function getProfile()
    {
        return $this->hasMany( Product::class,['order_id'=>'id'] );
    }

    public function getBuyer()
    {
        return $this->hasOne( Member::class,['id'=>'buyer_id'] );
    }

    public function getConsignee()
    {
        return $this->hasOne( Buyer::class,['order_id'=> 'id'] );
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_sn' => '订单编号',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'buyer_id' => 'Buyer ID',
            'payment' => '实付方式',
            'shipping_type' => '配送方式',
            'order_from' => '订单来源',
            'message' => '买家留言',
            'product_total_price' => '商品合计',
            'order_price' => '订单金额',
            'shipping_price' => '配送费用',
            'order_pay' => 'Order Pay',
            'pay_time' => '支付时间',
            'shipping_status' => '配送状态',
            'order_status' => '订单状态',
            'review_status' => 'Review Status',
            'feedback_status' => 'Feedback Status',
            'pay_status' => '支付状态',
            'shipping_time' => '配送时间',
            'sign_time' => '签收时间',
            'consign_time' => 'Consign Time',
            'finish_time' => '完成时间',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'pick_name' => '提货人姓名',
            'pick_mobile' => '提货人电话',
        ];
    }
}
