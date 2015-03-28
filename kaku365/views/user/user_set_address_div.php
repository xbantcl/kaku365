<div class="m_add" id="r_content">
	<h3>地址管理</h3>
	<table>
		<thead>
			<tr>
				<th>收货人</th>
				<th>联系电话</th>
				<th>联系地址</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($address as $a):?>
			<tr>
				<td><?=$a['name']?></td>
				<td><?=$a['phone']?></td>
				<td><?=$a['address']?></td>
				<td>
	
					<a onclick="del_address(<?=$a['id']?>)">删除</a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<a onclick="$('.add_content').toggle()">
		添加收货地址
	</a>
	<div class="add_content">
		<form action="<?=site_url('user/insert_delivery_address')?>" method="post">
			<p><b>姓名：</b><input name="name" type="text"></p>
			<p><b>电话：</b><input name="phone" type="text">
				<input name="url" type="hidden" value="user/set_address">
			</p>
			<p><b>地址：</b>
				<select name="province"></select> 
				<select name="city"></select> 
				<select name="area"></select> 
				<script language="javascript" defer>
					new PCAS("province","city","area");
				</script>
				<input name="address" type="text"></p>
			<input class="add_sub" type="submit" value="确认">
			<input class="add_sub" type="reset" value="清空">
		</form>
	</div>
</div>