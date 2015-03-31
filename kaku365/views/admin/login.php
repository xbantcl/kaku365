<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			后台登陆页面
		</title>
		<link href="/static/css/basic.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!--头部信息开始-->
		<div id="header">
			<h1 title="返回首页">
				<a href="<?=site_url('welcome/index') ?>">
					LOGO
				</a>
			</h1>
			<div id="header_key">
				<form action="<?=site_url('search/index') ?>" method="post">
					<input id="key_text" name="string" type="text" value="输入您要去的店铺"/>
					<input id="key_sub" type="submit" value="搜&nbsp;索"/>
				</form>
			</div>
		</div>
		<!--头部信息结束-->
		<!--登陆窗口开始-->
		<div class="register">
			
			<form method="post" id="form_login" action="<?php echo site_url('admin/login'); ?>">
				<ul>
					<h1>管理员登陆</h1>
					<li>
						<strong>账&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：&nbsp;&nbsp;</strong>
						<input id="user_name" name="user_name" class="regName" autocomplete="off" type="text" >
					</li>
					<li>
						<strong>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码：&nbsp;&nbsp;</strong>
						<input name="password" id="password" class="regPassword" autocomplete="off"  type="password">
					</li>
			        <li><strong>验&nbsp;证&nbsp;码：&nbsp;&nbsp;&nbsp;</strong><input style="vertical-align:middle;" required name="captcha" type="text" id="regSMS" placeholder="验证码"/>
                        <img style="vertical-align:middle;" src="<?php echo site_url('admin/code'); ?>" onclick= this.src="<?php echo site_url('admin/code').'?'?>"+Math.random() style="cursor: pointer; margin-top: 10px;"/>
                    </li>
					<li>
						<input name="nchash" type="hidden" value="6174127b" />
						<input id="register_sub" value="登陆" type="submit"/>
					</li>
				</ul>
			</form>
		</div>
		<!--底部信息开始-->
		<div id="footer">
			<p>
				版权所有© 2013  kaku365
				<a href="javascript:alert ('用户协议页面');">
					使用前阅读用户协议
				</a>
			</p>
			<p>
				<a href="javascript:alert ('证件照片');">
					kaku365广告有限公司管理运营
				</a>|
				<a href="javascript:alert ('空');">
					企业注册号 511011000019348
				</a>|
				<a href="javascript:alert ('证件照片');">
					组织机构代码 56762831-7
				</a>|
				<a href="javascript:alert ('证件照片');">
					蜀ICP备13003878号-1
				</a>
			</p>
		</div>
		<!--底部信息结束-->
	</body>
</html>