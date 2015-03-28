$(function() {
	/*
	 * 加载jquery.artDialog.min.js
	 */
	$.ajax({
        url: "/static/js/jquery.artDialog.min.js",
        dataType: "script",
        async : false,
        cache: true
	});
	
	/*
	 * 购物车展示
	 */
	$('#box').mouseover(function() {
		$('#box_content').show();
	})
    $('#box').mouseout(function() {
        $('#box_content').hide();
        //alert("a")
	});
	$('#box_content').mousemove(function() {
		$(this).show();
	})
    $('#box_content').mouseout(function() {
		$(this).hide();
        //alert("b")
	});

	/*
	 * 增加、减少购买商品数量
	 */
	$('#increase').click(function() {
		$('#quantum').val($('#quantum').val() * 1 + 1);
		return false;
	});
	$('#decrease').click(function() {
		if ($('#quantum').val() > 1) {
			$('#quantum').val($('#quantum').val() * 1 - 1);
		}
		return false;
	});

	/*
	 * 选择收货地址
	 */
	$('#choose_add').click(function() {
		$('#s_ol').toggle();
	});

	/*
	 * 添加收货地址
	 */
	$('#new_add').click(function() {
		$('#new_add_content').toggle();
	});

	/*
	 * 检查是否输入筛选条件
	 */
	$('#sub').click(function() {
		if ($('#tex').val().length < 1) {
			alert('请输入筛选内容.');
			return false;
		}
	});

	/*
	 * nav_left js toggle
	 */
	var aMenuOneLi = $(".menu-one > li");
	var aMenuTwo = $(".menu-two");
	$(".menu-one > li > .header").each(function(i) {
		$(this).click(function() {
			if ($(aMenuTwo[i]).css("display") == "block") {
				$(aMenuTwo[i]).slideUp(300);
				$(aMenuOneLi[i]).removeClass("menu-show")
			} else {
				for (var j = 0; j < aMenuTwo.length; j++) {
					$(aMenuTwo[j]).slideUp(300);
					$(aMenuOneLi[j]).removeClass("menu-show");
				}
				$(aMenuTwo[i]).slideDown(300);
				$(aMenuOneLi[i]).addClass("menu-show")
			}
		});
	});
	
	/*
	 * menu展示
	 */
	$('.divide').mouseover(function(){
		$(this).show();
	}).mouseout(function(){
		$(this).hide();
	});
	
	/*
	 * 删除品牌筛选标签
	 */
	$(document).on('click','#brand_s strong',function(){
		$(this).parent('span').remove();
		if($('#brand').is(':visible')==false){
			$('#brand').show();
		}
	});
	
	/*
	 * 删除价格筛选标签
	 */
	$(document).on('click','#price_s strong',function(){
		$(this).parent('span').remove();
		if($('#price').is(':visible')==false){
			$('#price').show();
		};
		var url = '/search/search_by_price';
		var shop_id = $('input[name=shop_id]').val();
		var cate = $('#category_s i').attr('id');
		var cate_id = '';
		cate_id = cate.split('_');
		$.post(url,{
			'shop_id' : shop_id,
			'cate_id' : cate_id[1],
			's_price' : 0,
			'e_price' : 100000
		},function(result){
			$('#main').html(result);
		});
	});
	
	/*
	 * 品牌筛选toggle展示
	 */
	$('#btn1').click(function(){
		$height = $('#brand_c').css('height');
		$auto_height = $('#brand_c').css('height', 'auto').height();
		if($height == '60px'){
			$('#btn1 img').attr('src','/static/images/1-new-open-1.jpg');
			$('#brand_c').height($height).animate({height:$auto_height});
		}else{
			$('#btn1 img').attr('src','/static/images/1-new-close.jpg');
			$('#brand_c').animate({height:'60px'});
		}
	});
	
	/*
	 * 分类筛选toggle展示
	 */
	$('#btn_cate').click(function(){
		$height = $('#classify_c').css('height');
		$auto_height = $('#classify_c').css('height', 'auto').height();
		if($height =='50px'){
			$('#btn_cate img').attr('src','/static/images/1-new-open-1.jpg');
			$('#classify_c').height($height).animate({height:$auto_height});
		}else{
			$('#btn_cate img').attr('src','/static/images/1-new-close.jpg');
			$('#classify_c').animate({height:'50px'});
		}
	});
	
	/*
	 * 追加商品品牌筛选信息
	 */
	$('#brand_c a').click(function(){
		var brand = $(this).html().split('<');
		var span = "<span id='brand_s'><em>品牌：</em><i>"+brand[0]+"</i><strong></strong></span>";
		$('#hint p').append(span);
		$('#brand').hide();
	});
	
	/*
	 * 更换商品分类筛选信息
	 */
	$('#classify_c a').click(function(){
		var category = $(this).html();
		var span = "<span id='category_s'><em>分类：</em><i>"+category+"</i></span>";
		$('#category_s').html(span);
	});
	
	/*
	 * 商品价格筛选信息
	 */
	$('#price a').click(function(){
		var price_id = $(this).attr('id');
		if(price_id == 'price_1'){
			var s_price = 0;
			var e_price = 49;
		}else if(price_id == 'price_2'){
			var s_price = 50;
			var e_price = 100;
		}else if(price_id == 'price_3'){
			var s_price = 101;
			var e_price = 200;
		}else if(price_id == 'price_4'){
			var s_price = 201;
			var e_price = 300;
		}else if(price_id == 'price_5'){
			var s_price = 301;
			var e_price = 100000;
		}
		var price = $(this).html();
		var span = "<span id='price_s'><em>价格：</em><i>"+price+"</i><strong></strong></span>";
		$('#hint p').append(span);
		$('#price').hide();
		var url = '/search/search_by_price';
		var shop_id = $('input[name=shop_id]').val();
		var cate = $('#category_s i').attr('id');
		var cate_id = cate.split('_');
		$.post(url,{
			'shop_id' : shop_id,
			'cate_id' : cate_id[1],
			's_price' : s_price,
			'e_price' : e_price
		},function(result){
			$('#main').html(result);
		});
	});
	
	/*
	 * sort 上下页动态效果
	 */
	$('#page img:eq(0)').mouseover(function(){
		$(this).attr('src','/static/images/up.jpg');
	}).mouseout(function(){
		$(this).attr('src','/static/images/on_up.jpg');
	});
	$('#page img:eq(1)').mouseover(function(){
		$(this).attr('src','/static/images/down.jpg');
	}).mouseout(function(){
		$(this).attr('src','/static/images/on_down.jpg');
	});
	
	/*
	 * 限制商家简介字数
	 */
	$('#c_sub').click(function(){
		introduce = $('#introduce').val();
		if(introduce.length > 140 ){
			alert('简介应少于140个字。');
			return false;
		}
	});
	
});

function show_menu($id) {
	$('#menu_' + $id).show().siblings().hide();
}

function hide_menu($id){
	$('#menu_' + $id).hide();
}

function get_goods($shop_id, $category_pid, $category_id) {
	var url = '/shop/goods';
	$.post(url, {
		'shop_id': $shop_id,
		'category_pid': $category_pid,
		'category_id': $category_id
	}, function(result) {
		$('#' + $category_pid).html(result);
	});
};

/*
 * 确认密码是否相同
 */
function check_pwd() {
	var first = $('#password').val();
	var second = $('#s_password').val();
	if (second == '') {
		$("#error_s_password").css("color", "red");
		$('#error_s_password').html('请输入确认密码.');
		return false;
	}
	if (first != second) {
		$("#error_s_password").css("color", "red");
		$('#error_s_password').html('两次输入的密码不一致');
	} else {
		$("#error_s_password").css("color", "green");
		$('#error_s_password').html('恭喜,密码确认成功');

	}
}

/*
 * 更新验证码
 */
function change_captcha() {
	$('#captcha').attr('src', '/user/captcha/' + Math.random());
}

/*
 * 检查用户名是否存在
 */
function check_username() {
	var username = $('#username').val();
	if (username == '') {
		$("#error_username").css("color", "red");
		$('#error_username').html('请输入帐号.');
		return false;
	}
	var url = '/user/check_username';
	$.post(url, {
		'username': username
	}, function(result) {
		if (result == 'true') {
			$("#error_username").css("color", "green");
			$('#error_username').html('恭喜,用户名可用');
		} else if (result == 'false') {
			$("#error_username").css("color", "red");
			$('#error_username').html('此用户名已被注册');
		}
	});
}

/*
 * 检查邮箱是否存在
 */
function check_email() {
	var email = $('#email').val();
	if (email == '') {
		$("#error_email").css("color", "red");
		$('#error_email').html('请输入邮箱.');
		return false;
	}
	var url = '/user/check_email';
	$.post(url, {
		'email': email
	}, function(result) {
		if (result == 'true') {
			$("#error_email").css("color", "green");
			$('#error_email').html('恭喜,邮箱可用');
		} else {
			$("#error_email").css("color", "red");
			$('#error_email').html('此邮箱已被注册');
		}
	});
}

/*
 * 从购物车中删除物品
 */
function del_cart($cart_id) {
	if (confirm('确认删除吗?')) {
		var url = '/user/del_cart';
		$.post(url, {
			'cart_id': $cart_id
		}, function(result) {
			if (result == 'success') {
				$('tr[id=' + $cart_id + ']').remove();
				$('li[id=' + $cart_id + ']').remove();
				balance();
			} else {
				alert('删除失败.');
			}
		});
	}
}

/*
 * 从购物车中批量删除物品
 */
function del_carts() {
	if (confirm('确认删除吗?')) {
		var cart_id = new Array();
		$(':checkbox:checked[name=cart_id]').each(function() {
			cart_id.push($(this).val());
		});
		var url = '/user/del_cart';
		$.post(url, {
			'cart_id': cart_id
		}, function(result) {
			if (result == 'success') {
				$(':checkbox:checked[name=cart_id]').each(function() {
					$(this).parents('tr').remove();
				});
				balance();
			} else {
				alert('删除失败.');
			}
		});
	}
}

/*
 * 将商品添加到用户的收藏中
 */
function join_collect($goods_id) {
	var url = '/user/join_collect';
	$.post(url, {
		'goods_id': $goods_id
	}, function(result) {
		if (result == 'true') {
			alert('收藏成功.');
		} else if (result == 'false') {
			alert('收藏失败.');
		} else if (result == 'had') {
			alert('该商品已经收藏.');
		}
	});
}

/*
 * 添加订单
 */
function join_order($shop_id) {
	var url = '/cart/join_order';
	var address_id = $('input:radio:checked').val();
	if (!address_id) {
		alert('请选择收货地址.');
		return false;
	}
	var $carts = new Array();
	$(':checkbox:checked[name=cart_id]').each(function() {
		$carts.push($(this).val());
	});
	if ($carts.length == 0) {
		alert('无商品.');
		return false;
	}
	$.post(url, {
		'shop_id': $shop_id,
		'address_id': address_id,
		'carts': $carts
	}, function(result) {
		if (result == 'false') {
			alert('订单提交失败.');
		} else {
			var surl = '/user/order';
			location.href = surl;
		}
	})

}

/*
 * 将商品从用户收藏中删除
 */
function del_collect($collect_id) {
	if (confirm('确认删除吗?')) {
		var url = '/user/del_collect';
		$.post(url, {
			'collect_id': $collect_id
		}, function(result) {
			$('#r_content').html(result);
		});
	}
}

/*
 * 将所选全部商品从用户收藏中删除
 */
function del_collects() {
	if (confirm('确认删除吗?')) {
		var goods_id = new Array();
		$(':checkbox:checked[name=goods_id]').each(function() {
			goods_id.push($(this).val());
		});
		var url = '/user/del_collect';
		$.post(url, {
			'goods_id': goods_id
		}, function(result) {
			$('#r_content').html(result);
		});
	}
}

/*
 * 用户订单详情获取
 */
function order_detail($order_id) {
    location.href = "/user/order_detail/" + $order_id
	/*var url = '/user/order_detail';
	$.post(url, {
		'order_id': $order_id
	}, function(result) {
		$('#order_detail').html(result);
	});*/
}

/*
 * 筛选订单信息再获取订单
 */
function order_selection() {
	var url = '/user/order_selection';
	var terms = $('select[name="terms"]').val();
	$.post(url, {
		'terms': terms
	}, function(result) {
		$('#r_content').html(result);
		$('select[name="terms"]').val(terms);
	});
}

/*
 * 将物品从订单中移除(退货)
 */
function return_goods($order_detail_id) {
	if (confirm('确认退货吗?')) {
		var url = '/user/return_goods';
		$.post(url, {
			'order_detail_id': $order_detail_id
		}, function(result) {
			if (result == 'cant') {
				alert('对不起,现在不能退货.');
			} else if (result == 'false') {
				alert('对不起,退货失败.');
			} else {
				$('#order_detail').html(result);
			}
		});
	}
}

/*
 * 将商品添加到用户的购物车
 */
function join_cart($goods_id, $shop_id) {
	var url = '/user/join_cart';
	$.post(url, {
		'goods_id': $goods_id,
		'shop_id': $shop_id,
        'amount':$('#quantum').val()
	}, function(result) {
		if (result == 'true') {
			update_cart_status();
            //alert("添加成功");
            window.alert('添加成功！');
		} else if (result == 'no_login') {
			alert('你还没有登录,请登录之后再添加商品到你的购物车.');
		} else if (result == 'false') {
			alert('添加失败.');
		} else if (result == 'had') {
			alert('已经添加到购物车,请勿重复添加.');
		} else if (result == 'error') {
			if (confirm('添加的商品不属于当前购物车店铺.清空当前购物车?')) {
				var url = '/user/clear_cart';
				$.post(url, function(result) {
					if (result == 'success') {
						alert('清空成功.请重新添加.');
					} else {
						alert('清空失败.');
					}
				})
			}
		}
	});
}

/*
 * 更新购物车状态
 */
function update_cart_status() {
	var num = $('#box span').html() * 1 + 1;
	$('#box span').html(num);
}

/**
 * 多选添加至购物车.
 */
function join_carts() {
	var goods_id = new Array();
	$(':checkbox:checked[name=goods_id]').each(function() {
		goods_id.push($(this).val());
	});
	var url = '/user/join_cart';
	$.post(url, {
		'goods_id': goods_id
	}, function(result) {
		if (result == 'true') {
			alert('添加成功.');
		} else if (result == 'false') {
			alert('添加失败.');
		} else if (result == 'had') {
			alert('已经添加到购物车,请勿重复添加.');
		}
	});
}

/*
 * 删除收获地址
 */
function del_address($address_id) {
	if (confirm('确认删除吗?')) {
		var url = '/user/del_delivery_address';
		$.post(url, {
			'address_id': $address_id
		}, function(result) {
			if (result == 'false') {
				alert('删除失败.');
			} else {
				$('#r_content').html(result);
                window.location.reload();
			}
		});
	}
}

/*
 * check全选
 */
function select_all() {
	if ($("#SelectAll").prop("checked")) {
		$(":checkbox").prop("checked", true);
	} else {
		$(":checkbox").prop("checked", false);
	}
}

/*
 * 子复选框的事件
 */
function setSelectAll() {
	//当没有选中某个子复选框时，SelectAll取消选中  
	if (!$("#subcheck").checked) {
		$("#SelectAll").prop("checked", false);
	}
	var chsub = $("input[type='checkbox'][id='subcheck']").length; //获取subcheck的个数  
	var checkedsub = $("input[type='checkbox'][id='subcheck']:checked").length; //获取选中的subcheck的个数  
	if (checkedsub == chsub) {
		$("#SelectAll").prop("checked", true);
	}
}

function alert(msg)
{
    $.dialog({
        lock: true,
        fixed: true,
        content:msg
    });
}
function show_goods(id)
{
    location.href = "/goods/view/" + id;
    /*$.ajax({
        url : "/goods/view_ajax/"+id,
        cache : true,
        type : "GET",
        async : false,
        success : function (result){
            $.dialog({
                lock: true,
                fixed: true,
                content:result
            });
        }
    });*/
}
function show_shop_search(id,cateid)
{
    location.href = "/search/filter/?cateid="+cateid+"&shop_id=" + id;
    /*$.ajax({
        url : "/goods/view_ajax/"+id,
        cache : true,
        type : "GET",
        async : false,
        success : function (result){
            $.dialog({
                lock: true,
                fixed: true,
                content:result
            });
        }
    });*/
}
$(window).scroll(function () {

    if ($(window).scrollTop() >= $("#nav").offset().top )
    {

        $("#nav").css("position","fixed").css("top","0px");
        $("#js_divide").css("position","fixed").css("top","40px");
    }
    if ($(window).scrollTop()+40 <= $("#top_fixed").offset().top )
    {
        $("#nav").css("position","").css("top","");
        $("#js_divide").css("position","").css("top","");
    }
});