<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>欢迎注册</title>
    <link href="<?=base_url() ?>static/css/basic.css" rel="stylesheet" type="text/css">
    <script src="/static/js/jquery-1.11.1.min.js"></script>
    <script src="<?=base_url() ?>static/js/basic.js"></script>
</head>
<body>
<!--头部信息开始-->
<div id="header">
    <h1 title="返回首页"><a href="<?=site_url('welcome/index')?>">LOGO</a></h1>
    <div id="header_key">
        <form action="<?=site_url('search/index') ?>" method="post">
            <input id="key_text" name="string" type="text" value="输入您要去的店铺"/>
            <input id="key_sub" type="submit" value="搜&nbsp;索"/>
        </form>
    </div>
</div>
<!--头部信息结束-->
<!--登陆窗口开始-->
<div class="login">
    我已经注册，现在<a href="<?=site_url('shop_user/login') ?>">登录</a>
</div>
<div class="register">
    <form class="register" action="<?=site_url('shop_user/register') ?>" method="post">
        <h2>商家注册信息</h2>
        <ul>
            <li><strong>用户账号：</strong><input required  id="username" name="username" type="text" class="regName" minlength="4" maxlength="20"  placeholder="登录帐号"/><span id="error_username">4-20位字母，数字组合</span></li>
            <li><strong>设置密码：</strong><input required id="password" name="password" type="password" class="regPassword" minlength="6" maxlength="20" placeholder="登录密码"/><span>6-20位字符，建议由字母，数字和符号两种以上组合</span></li>
            <li><strong>确认密码：</strong><input required id="s_password" name="s_password" type="password"  class="regPassword" maxlength="20" onblur="check_pwd()" placeholder="确认密码"/><span id="error_s_password">请再次输入密码</span></li>
            <li><strong>手机号码：</strong><input required name="phone" type="text" class="regPine" minlength="11" maxlength="11" placeholder="手机号码"/><span>完成验证后可用该手机号登陆和找回密码</span></li>
            <!--<li><strong>短信验证：</strong><input required name="captcha" type="text" id="regSMS" placeholder="验证码"/><a href="javascript:;">获取短信验证码</a></li>-->
            <li><strong>验 证 码：&nbsp;&nbsp;</strong><input style="vertical-align:middle;" required name="captcha" type="text" id="regSMS" placeholder="验证码"/>
                <img style="vertical-align:middle;" src="<?php echo site_url('shop_user/captcha'); ?>" onclick= this.src="<?php echo site_url('shop_user/captcha').'/'?>"+Math.random() style="cursor: pointer; margin-top: 10px;"/>
            </li>
        </ul>
        <div class="reg_sub"><input id="register_sub" type="submit" value="立即注册"/></div>
    </form>
</div>
<!--底部信息开始-->
<div id="footer">
    <p>版权所有© 2013  kaku365<a href="javascript:alert ('用户协议页面');">使用前阅读用户协议</a></p>
    <p>
        <a href="javascript:alert ('证件照片');">kaku365广告有限公司管理运营</a>|
        <a href="javascript:alert ('空');">企业注册号 511011000019348</a>|
        <a href="javascript:alert ('证件照片');">组织机构代码 56762831-7</a>|
        <a href="javascript:alert ('证件照片');">蜀ICP备13003878号-1</a>
    </p>
</div>
<!--底部信息结束-->
</body>
</html>
