<?php
$this->title = '本店已打烊';

use addons\YunStore\common\models\Store;
$time = Store::findOne( ['id'=>$store_id] )['hours'];
?>
<style>
    .close-img{
        width: 100%;
        height: 100px;
        text-align: center;
    }
    .img{
        padding-top: 100px;
    }
    .time{
        padding-top: 20px;
    }
    .time .title{
        height: 25px;
    }
    .time text{
        padding-top: 3px;
    }
</style>
<div class="close-img">
    <div class="img">
        <img src="images/close.png" style="width: 200px;" >
    </div>
    <div class="text"><?= $message;?></div>

    <div class="time">
        <div class="title">营业时间：</div>
        <div class="text"><?=$time['open_time_one'];?> - <?=$time['close_time_one'];?></div>
        <?php if( $time['open_time_two'] != '00:00:00' || $time['close_time_two'] != "00:00:00" ):?>
            <div class="text"><?=$time['open_time_two'];?> - <?=$time['close_time_two'];?></div>
        <?php else:?>
        <?php endif;?>
        <?php if( $time['open_time_three'] != '00:00:00' || $time['close_time_three'] != "00:00:00" ):?>
            <div class="text"><?=$time['open_time_three'];?> - <?=$time['close_time_three'];?></div>
        <?php else:?>
        <?php endif;?>
    </div>
</div>


