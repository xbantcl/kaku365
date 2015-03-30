<div id="nav">
	<h2><?=$shop['name']?></h2>
	<ul id="js_nav">
	<li><a href="/shop/index/<?=$shop['id']?>">首页</a></li>
	<?php foreach ($category as $c): ?>
		<li><a href="<?='/search/filter?cateid='.$c['id'].'&shop_id='.$shop['id']?>" onmouseout="hide_menu(<?=$c['id']?>)" onmouseover="show_menu(<?=$c['id']?>)"><?=$c['name']?></a></li>
	<?php endforeach; ?>
	</ul>
	<!--购物车开始-->
	<div id="box">
		<?php if(!empty($user)):?>
		<a href="/cart">购物车</a><b><?= $carts_count['count']?$carts_count['count']:''?></b>
		<?php else: ?>
		<a href="/user/login">购物车</a>
		<?php endif; ?>
	</div>
	<!--搜索开始-->
	<div id="nav_search">
	<form action="/search/filter" method="get">
		<input id="tex" name="words" type="text" placeholder="搜索您喜欢的商品"/>
		<input type="hidden" name="shop_id" value="<?=$shop['id']?>" />
		<input id="sub" type="submit" value="搜索"/>
		</form>
    </div>
	<!--搜索结束-->
	<!--购物车内容开始-->
	<?php if (!empty($carts)) require_once (dirname(__FILE__) . '/../common/cart_box_div.php'); ?>
	<!--购物车内容结束-->
	<!--购物车结束-->
</div>
<div id="top_fixed"></div>