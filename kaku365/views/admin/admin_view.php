<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			管理中心
		</title>
		<link href="<?=base_url() ?>static/css/admin.css" rel="stylesheet" type="text/css">
	</head>
	<body style="overflow:hidden;">
		<table width="100%" height="100%" cellpadding="0" cellspacing="0" style="width:100%">
			<thead>
				<tr>
					<td id="mainhd" colspan="2">
						<div id="header">
							<h2>
								管理中心
							</h2>
							<!--主导航开始-->
							<ul id="head_ul">
								<li class="link_li">
									<a class="link_a" href="javascript:;">
										网站管理
									</a>
								</li>
								<li>
									<a href="javascript:;">
										商家管理
									</a>
								</li>
								<li>
									<a href="javascript:;">
										会员管理
									</a>
								</li>
			                    <li>
									<a href="javascript:;">
										商品管理
									</a>
								</li>
							</ul>
							<!--主导航结束-->
							<!--admin开始-->
							<ol>
								<li >
									<a href="<?=site_url('welcome/index')?>">
										前台首页
									</a>
								</li>
								<li>
									<a href="<?php echo site_url('admin/logout'); ?>">
										退出
									</a>
								</li>
								<li>
									<a href="javascript:;" onClick="setSrc('<?=site_url('admin/alertpassword')?>')">
										修改密码
									</a>
								</li>
								<li class="adminid">
									您好：<strong><?php echo $name; ?></strong>
								</li>
							</ol>
							<!--admin结束-->
							
						</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td id="nav_left" valign="top">
						<!--网站管理开始-->
						<ul style="display:block">
							<li>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/serverData')?>')">
									欢迎页面
								</a>
							</li>
							
						</ul>
						<!--网站管理结束-->
						<!--商家管理开始-->
						<ul>
							<li>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/shop/manager')?>')">
									商家管理
								</a>
							</li>
						</ul>
						<!--商家管理结束-->
						<!--会员管理开始-->
						<ul>
							<li>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/user/userManager')?>')">
									会员管理
								</a>
							</li>
						</ul>
						<!--会员管理结束-->
						<!--商品管理开始-->
						<ul>
							<li>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/shop/addGoods')?>')">
									添加商品
								</a>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/shop/goodsList')?>')">
									管理商品
								</a>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/addBrand')?>')">
									添加品牌
								</a>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/brandList')?>')">
									管理品牌
								</a>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/admin/addCategory')?>')">
									添加分类
								</a>
								<a href="javascript:;" onClick="setSrc('<?=site_url('admin/admin/categoryList')?>')">
									管理分类
								</a>
							</li>
						</ul>
						<!--商品管理结束-->
					</td>
					<script>var oNav_l = document.getElementById('nav_left');
var aUl = oNav_l.getElementsByTagName('ul');
var oHeader = document.getElementById('head_ul');
var aLi = oHeader.getElementsByTagName('li');
var aA = oHeader.getElementsByTagName('a');
for (var i = 0; i < aA.length; i++) {
	aA[i].index = i;
	aA[i].onclick = function() {
		for (var i = 0; i < aA.length; i++) {
			aA[i].className = '';
			aLi[i].className = '';
			aUl[i].style.display = 'none';
		}
		this.className = 'link_a'
		aLi[this.index].className = 'link_li';
		aUl[this.index].style.display = 'block';
	}
}</script>
					<td valign="top" width="100%">
						<iframe id="m_content" width="100%" height="100%" onload="window.parent" frameborder="0" scrolling="yes" style="overflow:visible; height:550px; width:100%;" src="<?=site_url('admin/serverData')?>">
						</iframe>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
	<script>function setSrc(a) {
	var oM_content = document.getElementById('m_content');
	oM_content.src = a;
}</script>
</html>
