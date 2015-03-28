<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			kaku365
		</title>
		<link href="/static/css/basic.css" rel="stylesheet">
		<link href="/static/css/search.css" rel="stylesheet">
	</head>
	<body>
		<?php require_once ('common/common_header.php'); ?>
		<!--搜索结果开始-->
		<h2>
			搜索结果：
		</h2>
		<div id="search_content">
			<?php if(empty($shop)):?>
				<h1>您访问的商家暂时未加入kaku365...</h1>
			<?php endif;?>
			<?php foreach ($shop as $s): ?>
			<dl>
				<dt>
					<a href="<?=site_url('shop/index').'/'.$s['id']?>">
						<img src="<?=$s['img_path']?>"/>
					</a>
				</dt>
				<dd>
					<b>店名：</b><span>
						<a href="<?=site_url('shop/index').'/'.$s['id']?>">
							<?=$s['name']?>
						</a></span>
				</dd>
				<dd>
					<b>电话：</b><span><?=$s['telephone']?></span>
				</dd>
				<dd>
					<b>地址：</b><span><?=$s['address']?></span>
				</dd>
				<dd>
					<b>介绍：</b>
					<p><?=$s['introduce'] ?></p>
				</dd>
			</dl>
			<?php endforeach; ?>
			<!--页码跳转开始-->
			<div id="page_btn">
				<?=$page ?>
			</div>
			<!--页码跳转结束-->
		</div>
		<!--搜索结果结束-->
	</body>
</html>
