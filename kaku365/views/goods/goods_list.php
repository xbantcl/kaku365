<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			kaku365
		</title>
		<link href="<?=base_url() ?>static/css/basic.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url() ?>static/css/list.css" rel="stylesheet" type="text/css">
		<script src="<?=base_url() ?>static/js/basic.js"></script>
	</head>
	<body>
		<!--头部标题注册搜索开始-->
		<div id="header">
			<h1 title="返回首页">
				<a href="index.html">
					kaku365
				</a>
			</h1>
			<div id="header_key">
				<input id="key_text" type="text" value="输入您要去的店铺"/>
				<input id="key_sub" type="submit" value="搜索" onClick="location.href='search.html'"/>
			</div>
			<span>
				<a href="member/m_order.html">
					会员登录后名字
				</a>|
				<a href="javascript:alert ('注册窗口：手机号码注册，短信验证');">
					注册
				</a></span>
		</div>
		<!--头部标题注册搜索结束-->
		<!--店招店内图片展示开始-->
		<div id="adv">
			<div id="search_content">
				<dl>
					<dt>
						<a href="shop.html">
							<img src="<?=base_url() ?>static/img/search.jpg"/>
						</a>
					</dt>
					<dd>
						<b>店名：</b><span>
							<a href="custom_info/custom_info.html">
								社区超市
							</a></span>
					</dd>
					<dd>
						<b>联系人：</b><span>小丽</span>
					</dd>
					<dd>
						<b>电话：</b><span>023-3333333</span>
					</dd>
					<dd>
						<b>地址：</b><span>重庆市渝中区江华街222号</span>
					</dd>
					<dd>
						<b>介绍：</b>
						<p>
							主要经营的民生用品及快速消费品，满足了顾客基本生活以及便捷服务的要求，如今在中国城市已经成为了人们的一种生活习惯。目前线下实体超市以大卖场和社区便利型超市业态为主，网络上经营生活快消商品的卖家以个体为主，经营的商品种类不多，但经营生活品的卖家却多如牛毛。
						</p>
					</dd>
				</dl>
			</div>
		</div>
		<!--店招店内图片展示结束-->
		<!--导航条开始-->
		<div id="nav">
			<h2>
				惠尔佳超市欢迎您
			</h2>
			<ul id="js_nav">
				<li>
					<a href="shop.html">
						首页
					</a>
				</li>
				<li>
					<a href="list.html">
						食品饮料
					</a>
				</li>
				<li>
					<a href="list.html">
						粮油调味
					</a>
				</li>
				<li>
					<a href="list.html">
						冷冻食品
					</a>
				</li>
				<li>
					<a href="list.html">
						个人护理
					</a>
				</li>
				<li>
					<a href="list.html">
						日化日杂
					</a>
				</li>
			</ul>
			<!--购物车开始-->
			<div id="box">
				<a href="shopping.html">
					购物车
				</a><span>12</span>
			</div>
			<!--购物车内容开始-->
			<div id="nav_search">
				<input id="tex" type="text" value="搜索您喜欢的商品"/>
				<input id="sub" type="submit" value="搜索"/>
			</div>
			<div id="box_content">
				<ul>
					<li>
						<h4>
							<a href="javascript:alert ('链接产品大图');">
								<img src="<?=base_url() ?>static/img/tongyi.jpg"/>
							</a>
						</h4>
						<p>
							<a href="javascript:alert ('链接产品大图');">
								统一 来一桶方便面 卤肉面 卤香牛肉味 113g*12桶
							</a>
						</p>
						<span><strong>¥46.50</strong>x1<b>删除</b></span>
					</li>
					<li>
						<h4>
							<a href="javascript:alert ('链接产品大图');">
								<img src="<?=base_url() ?>static/img/tongyi.jpg"/>
							</a>
						</h4>
						<p>
							<a href="javascript:alert ('链接产品大图');">
								统一 来一桶方便面 卤肉面 卤香牛肉味 113g*12桶
							</a>
						</p>
						<span><strong>¥46.50</strong>x1<b>删除</b></span>
					</li>
					<li>
						<h4>
							<a href="javascript:alert ('链接产品大图');">
								<img src="<?=base_url() ?>static/img/tongyi.jpg"/>
							</a>
						</h4>
						<p>
							<a href="javascript:alert ('链接产品大图');">
								统一 来一桶方便面 卤肉面 卤香牛肉味 113g*12桶
							</a>
						</p>
						<span><strong>¥46.50</strong>x1<b>删除</b></span>
					</li>
					<li>
						<h4>
							<a href="javascript:alert ('链接产品大图');">
								<img src="<?=base_url() ?>static/img/tongyi.jpg"/>
							</a>
						</h4>
						<p>
							<a href="javascript:alert ('链接产品大图');">
								统一 来一桶方便面 卤肉面 卤香牛肉味 113g*12桶
							</a>
						</p>
						<span><strong>¥46.50</strong>x1<b>删除</b></span>
					</li>
					<li>
						<h4>
							<a href="javascript:alert ('链接产品大图');">
								<img src="<?=base_url() ?>static/img/tongyi.jpg"/>
							</a>
						</h4>
						<p>
							<a href="javascript:alert ('链接产品大图');">
								统一 来一桶方便面 卤肉面 卤香牛肉味 113g*12桶
							</a>
						</p>
						<span><strong>¥46.50</strong>x1<b>删除</b></span>
					</li>
				</ul>
				<!--购物车结果栏开始-->
				<div id="result">
					<p>
						共<span>15</span>件商品　共计<b>￥ 1043.40</b>
					</p>
					<a href="javascript:alert('去购物车结算');">
						去购物车结算
					</a>
				</div>
				<!--购物车结果栏结束-->
			</div>
			<script>var oBox = document.getElementById('box');
var oBox_content = document.getElementById('box_content');
oBox.onmouseover = function() {
	oBox_content.style.display = 'block'
}
oBox.onmouseout = function() {
	oBox_content.style.display = 'none'
}</script>
			<!--购物车内容结束-->
			<!--购物车结束-->
		</div>
        <div id="top_fixed"></div>
		<!--导航条结束-->
		<!--二级分类导航开始-->
		<div id="js_divide">
			<div>
			</div>
			<!--食品饮料二级导航开始-->
			<div class="divide" >
				<ul>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级食品
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4580">
								豆腐干/素食品
							</a>
							<a href="/list.do?sortId=4581">
								炒货坚果
							</a>
							<a href="/list.do?sortId=4582">
								膨化食品
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级食品
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4580">
								豆腐干/素食品
							</a>
							<a href="/list.do?sortId=4581">
								炒货坚果
							</a>
							<a href="/list.do?sortId=4582">
								膨化食品
							</a>
						</p>
					</li>
				</ul>
			</div>
			<!--食品饮料二级导航结束-->
			<!--粮油调味二级导航开始-->
			<div class="divide" >
				<ul>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级调味
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4602">
								炖料食材/枸杞
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级调味
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4602">
								炖料食材/枸杞
							</a>
						</p>
					</li>
				</ul>
			</div>
			<!--粮油调味二级导航结束-->
			<!--冷冻食品二级导航开始-->
			<div class="divide" >
				<ul>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级冷冻
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4621">
								水饺/抄手/馄饨
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级冷冻
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4621">
								水饺/抄手/馄饨
							</a>
							<a href="/list.do?sortId=4622">
								汤圆/年糕
							</a>
							<a href="/list.do?sortId=4623">
								包子/馒头/花卷/油条
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级冷冻
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4621">
								水饺/抄手/馄饨
							</a>
							<a href="/list.do?sortId=4622">
								汤圆/年糕
							</a>
							<a href="/list.do?sortId=4623">
								包子/馒头/花卷/油条
							</a>
						</p>
					</li>
				</ul>
			</div>
			<!--冷冻食品二级导航结束-->
			<!--个人护理二级导航开始-->
			<div class="divide" >
				<ul>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级护理
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4644">
								国产水果
							</a>
							<a href="/list.do?sortId=4645">
								进口水果
							</a>
							<a href="/list.do?sortId=4646">
								水果拼盘/果篮
							</a>
							<a href="/list.do?sortId=4647">
								干果
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级护理
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4644">
								国产水果
							</a>
							<a href="/list.do?sortId=4645">
								进口水果
							</a>
							<a href="/list.do?sortId=4646">
								水果拼盘/果篮
							</a>
							<a href="/list.do?sortId=4647">
								干果
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级护理
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=4644">
								国产水果
							</a>
							<a href="/list.do?sortId=4645">
								进口水果
							</a>
							<a href="/list.do?sortId=4646">
								水果拼盘/果篮
							</a>
							<a href="/list.do?sortId=4647">
								干果
							</a>
						</p>
					</li>
				</ul>
			</div>
			<!--个人护理二级导航结束-->
			<!--日化日杂二级导航开始-->
			<div class="divide" >
				<ul>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级日化
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=5993">
								火腿肠/培根
							</a>
							<a href="/list.do?sortId=5995">
								肉类配菜/鱼类配菜/蔬菜配菜
							</a>
							<a href="/list.do?sortId=5994">
								腊肉/腌腊制品
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级日化
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=5993">
								火腿肠/培根
							</a>
							<a href="/list.do?sortId=5995">
								肉类配菜/鱼类配菜/蔬菜配菜
							</a>
							<a href="/list.do?sortId=5994">
								腊肉/腌腊制品
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级日化
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=5993">
								火腿肠/培根
							</a>
							<a href="/list.do?sortId=5995">
								肉类配菜/鱼类配菜/蔬菜配菜
							</a>
							<a href="/list.do?sortId=5994">
								腊肉/腌腊制品
							</a>
						</p>
					</li>
					<li>
						<h3>
							<a href="javascript:alert ('修改为nav的下级导航');">
								二级日化
							</a>
						</h3>
						<p>
							<a href="/list.do?sortId=5993">
								火腿肠/培根
							</a>
							<a href="/list.do?sortId=5995">
								肉类配菜/鱼类配菜/蔬菜配菜
							</a>
							<a href="/list.do?sortId=5994">
								腊肉/腌腊制品
							</a>
						</p>
					</li>
				</ul>
			</div>
			<!--日化日杂二级导航结束-->
		</div>
		<!--二级分类导航结束-->
		<!--list页面开始-->
		<div id="content">
			<!--list筛选信息栏开始-->
			<!--选择器开始-->
			<div id="select">
				<!--选择器指示条开始-->
				<div id="hint">
					<p>
						您已选择：<b>食品饮料</b> <span><em>品牌：</em><i>康师傅</i><strong>&nbsp;&nbsp;&nbsp;</strong></span> <span><em>分类：</em><i>衣服鞋帽内衣</i><strong>&nbsp;&nbsp;&nbsp;</strong></span> <span><em>价格：</em><i>1001-500</i><strong>&nbsp;&nbsp;&nbsp;</strong></span>
					</p>
				</div>
				<!--选择器指示条结束-->
				<!--品牌筛选开始-->
				<div id="brand">
					<h4>
						品牌筛选
					</h4>
					<div id="brand_c">
						<p>
							<a href="javascript:alert ('链接筛选信息');">
								雀巢<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								棒棒娃<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								好时<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								格力高<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								雀巢<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								老城南<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								蒙牛<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								香香嘴<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								雀巢<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								思念<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								想真<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								格力高<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								雀巢<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								天友<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								新希望<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								天福茗茶<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								格力高<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								雀巢<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								老城南<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								蒙牛<b>(60)</b>
							</a>
							<a href="javascript:alert ('链接筛选信息');">
								香香嘴<b>(60)</b>
							</a>
						</p>
						<span id="btn1">
							<img  src="<?=base_url() ?>static/images/1-new-close.jpg"/>
						</span>
					</div>
				</div>
				<!--品牌筛选结束-->
				<!--价格筛选开始-->
				<div id="price">
					<h4>
						价格筛选
					</h4>
					<div>
						<a href="javascript:alert('价格筛选');">
							50元以下
						</a>
						<a href="javascript:alert('价格筛选');">
							50-100元
						</a>
						<a href="javascript:alert('价格筛选');">
							101-200元
						</a>
						<a href="javascript:alert('价格筛选');">
							201-300元
						</a>
						<a href="javascript:alert('价格筛选');">
							300以上
						</a>
					</div>
				</div>
				<!--价格筛选结束-->
				<!--分类筛选开始-->
				<div id="classify">
					<h4>
						分&nbsp;&nbsp;类
					</h4>
					<div id="classify_c">
						<p>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
							<a href="javascript:alert ('对应分类导航');">
								衣服 <b>（4324）</b>
							</a>
						</p>
						<span>
							<img src="<?=base_url() ?>static/images/1-new-close.jpg"/>
						</span>
					</div>
				</div>
				<!--分类筛选结束-->
			</div>
			<script>var oBrand = document.getElementById('brand_c');
var oBtn1 = oBrand.getElementsByTagName('img')[0];
var oClassify = document.getElementById('classify_c');
var oClass_p = oClassify.getElementsByTagName('p')[0];
var oBtn2 = oClassify.getElementsByTagName('img')[0];
oBtn1.onclick = function() {
	if (oBrand.style.height == 'auto') {
		oBrand.style.height = '60px';
		oBtn1.src = '<?=base_url() ?>static/images/1-new-close.jpg';
	} else {
		oBrand.style.height = 'auto';
		oBtn1.src = '<?=base_url() ?>static/images/1-new-open-1.jpg';
	}
};
oBtn2.onclick = function() {
	if (oClass_p.style.height == 'auto') {
		oBtn2.src = '<?=base_url() ?>static/images/1-new-close.jpg';
		oClass_p.style.height = '50px';
	} else {
		oBtn2.src = '<?=base_url() ?>static/images/1-new-open-1.jpg';
		oClass_p.style.height = 'auto';
	}
};</script>
			<!--选择器结束-->
			<!--排列方式开始-->
			<div id="sort">
				<p>
					排列方式：
				</p>
				<!--价格销量新品排序开始-->
				<div id="sort_auto">
					<a href="javascript:alert ('自动排序功能');">
						<img src="<?=base_url() ?>static/images/list_sort.jpg"/>
					</a>
					<a href="javascript:alert ('自动排序功能');">
						<img src="<?=base_url() ?>static/images/list_price.jpg"/>
					</a>
				</div>
				<!--价格销量新品排序结束-->
				<!--搜索结果数字显示开始-->
				<div id="number">
					总共找到了<b>3421</b>个商品
				</div>
				<!--搜索结果数字显示结束-->
				<!--上页下页开始-->
				<div id="page">
					<span>1/444</span>
					<a href="javascript:alert ('跳转页码');">
						<img src="<?=base_url() ?>static/images/on_up.jpg"/>
					</a>
					<a href="javascript:alert ('跳转页码');">
						<img src="<?=base_url() ?>static/images/on_down.jpg"/>
					</a>
				</div>
				<script>var oPage = document.getElementById('page');
var oUp = oPage.getElementsByTagName('img')[0];
var oDown = oPage.getElementsByTagName('img')[1];
oUp.onmouseover = function() {
	oUp.src = '<?=base_url() ?>static/images/up.jpg';
}
oUp.onmouseout = function() {
	oUp.src = '<?=base_url() ?>static/images/on_up.jpg';
}
oDown.onmouseover = function() {
	oDown.src = '<?=base_url() ?>static/images/down.jpg';
}
oDown.onmouseout = function() {
	oDown.src = '<?=base_url() ?>static/images/on_down.jpg';
}</script>
				<!--上页下页结束-->
			</div>
			<!--排列方式结束-->
			<!--产品详细信息开始-->
			<div id="info">
				<!--图片信息开始-->
				<div class="img_info">
					<dl>
						<dt>
							<img src="<?=base_url() ?>static/img/bksf.jpg"/>
						</dt>
						<dd id="img_btn1">
							&lt;
						</dd>
						<dd>
							<img src="<?=base_url() ?>static/img/ksf.jpg"/>
						</dd>
						<dd>
							<img src="<?=base_url() ?>static/img/ksf.jpg"/>
						</dd>
						<dd>
							<img src="<?=base_url() ?>static/img/ksf.jpg"/>
						</dd>
						<dd>
							<img src="<?=base_url() ?>static/img/ksf.jpg"/>
						</dd>
						<dd>
							<img src="<?=base_url() ?>static/img/ksf.jpg"/>
						</dd>
						<dd id="img_btn2">
							&gt;
						</dd>
					</dl>
					<div class="btns">
						<span>
							<a href="javascript:;">
								+
							</a>
							<input id="btn3" type="text" value="9"/>
							<a style="font-size:28px;" href="javascript:;">
								-
							</a>
						</span>
						<input id="btn1" type="button" value="查看大图" onClick="location.href='big_img.html'"/>
						<input id="btn2" type="button" value="加入购物车" onClick="alert ('参考易迅购物事件')"/>
					</div>
				</div>
				<!--图片信息结束-->
				<!--文字信息开始-->
				<div id="text_info">
					<h2>
						<a href="javascript:;">
							商品信息
						</a><span id="tex_close">关闭</span>
					</h2>
					<!--产品信息开始-->
					<ul id="product_info" style="display:block;">
						<li>
							<span>商品名称：</span> <b>康师傅卤香牛肉面</b>
						</li>
						<li>
							<span>价格：</span><strong>￥3.80</strong>
						</li>
						<li>
							<span>规格：</span><i>125g</i>
						</li>
						<li>
							<span>品牌：</span><i>康师傅</i>
						</li>
						<li>
							<span>单位：</span><i>桶</i>
						</li>
						<li>
							<span>商品编码：</span><i>6925303721367</i>
						</li>
						<li>
							<span>产品配料：</span>
							<p>
								面饼：小麦粉、精炼棕榈油、淀粉、食用盐、味精、碳酸钠、碳酸钾、水分保持剂、增稠剂、栀子黄调味粉包：食用盐、增味剂、牛肉精粉、香辛料、瓜尔胶、柠檬酸、焦糖色、脱水青葱调味酱包：精炼棕榈油、泡辣椒、红葱、食用盐、乳酸、辣椒红蔬菜包：脱水牛肉（牛肉，植物蛋白）脱水胡萝卜
							</p>
						</li>
						<li>
							<span>保质期：</span><i>12个月</i>
						</li>
						<li>
							<span>注：</span><i>因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样主流新品一致。若本商城没有及时更新，请大家谅解！ </i>
						</li>
					</ul>
					<!--产品信息结束-->
					<!--商品评价开始
					<ul id="product_assess">
					<li>
					<h4><img src="<?=base_url() ?>static/images/memeber.jpg"/></h4>
					<div>
					<p><strong>会员：explorer </strong> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <span>5分</span> <b>评论时间：</b><span>2014-03-25 12:41:12</span> </p>
					<p>商品质量很好。。。商品质量很好。。。商品质量商品质量很好。。。</p>
					</div>
					</li>
					<li>
					<h4><img src="<?=base_url() ?>static/images/memeber.jpg"/></h4>
					<div>
					<p><strong>会员：explorer </strong> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <span>5分</span> <b>评论时间：</b><span>2014-03-25 12:41:12</span> </p>
					<p>商品质量很好。。。商品质量很好。。。商品质量商品质量很好。。。</p>
					</div>
					</li>
					<li>
					<h4><img src="<?=base_url() ?>static/images/memeber.jpg"/></h4>
					<div>
					<p><strong>会员：explorer </strong> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <span>5分</span> <b>评论时间：</b><span>2014-03-25 12:41:12</span> </p>
					<p>商品质量很好。。。商品质量很好。。。商品质量商品质量很好。。。</p>
					</div>
					</li>
					<li>
					<h4><img src="<?=base_url() ?>static/images/memeber.jpg"/></h4>
					<div>
					<p><strong>会员：explorer </strong> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <span>5分</span> <b>评论时间：</b><span>2014-03-25 12:41:12</span> </p>
					<p>商品质量很好。。。商品质量很好。。。商品质量商品质量很好。。。</p>
					</div>
					</li>
					<li>
					<h4><img src="<?=base_url() ?>static/images/memeber.jpg"/></h4>
					<div>
					<p><strong>会员：explorer </strong> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <img src="<?=base_url() ?>static/images/commodity_06.jpg"/> <span>5分</span> <b>评论时间：</b><span>2014-03-25 12:41:12</span> </p>
					<p>商品质量很好。。。商品质量很好。。。商品质量商品质量很好。。。</p>
					</div>
					</li>
					</ul>
					商品评价结束-->
					<!--配送服务开始
					<ul id="verb">
					<li>
					<h4>商品咨询热线：</h4>
					<p>023-87021535、87022932</p>
					</li>
					<li>
					<h4>配送范围：</h4>
					<p>目前承接渝中区配送上楼服务</p>
					</li>
					<li>
					<h4>配送时间：</h4>
					<p>前日14:00——次日07:00订货，配送时间为次日12:00——次日17:00； 当日08:00——当日14:00订货，配送时间为当日17:00——当日20:00； 当日14：00以后的订货在次日配送，顾客可以选择在次日的上述时间段送达。 因交通状况或其他不可抗力因素，商品送达时间有可能延后，请予谅解。</p>
					</li>
					<li>
					<h4>配送费收取标准：</h4>
					<p>配送收费10元/家，一次性购物满100元，三环内免费送货，一次性购物满200元，三环外免费送货（限绕城以内）。若商品本身无质量问题，由于顾客自身原因，拒收商品，或者造成二次配送所产生的配送费用，由顾客自行承担。 温馨提示： 由于部分商品包装更换较为频繁，因此您收到的货物有可能与图片不完全一致，请您以收到的商品实物为准，同时我们会尽量做到及时更新，由此给您带来不便请多多谅解，谢谢！ </p>
					</li>
					</ul>
					配送服务结束-->
				</div>
				<script>var oText_info = document.getElementById('text_info');
var aA = oText_info.getElementsByTagName('a');
var aUl = oText_info.getElementsByTagName('ul');
for (var i = 0; i < aA.length; i++) {
	aA[0].style.background = '#ECECEC';
	aUl[0].style.display = 'block';
	aA[i].index = i;
	aA[i].onclick = function() {
		for (var i = 0; i < aA.length; i++) {
			aA[i].style.background = '';
			aA[i].style.color = '#666';
			aUl[i].style.display = 'none';
		}
		this.style.background = '#ECECEC';
		aUl[this.index].style.display = 'block';
	}
};</script>
				<!--文字信息结束-->
			</div>
			<!--产品详细信息结束-->
			<!--list产品信息栏开始-->
			<div id="main">
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list1.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							康师傅矿物质水550ml*24瓶
						</a>
					</dd>
					<dd class="s2">
						<b>
							￥19.50
						</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list2.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							康师傅冰红茶600ml*15瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>
							￥36.90
						</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list3.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 冰红茶（柠檬味红茶饮料） 250ml*24/箱 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>
							￥24.80
						</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list4.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 鲜橙多 250ml*24盒/箱 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥24.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list5.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 冰糖雪梨 250ml*24盒/箱 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥24.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束--> <!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list6.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一冰红茶500ml*15瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥36.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list7.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 海之言 柠檬口味 500ml*15瓶/箱 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥60.00</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list8.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一绿茶500ml*15瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥36.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list10.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 冰糖雪梨饮料500ml*15瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>
							￥39.80
						</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list9.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一 阿萨姆奶茶500ml*15瓶
						</a>
					</dd>
					<dd class="s2">
						<b>￥59.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束--> <!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list11.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							统一鲜橙多 橙汁饮料 2L*6
						</a>
					</dd>
					<dd class="s2">
						<b>￥59.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list12.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							脉动（Mizone）维生素饮料 蓝莓口味 500ml*15瓶 整箱装
						</a>
					</dd>
					<dd class="s2">
						<b>￥59.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list13.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							脉动（Mizone） 菠萝味运动饮料600ml *15瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥59.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list14.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							怡宝纯净水4.5L*4桶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥34.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list15.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							怡宝纯净水555ml*24瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥10.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束--> <!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list16.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							怡宝纯净水350ml*24瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥10.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list17.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							农夫山泉 天然饮用水4L*4桶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥29.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list18.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							农夫山泉 天然饮用水550ml*24瓶 整箱
						</a>
					</dd>
					<dd class="s2">
						<b>￥10.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list19.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							重庆特产 有友泡凤爪山椒味100g
						</a>
					</dd>
					<dd class="s2">
						<b>￥4.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
				<!--产品展示框开始-->
				<dl class="adl">
					<dt>
						<img src="<?=base_url() ?>static/img/list20.jpg"/>
					</dt>
					<dd class="s1">
						<a href="javascript:;">
							有友 豆干 卤香100g
						</a>
					</dd>
					<dd class="s2">
						<b>￥10.80</b>
					</dd>
					<dd class="s3">
						<input type="submit" value="加入购物车"/>
						<input type="submit" value="查看详情"/>
					</dd>
				</dl>
				<!--产品展示框结束-->
			</div>
			<div id="page_down">
				<span>下一页&nbsp;&gt;</span>
				<a href="javascript:;">
					22
				</a><b>...</b>
				<a href="javascript:;">
					5
				</a>
				<a href="javascript:;">
					4
				</a>
				<a href="javascript:;">
					3
				</a>
				<a href="javascript:;">
					2
				</a>
				<a href="javascript:;">
					1
				</a><span>&lt;&nbsp;上一页</span>
			</div>
			<!--list产品信息栏结束-->
			<script>
var aDl=document.getElementsByTagName('dl');
var oInfo=document.getElementById('info');
var oTex_close=document.getElementById('tex_close');
for(var i=0; i<aDl.length; i++){
aDl[i].onclick=function (){
oInfo.style.display='block';
}
};
oTex_close.onclick=function (){
oInfo.style.display='none';
}
//oInfo.onclick=function (){
//
// };
			</script>
		</div>
		<!--list页面结束-->
		<!--底部信息开始-->
		<div id="footer">
			<p>
				版权所有© 2013  kaku365
				<a href="javascript:alert ('用户协议页面');">
					使用前阅读用户协议
				</a>
			</p>
			<p>
				<a href="javascript:alert ('证件照片');">
					kaku365广告有限公司管理运营
				</a>|
				<a href="javascript:alert ('空');">
					企业注册号 511011000019348
				</a>|
				<a href="javascript:alert ('证件照片');">
					组织机构代码 56762831-7
				</a>|
				<a href="javascript:alert ('证件照片');">
					蜀ICP备13003878号-1
				</a>
			</p>
		</div>
		<!--底部信息结束-->
	</body>
</html>
