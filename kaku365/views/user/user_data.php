<div class="p_data" id="r_content">
	<h3>个人资料</h3>
	<form id="userInfo" action="<?=site_url('user/update_data')?>" method="post">	
	<ul>
		<li><b>*</b><span>账号：</span><?=$user->username?></li>
		<li><b>*</b><span>姓名：</span><input name="contacts" type="text" value="<?=$user->contacts?>"></li>
		<li><b>*</b><span>电话：</span><input name="phone" type="text" value="<?=$user->phone?>"></li>
		<li><b>*</b><span>性别：</span>
			<select name="sex">
			<?php if($user->sex == 1):?>
			<option value="1" selected>男</option>
			<option value="2" >女</option>
			<?php else: ?>
			<option value="1">男</option>
			<option value="2" selected>女</option>
			<?php endif; ?>
			</select>
		</li>

		<li><b>*</b><span>详细地址：</span>
		<select name="province"></select>
		<select name="city"></select>
		<select name="area"></select>
		<input name="address" type="text" value="<?=$address[3]?>" />
		</li>
	</ul>
	<input id="p_sub" type='button' value="提 交">
	</form>
</div>
<script language="javascript">
	new PCAS("province","city","area","<?=$address[0]?>","<?=$address[1]?>","<?=$address[2]?>");
</script>