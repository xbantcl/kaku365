<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			<?=$Goods['name'].'-'.$shop['name'];?>
		</title>
		<link href="/static/css/basic.css" rel="stylesheet">
		<link href="/static/css/big_img.css" rel="stylesheet">
		<link href="/static/css/simple.css" rel="stylesheet">
		<script src="/static/js/jquery-1.11.1.min.js"></script>
		<script src="/static/js/basic.js"></script>
		<script src="/static/js/cart.js"></script>
	</head>
	<body>
		<?php require_once (dirname(__FILE__).'/../common/common_header.php'); ?>
		<!--店招店内图片展示开始-->
		<?php require_once (dirname(__FILE__).'/../common/shop_adv_div.php'); ?>
		<!--店招店内图片展示结束-->
		<?php if(!empty($category)):?>
        <!--导航条开始-->
		<?php require_once (dirname(__FILE__).'/../shop/shop_nav_div.php');?>
		<!--导航条结束-->
        <?php endif; ?>
		<!--产品信息开始-->
		<!--下级分类导航开始--> 
        <?php require_once (dirname(__FILE__).'/../shop/sub_menu_div.php');?>
        <!--下级分类导航结束-->
        <!--产品信息开始-->
		<?php require_once ('goods_info.php'); ?>
		<!--产品信息结束-->
		<!--底部信息开始-->
		<?php require_once (dirname(__FILE__).'/../common/common_footer.php'); ?>
		<!--底部信息结束-->
	</body>
</html>
