<div id="header">
	<h1 title="返回首页"><a href="<?=site_url('search/index')?>" target="_blank">LOGO</a></h1>
	<div id="header_key">
		<form action="<?=site_url('search/index') ?>" method="post">
			<input id="key_text" name="string" type="text" placeholder="输入您要去的店铺"/>
			<input id="key_sub" type="submit" value="搜索"/>
		</form>
	</div>
    <span>
		<?php if(isset($user)):?>
		<a href="<?=site_url('user/index')?>"><?=$user->username?></a>|
		<a href="<?=site_url('user/logout')?>">退出</a>
		<?php else:?>
		<a href="<?=site_url('user/login')?>">登陆</a>|
		<a href="<?=site_url('user/register')?>">注册</a>
		<?php endif;?>
     </span>
</div>