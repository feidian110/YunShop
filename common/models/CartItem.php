<?php

namespace addons\YunShop\common\models;

use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_member_cart_item".
 *
 * @property int $id
 * @property int $merchant_id 商户id
 * @property int $member_id 用户编码
 * @property int $cart_id 购物车编码
 * @property string $product_img 商品快照
 * @property string $product_name 商品名称
 * @property string $price 价格
 * @property int $product_id 商品编码
 * @property int $supplier_id 店铺编码
 * @property int $sku_id 商品sku编码
 * @property string $sku_name 商品sku信息
 * @property int $number 商品数量
 * @property int $status 状态[-1:删除;0:禁用;1启用]
 * @property int $created_at
 * @property int $updated_at
 */
class CartItem extends \common\models\base\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_shop_cart_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['merchant_id', 'member_id', 'cart_id', 'product_id', 'supplier_id', 'sku_id', 'number', 'status', 'created_at', 'updated_at'], 'integer'],
            [['product_img', 'product_name', 'product_id'], 'required'],
            [['price'], 'number'],
            [['product_img', 'product_name', 'sku_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'member_id' => 'Member ID',
            'cart_id' => 'Cart ID',
            'product_img' => 'Product Img',
            'product_name' => 'Product Name',
            'price' => 'Price',
            'product_id' => 'Product ID',
            'supplier_id' => 'Supplier ID',
            'sku_id' => 'Sku ID',
            'sku_name' => 'Sku Name',
            'number' => 'Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
