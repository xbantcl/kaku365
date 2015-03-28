<div class="collect" id="r_content">
	<h3>我的收藏</h3>
	<table>
		<thead>
			<tr>
				<td><label><input id="SelectAll" type="checkbox" onclick="select_all()"/>全选</label></td>
				<td>图片</td>
                <td>条码</td>
				<td>名称</td>
			
				<td>单价</td>
				<td>是否有货</td>
				<td>操 作</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($collects as $c):?>
			<tr>
				<td><input onclick="setSelectAll()" id="subcheck"  type="checkbox" name="goods_id" value="<?=$c['goods_id']?>"/></td>
                
				<td><a href="<?=site_url('goods/view').'/'.$c['goods_id']?>"><img width="60px" src="/static/uploads/square/<?=$c['goods_img']?>"/></a></td>
				<td><?=$c['product_code']?></td>
                <td ><a href="<?=site_url('goods/view').'/'.$c['goods_id']?>"><?=$c['goods_name']?></a></td>
				
				<td class="price">¥<?=$c['goods_price']?></td>
				<td><?php if($c['goods_number']>0):?>有货<?php else:?>缺货<?php endif;?></td>
				<td class="btn_s"><a onclick="join_cart(<?=$c['goods_id']?>)">加入购物车</a>/<a onclick="del_collect(<?=$c['id']?>)">删除</a></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<p>
		<a onclick="join_carts()">加入购物车</a>
		<a onclick="del_collects()">删除</a>
	</p>
</div>