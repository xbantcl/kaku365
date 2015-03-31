<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>欢迎登录</title>
    <link href="/static/css/basic.css" rel="stylesheet" type="text/css">
</head>
<body>
<!--头部信息开始-->
<div id="header">
    <h1 title="返回首页"><a href="<?=site_url('welcome/index') ?>">LOGO</a></h1>
    <div id="header_key">
        <form action="<?=site_url('search/index') ?>" method="post">
            <input id="key_text" name="string" type="text" value="输入您要去的店铺"/>
            <input id="key_sub" type="submit" value="搜&nbsp;索"/>
        </form>
    </div>
</div>
<!--头部信息结束-->
<div class="login">
    我还未注册，现在<a href="<?=site_url('shop_user/register') ?>"> 注册</a>
</div>
<!--登陆窗口开始-->
<div class="register">
    <form action="<?=site_url('shop_user/login') ?>" method="post">
        <h2>商家登录</h2>
        <ul>
            <li class="member_login"><strong>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：&nbsp;&nbsp;</strong><input required name="username" type="text" class="regName" maxlength="20"  placeholder="登录帐号"/></li>
            <li class="member_login"><strong>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：&nbsp;&nbsp;</strong><input required name="password" type="password" class="regPassword" maxlength="20" placeholder="登录密码"/></li>
            <li class="member_login"><strong>验 证 码：&nbsp;&nbsp;</strong><input style="vertical-align:middle;" required name="captcha" type="text" id="regSMS" placeholder="验证码"/>
                <img style="vertical-align:middle;" src="<?php echo site_url('shop_user/captcha'); ?>" onclick= this.src="<?php echo site_url('shop_user/captcha').'/'?>"+Math.random() style="cursor: pointer; margin-top: 10px;"/>
            </li>
        </ul>
        <div class="reg_sub">
            <input id="register_sub" type="submit" value="登 录"/>
        </div>
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
