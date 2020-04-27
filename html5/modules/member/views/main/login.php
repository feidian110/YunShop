<?php
use common\helpers\Html;
$this->title = "用户登录";
?>

<section class="aui-flexView">
    <header class="aui-navBar aui-navBar-fixed b-line">
        <a href="javascript:;" class="aui-navBar-item" onclick="javascript:history.back(-1);">
            <i class="icon icon-return"></i>
        </a>
        <div class="aui-center">
            <span class="aui-center-title">登录</span>
        </div>
        <?= Html::a('<i class="icon icon-sys"></i> 注册',['signup'],['class'=> 'aui-navBar-item']);?>

    </header>
    <section class="aui-scrollView">
        <div class="aui-code-box">
            <form  id="form" onsubmit="return false">
                <p class="aui-code-line">
                    <input type="text" class="aui-code-line-input" value="" name="account" id="account" autocomplete="off" placeholder="请输入手机号/邮箱/用户名"/>
                </p>
                <p class="aui-code-line aui-code-line-clear">

                    <i class="aui-show  operate-eye-open"></i>
                    <input type="password" class="aui-code-line-input password" name="password" id="password" placeholder="密码" value="">
                </p>
                <div class="aui-flex-links">
                    <!-- <a href="javascript:;">
                         <label class="cell-right">
                             <input type="checkbox" value="1" name="checkbox">
                             <i class="cell-checkbox-icon"></i>记住密码
                         </label>
                     </a> -->
                    <a href="javascript:;">忘记密码?</a>
                </div>
                <div class="aui-code-btn">
                    <button id="login_btu">登录</button>
                </div>
            </form>
        </div>
        <div class="aui-login-line">
            <h2>第三方登录</h2>
        </div>
        <div class="aui-login-armor">
            <a href="javascript:;" class="aui-tabBar-item">
                <img src="/html5/resources/img/icon-sin-001.png" alt="">
            </a>
            <a href="javascript:;" class="aui-tabBar-item">
                <img src="/html5/resources/img/icon-sin-002.png" alt="">
            </a>
            <a href="javascript:;" class="aui-tabBar-item">
                <img src="/html5/resources/img/icon-sin-003.png" alt="">
            </a>
        </div>
    </section>
</section>
