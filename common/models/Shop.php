<?php

namespace addons\YunShop\common\models;

use addons\YunStore\common\models\Store;
use common\behaviors\MerchantBehavior;
use common\models\merchant\Merchant;
use Yii;

/**
 * This is the model class for table "yun_net_addon_yun_shop_shop".
 *
 * @property string $id 主键
 * @property string $merchant_id 所属商户
 * @property string $store_id 关联门店
 * @property string $notice 门店公告
 * @property int $open_pick 开启自提点【0:关闭，1:开启】
 * @property string $category_id 分类
 * @property int $delivery_method 配送方式[0:客户自提1:商户配送2:]
 * @property int $emergency_shutdown 紧急关店[0:关闭1:开启]
 * @property string $closing_reason 关店原因
 * @property int $offline_retail 线下零售[0:关闭:1:开启]
 * @property string $live_video 视频直播地址
 * @property int $level_cate 开启多级分类[0:关闭1:开启]
 * @property int $offline_packing 开启线下零售打包费[0:关闭1:开启]
 * @property int $draw_bill 开发票[0:不支持1:支持]
 * @property string $satisfy_billing 满足多少元可开发票
 * @property string $issuing_time 出单时长
 * @property int $issuing_time_type 出单时间类型[0:分钟1:小时2:天3:周4:月]
 * @property string $package_alias 包装费别名
 * @property string $freight_alias 运费别名
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class Shop extends \common\models\base\BaseModel
{
    use MerchantBehavior;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_yun_shop_shop}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id'], 'required'],
            [['merchant_id', 'store_id', 'open_pick', 'delivery_method', 'emergency_shutdown', 'offline_retail', 'level_cate', 'offline_packing', 'draw_bill', 'issuing_time_type', 'created_at', 'updated_at'], 'integer'],
            [['satisfy_billing'], 'number'],
            [['notice'], 'string', 'max' => 100],
            [['category_id'], 'string', 'max' => 2000],
            [['closing_reason'], 'string', 'max' => 50],
            [['live_video'], 'string', 'max' => 300],
            [['issuing_time'], 'string', 'max' => 10],
            [['package_alias', 'freight_alias'], 'string', 'max' => 30],
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
            'store_id' => '所属门店',
            'notice' => '门店公告',
            'open_pick' => '配送自提点',
            'category_id' => 'Category ID',
            'delivery_method' => '配送方式',
            'emergency_shutdown' => '紧急关店',
            'closing_reason' => '关店原因',
            'offline_retail' => '线下零售',
            'live_video' => '视频直播地址',
            'level_cate' => '多级分类',
            'offline_packing' => '线下零售打包费',
            'draw_bill' => '开发票',
            'satisfy_billing' => '满*开发票',
            'issuing_time' => '出单时长',
            'issuing_time_type' => '出单时间类型',
            'package_alias' => '包装费别名',
            'freight_alias' => '运费别名',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getMerchant()
    {
        return $this->hasOne( Merchant::class,['id'=>'merchant_id'] );
    }

    public function getStore()
    {
        return $this->hasOne( Store::class,['id'=> 'store_id'] );
    }
}
