<div id="big_info">
	<div id="bi_header">
		<p>
			<b>您所在的位置：</b>
			<a href=<?='/shop/index/'.$shop['id']?>><?=$shop['name'];?></a> >

			<?php foreach($category as $s):?>
			<?php if($Goods['category1']==$s['id']):?>
			<?php echo "<a href=\"/search/filter?cateid=".$s['id']."&shop_id=".$shop['id']."\" class=\"lastpositon\">{$s['name']}</a> >";?>
			<?php endif;?>
			<?php endforeach;?>

			<?php foreach($s_category as $s):?>
			<?php if($Goods['category2']==$s['id']):?>
			<?php echo "<a href=\"/search/filter?cateid=".$s['id']."&shop_id=".$shop['id']."\" class=\"lastpositon\">{$s['name']}</a> >";?>
			<?php endif;?>
			<?php endforeach;?>
			
			<?php foreach($th_category as $s):?>
			<?php if($Goods['category3']==$s['id']):?>
			<?php echo "<a href=\"/search/filter?cateid=".$s['id']."&shop_id=".$shop['id']."\" class=\"lastpositon\">{$s['name']}</a>";?>
			<?php endif;?>
			<?php endforeach;?>

		</p>
	</div>
	<!--产品图片开始-->
	<div id="img_content">
		<ul>
		<?php foreach($Goods['img_content'] as $img)
            if(strlen($img))
		echo "<li onClick=\"setImg('/static/uploads/$img')\"><img src=\"/static/uploads/$img\"></li>";
		?>
		</ul>
		<img style=" margin-top: 20px; margin-left: 150px;width: 600px; " id="b_img" src="/static/uploads/<?=$Goods['cover_image'];?>"/>
	</div>
	<!--产品图片结束-->
	<script>
		function setImg(img) {
			var oBimg = document.getElementById('b_img');
			oBimg.src = img;
		}
	</script>
	<!--产品文字评价信息开始-->
	<div id="tex_content">
		<!--产品信息开始-->
		<ul>
			<li><span>名称：</span> <b><?=$Goods['name'];?></b></li>
			<li><span>价格：</span><strong>￥<?=$Goods['price'];?></strong></li>
            <li><span>品牌：</span><i><?=$Goods['goods_brandName'];?></i></li>
            <li><span>规格：</span> <i><?=$Goods['format'];?></i></li><!--商品规格-->
			<li><span>单位：</span><i><?=$Goods['format'];?></i></li>
			<li><span>编码：</span><i><?=$Goods['product_code'];?></i></li>
            <li><span>保质期：</span><i><?=$Goods['shelf_life'];?></i></li>
			<li><span>配料：</span><p><?=$Goods['product_ingredients'];?></p></li>
			
			<li><span>备注：</span><p><?=$Goods['description'];?></p></li>
		</ul>
		<!--产品信息结束-->
		<div class="big_img_btns">
			<a id="increase" href="#">+</a>
			<input id="quantum" type="text" maxlength="2" value="1"/>
			<a id="decrease" href="#">-</a>
		</div>
		<!--提交按钮开始-->
		<input onclick="join_cart(<?=$Goods['id']?>,<?=$shop['id']?>)" class="img_sub" type="submit" value="加入购物车"/>
		<input onclick="show_shop_search(<?=$shop['id']?>,<?=$Goods['category1']?>)" class="img_sub" type="submit" value="继续购物"/>
	</div>
	<!--产品文字评价信息结束-->
</div>