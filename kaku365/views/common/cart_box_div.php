<div id="box_content">
	<ul style="height:335px; overflow: scroll;">
	<?php foreach($carts as $c):?>
		<li id="<?=$c['id']?>">
		<h4><a href=<?='/goods/view/'.$c['goods_id']?>><img src="/static/uploads/square/<?=$c['goods_img']?>"/></a></h4>
		<p><a href=<?='/goods/view/'.$c['goods_id']?>><?=$c['goods_name']?></a></p>
		<span><strong>￥<?=$c['goods_price']?></strong> x <?=$c['amount']?><b onclick="del_cart(<?=$c['id']?>)">删除</b></span>
		</li>
	<?php endforeach;?>
	</ul>
	<!--购物车结果栏开始-->
	<div id="result">
		<p>共 <span><?=$carts_count['number']?></span> 件商品.共计<b>￥ <?=$carts_count['total']?></b></p>
		<a href="<?=site_url('cart/index')?>">去购物车结算</a>
	</div>
	<!--购物车结果栏结束-->
</div>