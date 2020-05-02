<?php

namespace addons\YunShop\common\models\order;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_order_product".
 *
 * @property int $id 订单项ID
 * @property int $order_id 订单ID
 * @property int $member_id 用户id
 * @property int $merchant_id 店铺ID
 * @property string $store_id 门店ID
 * @property int $product_id 商品ID
 * @property string $product_name 商品名称
 * @property int $sku_id skuID
 * @property string $sku_name sku名称
 * @property string $price 商品价格
 * @property string $cost_price 商品成本价
 * @property int $num 购买数量
 * @property string $adjust_money 调整金额
 * @property string $product_money 商品总价
 * @property string $product_picture 商品图片
 * @property int $buyer_id 购买人ID
 * @property int $point_exchange_type 积分兑换类型0.非积分兑换1.积分兑换
 * @property string $product_virtual_group 虚拟商品类型
 * @property int $marketing_id 促销ID
 * @property string $marketing_type 促销类型
 * @property int $order_type 订单类型
 * @property int $order_status 订单状态
 * @property int $give_point 积分数量
 * @property int $shipping_status 物流状态
 * @property int $refund_type 退款方式
 * @property string $refund_require_money 退款金额
 * @property string $refund_reason 退款原因
 * @property string $refund_shipping_code 退款物流单号
 * @property string $refund_shipping_company 退款物流公司名称
 * @property string $refund_real_money 实际退款金额
 * @property int $refund_status 退款状态
 * @property int $refund_time 退款时间
 * @property string $memo 备注
 * @property int $is_evaluate 是否评价 0为未评价 1为已评价 2为已追评
 * @property string $refund_balance_money 订单退款余额
 * @property string $tmp_express_company 批量打印时添加的临时物流公司
 * @property int $tmp_express_company_id 批量打印时添加的临时物流公司id
 * @property string $tmp_express_no 批量打印时添加的临时订单编号
 * @property int $gift_flag 赠品标识，0:不是赠品，大于0：赠品id
 * @property int $is_customer 是否售后 1:申请了售后;0:未申请
 * @property int $is_virtual 是否包含 虚拟商品   0 不包含  1  包含
 * @property int $is_open_commission 是否支持分销
 * @property int $status 状态[-1:删除;0:禁用;1启用]
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_shop_order_product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'member_id', 'merchant_id', 'store_id', 'product_id', 'sku_id', 'num', 'buyer_id', 'point_exchange_type', 'marketing_id', 'order_type', 'order_status', 'give_point', 'shipping_status', 'refund_type', 'refund_status', 'refund_time', 'is_evaluate', 'tmp_express_company_id', 'gift_flag', 'is_customer', 'is_virtual', 'is_open_commission', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price', 'cost_price', 'adjust_money', 'product_money', 'refund_require_money', 'refund_real_money', 'refund_balance_money'], 'number'],
            [['product_name', 'product_picture'], 'string', 'max' => 100],
            [['sku_name', 'product_virtual_group', 'marketing_type', 'tmp_express_no'], 'string', 'max' => 50],
            [['refund_reason', 'refund_shipping_code', 'refund_shipping_company', 'memo', 'tmp_express_company'], 'string', 'max' => 200],
        ];
    }

    public function create($data)
    {
        $p =  \addons\YunStore\common\models\product\Product::findOne(['id'=>$data['product_id'],'store_id'=>$data['store_id']]);

        $this->product_id = $data['product_id'];
        $this->product_money = $data['product_money'];
        $this->buyer_id = $data['buyer_id'];
        $this->merchant_id = $data['merchant_id'];
        $this->store_id = $data['store_id'];
        $this->order_id = $data['order_id'];
        $this->product_name = $p['name'];
        $this->num = $data['num'];
        $this->price = $p['price'];
        $this->product_picture =$p['picture'];
        $this->cost_price = $p['cost_price'];

        if($this->save()){
            return true;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'member_id' => 'Member ID',
            'merchant_id' => 'Merchant ID',
            'store_id' => 'Store ID',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'sku_id' => 'Sku ID',
            'sku_name' => 'Sku Name',
            'price' => 'Price',
            'cost_price' => 'Cost Price',
            'num' => 'Num',
            'adjust_money' => 'Adjust Money',
            'product_money' => 'Product Money',
            'product_picture' => 'Product Picture',
            'buyer_id' => 'Buyer ID',
            'point_exchange_type' => 'Point Exchange Type',
            'product_virtual_group' => 'Product Virtual Group',
            'marketing_id' => 'Marketing ID',
            'marketing_type' => 'Marketing Type',
            'order_type' => 'Order Type',
            'order_status' => 'Order Status',
            'give_point' => 'Give Point',
            'shipping_status' => 'Shipping Status',
            'refund_type' => 'Refund Type',
            'refund_require_money' => 'Refund Require Money',
            'refund_reason' => 'Refund Reason',
            'refund_shipping_code' => 'Refund Shipping Code',
            'refund_shipping_company' => 'Refund Shipping Company',
            'refund_real_money' => 'Refund Real Money',
            'refund_status' => 'Refund Status',
            'refund_time' => 'Refund Time',
            'memo' => 'Memo',
            'is_evaluate' => 'Is Evaluate',
            'refund_balance_money' => 'Refund Balance Money',
            'tmp_express_company' => 'Tmp Express Company',
            'tmp_express_company_id' => 'Tmp Express Company ID',
            'tmp_express_no' => 'Tmp Express No',
            'gift_flag' => 'Gift Flag',
            'is_customer' => 'Is Customer',
            'is_virtual' => 'Is Virtual',
            'is_open_commission' => 'Is Open Commission',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
