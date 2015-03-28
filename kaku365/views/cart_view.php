<!DOCTYPE html>

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>kaku365</title>
        <link href="<?=base_url() ?>static/css/basic.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url() ?>static/css/simple.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url() ?>static/css/shopping.css" rel="stylesheet" type="text/css">
        <script src="/static/js/jquery-1.11.1.min.js"></script>
        <script src="<?=base_url() ?>static/js/jquery.artDialog.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?=base_url() ?>static/js/basic.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?=base_url() ?>static/js/cart.js" type="text/javascript" charset="utf-8"></script>
        <script src="<?=base_url() ?>static/js/PCASClass.js" type="text/javascript" charset="utf-8"></script>
        <script>
            $(function(){
                select_all();
            });

            jQuery(function($) {
                $('.amount').focus(function(){
                    $(this).bind("keyup", function() {
                        var t = $(this).val();
                        if(isNaN(t)){
                            $(this).val(1);
                        }

                        var cartid = $(this).siblings('.cartId').val();
                        update_amount(cartid);
                        sumtotal(cartid);
                        TxtChange();
                    });
                });
            });
            function TxtChange() {

                balance();
            }
        </script>
        </head>
        <body>
<!--头部信息开始-->
<?php require_once ('common/common_header.php'); ?>
<!--头部信息结束-->
<?php if(!empty($carts)):?>
<!--购物车列表开始-->
<h2>购物车列表</h2>
<table>
          <thead>
    <tr>
              <td><input id="SelectAll" type="checkbox" onclick="select_all()" checked />
        全选</td>
              <td class="col2">图片</td>
              <td class="col2">条码</td>
              <td class="col3">商品</td>
              <td class="col4">单价（元）</td>
              <td class="col5">数量</td>
              <td class="col6">小计</td>
              <td class="col7">备注</td>
              <td class="col8">操作</td>
            </tr>
  </thead>
          <tbody>
    <?php foreach($carts as $c):?>
    <tr class="item" id="<?=$c['id']?>">
        <td class="col1">
            <input onclick="setSelectAll()" id="subcheck" type="checkbox" name="cart_id" value="<?=$c['id']?>" checked/>
          	<input type="hidden" name="goods_id" value="<?=$c['goods_id']?>"/></td>
        <td class="col2"><a href="<?=site_url('goods/view').'/'.$c['goods_id']?>"> <img width="60px" height="60px" src="/static/uploads/square/<?=$c['goods_img']?>"/> </a></td>
        <td class="col2"><?=$c['goods_code']?></td><!--这个地方为什么呢？-->
        <td class="col3"><a href="<?=site_url('goods/view').'/'.$c['goods_id']?>"><?=$c['goods_name']?></a></td>
        <td class="col4"><span id="price">￥<?=$c['goods_price']?></span>
            <input type="hidden" name="price" value="<?=$c['goods_price']?>" /></td>
        <td class="col5"><a onclick="reduce(<?=$c['id']?>)" class="col5_jian">-</a>
        	<input onblur="number_change(<?=$c['id']?>)" name="amount" id="amount" class="amount" type="text" maxlength="2" value="<?=$c['amount']?>"/>
        	<input type="hidden" class="cartId" value="<?=$c['id']?>"/><a onclick="add(<?=$c['id']?>)">+</a></td>
        <td class="col6"><span id="subtotal">￥<?=$c['subtotal']?></span></td>
        <td class="col7"><textarea class="remarks"></textarea></td>
        <td class="col8"><a onclick="del_cart(<?=$c['id']?>)">删除</a> <a onclick="join_collect(<?=$c['goods_id']?>)">收藏</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
        </table>
        <!--购物车底部信息开始-->
<div class="clearing"> <a onclick="del_carts()">删除选中的商品</a> 总计：<span id="number"><?= empty($carts_count['number']) ? 0 : $carts_count['number']?></span>件商品,总金额：<span id="total">￥<?= empty($carts_count['total']) ? 0 : $carts_count['total']?></span></div>
<!--购物车底部信息结束--> 


<?php else:?>
<h1 align="center">您的购物车是空的哦</h1>
<?php endif;?>
<!--购物车列表结束--> 
<!--收货人信息开始-->
<div class="receiver_l">
          <h4 id="choose_add">选择收货地址</h4>
          <?php if(!empty($address)):?>
          <ol id="s_ol">
    <?php foreach($address as $a):?>
    <li>
              <input value="<?=$a['id']?>" name="shdz" type="radio"/>
              <b>姓名：</b>
              <?=$a['name']?>
              <b>联系电话：</b>
              <?=$a['phone']?>
              <b>地址：</b>
              <?=$a['address']?>
              <a onclick="del_address(<?=$a['id']?>)">删除</a> </li>
    <?php endforeach;?>
  </ol>
          <?php else:?>
          <h2>你没有设置过收获地址,现在就在下面添加一个吧.</h2>
          <?php endif;?>
          <h4 id="new_add">新增收货地址</h4>
          <div id="new_add_content">
    <form action="<?=site_url('user/insert_delivery_address')?>" method="post">
              <p style=" margin: 5px; "><b>姓名：</b>
        <input name="name" type="text" maxlength="8"/>
      </p>
              <p style=" margin: 5px; "><b>电话：</b>
        <input name="phone" type="text" maxlength="11"/>
        <input name="url" type="hidden" value="cart/index"/>
      </p>
              <p style=" margin: 5px; "><b>地址：</b>
                <select name="province">
                </select>
                <select name="city">
                </select>
                <select name="area">
                </select>
        <script language="javascript" defer>
							new PCAS("province","city","area");
						</script>
        <input name="address" type="text" maxlength="20"/>
      </p>
              <input class="add_sub" type="submit" value="确认">
              <input class="add_sub" type="reset" value="清空">
            </form>
  </div>
        </div>
<!--收货人信息结束--> 
<!--购物车提交按钮开始-->
<div class="btn_s"> <a onclick="join_order(<?=$shop_id?>)"> 提交订单 </a> <a href="<?=site_url('shop/index/').'/'.$shop_id ?>"> 继续购物 </a> </div>
<!--购物车提交按钮开始结束--> 
<!--底部信息开始-->
<?php require_once ('common/common_footer.php'); ?>
<!--底部信息结束-->
</body>
</html>