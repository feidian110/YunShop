<?php
use common\helpers\Html;

$this->title = "用户注册";
?>
<section class="aui-flexView">
            <header class="aui-navBar aui-navBar-fixed b-line">
                <a href="javascript:;" class="aui-navBar-item" onclick="javascript:history.back(-1);">
                    <i class="icon icon-return"></i>
                </a>
                <div class="aui-center">
                    <span class="aui-center-title">注册</span>
                </div>
                <?=Html::a('<i class="icon icon-sys"></i>登录',['login'],['class'=>'aui-navBar-item']);?>
            </header>
            <section class="aui-scrollView">
                <div class="aui-code-box">
                    <form action="">
						<p class="aui-code-line">
						    <input type="text" class="aui-code-line-input" name="username" value="" id="name"  placeholder="请输入用户名"/>
						</p>
                        <p class="aui-code-line">
                            <input type="text" class="aui-code-line-input" name="phone1" value="" id="phone1" autocomplete="off" placeholder="请输入手机号"/>
                        </p>
						<p class="aui-code-line">
						    <input type="text" class="aui-code-line-input" name="email" value="" id="email"  placeholder="请输入邮箱"/>
						</p>
                        <p class="aui-code-line">
                            <input type="password" id="psw" class="aui-code-line-input" placeholder="请输入密码" value="">
                        </p>
						<p class="aui-code-line">
						    <!-- <i class="aui-show  operate-eye-open"></i> -->
						    <input type="password" id="psw_ag" class="aui-code-line-input" placeholder="再次验证密码" value="">
						</p>
                        <!-- <div class="aui-flex-links">
                            <input type="text" placeholder="输入验证码" class="erification-right" name="">

							<button type="button" id="btnSendCode1" class="feachBtn" style="width: 35%;font-size: 13px;">获取验证码</button>
                        </div> -->

                        <div class="aui-code-btn">

							<p style="margin: 0 0 0.625rem 0;font-size: 0.8125rem;">点击 [ 注册 ] 按钮即代表同意<a href="agreement.html" class="agree">《大哥注册协议》</a></p>

                            <button type="button" id="register">注册</button>
                        </div>
                    </form>
                </div>

            </section>
        </section>