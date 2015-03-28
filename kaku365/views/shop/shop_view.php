<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?=$shop['name']?>-kaku365</title>
		<link href="/static/css/basic.css" rel="stylesheet">
		<link href="/static/css/shop.css" rel="stylesheet">
        <link href="/static/css/simple.css" rel="stylesheet">
		<script src="/static/js/jquery-1.11.1.min.js"></script>
		<script src="/static/js/basic.js"></script>
	</head>
	<body>
		<!--kaku365顶部搜索层开始.-->
		<?php require_once (dirname(__FILE__).'/../common/common_header.php'); ?>
		<!--kaku365顶部搜索层结束-->
		<!--店招店内图片展示开始-->
		<?php require_once (dirname(__FILE__).'/../common/shop_adv_div.php'); ?>
		<!--店招店内图片展示结束-->
        <?php if(!empty($category)):?>
        <!--导航条开始-->
        <?php require_once ('shop_nav_div.php');?>
        <!--导航条结束-->
        <?php endif; ?>
        <?php if(empty($category)) echo "<div id=\"br\"></div>";?>
        <!--下级分类导航开始--> 
        <?php require_once ('sub_menu_div.php');?>
        <!--下级分类导航结束--> 
		<!--商品展示栏开始-->
		<?php require_once ('shop_product_div.php'); ?>
		<!--商品展示栏结束-->
		<!--底部信息开始-->
		<?php require_once (dirname(__FILE__).'/../common/common_footer.php'); ?>
		<!--底部信息结束-->
	</body>
</html>
