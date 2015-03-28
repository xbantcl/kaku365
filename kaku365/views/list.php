<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?=$shop['name']?>-kaku365</title>
		<link href="/static/css/basic.css" rel="stylesheet">
        <link href="/static/css/big_img.css" rel="stylesheet">
        <link href="/static/css/shop.css" rel="stylesheet">
		<link href="/static/css/list.css" rel="stylesheet">
		<link href="/static/css/simple.css" rel="stylesheet">
		<script src="/static/js/jquery-1.11.1.min.js"></script>
        <script src="/static/js/jquery.artDialog.min.js"></script>
		<script src="/static/js/basic.js"></script>
	</head>
<body>
	<!--kaku365顶部搜索层开始-->
	<?php require_once ('common/common_header.php'); ?>
	<!--kaku365顶部搜索层结束-->
	<!--店招店内图片展示开始-->
	<?php require_once ('common/shop_adv_div.php'); ?>
	<!--店招店内图片展示结束-->
	<!--导航条开始-->
    <?php if(!empty($category)):?>
    <?php require_once ('shop/shop_nav_div.php');?>   
    <?php endif; ?>
    <!--导航条结束-->
	<!--下级分类导航开始--> 
    <?php require_once ('shop/sub_menu_div.php');?>
    <!--下级分类导航结束--> 
	<!--筛选内容页面开始-->
	<?php require_once ('list_content_div.php');?>
	<!--筛选内容页面开始-->
	<!--底部信息开始-->
	<?php require_once ('common/common_footer.php'); ?>
	<!--底部信息结束-->
</body>
</html>
