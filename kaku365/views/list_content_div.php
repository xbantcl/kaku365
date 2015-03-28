<div id="content"> 
<!--筛选信息栏开始-->
	<?php if(!empty($tag)):?>
	<!--选择器开始-->
	<?php require_once ('list_select_div.php'); ?>	
	<!--选择器结束--> 
	<?php endif;?>
  	<!--排列方式开始-->
	<?php require_once ('list_sort_div.php'); ?>
	<!--排列方式结束--> 
	<!--产品详细信息开始-->
	<?php require_once ('list_goods_info_div.php'); ?>
	<!--产品详细信息结束-->
	<!--list产品信息栏开始-->
	<?php require_once ('list_main_div.php'); ?>
	<!--list产品信息栏结束--> 
</div>