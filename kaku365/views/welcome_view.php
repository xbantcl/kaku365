<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>kaku365</title>
		<link href="<?=base_url() ?>static/css/index.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php if (!empty($username)): ?>
		<div id="join">
			<a href="<?=site_url('user/logout')?>">退出</a>
			<a href="<?=site_url('user/index')?>"><?=$username?></a>
		</div>
		<?php else: ?>
		<!--注册登录开始-->
		<div id="join">
        <a href="<?=site_url('user/register')?>">注册</a>
		<a href="<?=site_url('user/login')?>">登陆</a>	
		</div>
		<!--注册登录结束-->
		<?php endif; ?>
		<!--搜索框开始-->
		<div id="key">
			<h1 id="logo">
				<a href="<?=site_url('welcome/index') ?>">
					LOGO
				</a>
			</h1>
			<div id="keyword">
				<form action="<?=site_url('search/index') ?>" method="post">
					<input id="txt" name="string" type="text" placeholder="请输入您要访问的商家"/>
					<input id="sub" type="submit" value="搜&nbsp;索"/>
				</form>
			</div>
		</div>
		<!--搜索框结束-->
		<!--底部信息开始-->
		<div id="footer">
			<p>
				版权所有© 2013  kaku365
				<a href="javascript:alert ('用户协议页面');">
					使用前阅读用户协议
				</a>
			</p>
		</div>
		<!--底部信息结束-->
	</body>
</html>
