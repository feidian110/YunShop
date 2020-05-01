<?php

namespace addons\YunShop\common\models\order;

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
 * @property int $shippin_status 订单状态
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
            [['merchant_id', 'store_id', 'buyer_id', 'shipping_type', 'order_from', 'pay_time', 'shippin_status', 'order_status', 'review_status', 'feedback_status', 'pay_status', 'shipping_time', 'sign_time', 'consign_time', 'finish_time', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['product_total_price', 'order_price', 'shipping_price', 'order_pay'], 'number'],
            [['order_sn'], 'string', 'max' => 64],
            [['payment'], 'string', 'max' => 30],
            [['message'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_sn' => 'Order Sn',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'buyer_id' => 'Buyer ID',
            'payment' => 'Payment',
            'shipping_type' => 'Shipping Type',
            'order_from' => 'Order From',
            'message' => 'Message',
            'product_total_price' => 'Product Total Price',
            'order_price' => 'Order Price',
            'shipping_price' => 'Shipping Price',
            'order_pay' => 'Order Pay',
            'pay_time' => 'Pay Time',
            'shippin_status' => 'Shippin Status',
            'order_status' => 'Order Status',
            'review_status' => 'Review Status',
            'feedback_status' => 'Feedback Status',
            'pay_status' => 'Pay Status',
            'shipping_time' => 'Shipping Time',
            'sign_time' => 'Sign Time',
            'consign_time' => 'Consign Time',
            'finish_time' => 'Finish Time',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
