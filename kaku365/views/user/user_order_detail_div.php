<div class="order_info" id="order_detail">
  <h3>订单信息</h3>
  <p>订单号：<?=$order_id?></p>
  <table>
    <thead>
      <tr>
        <td><input id="SelectAll" type="checkbox" onclick="select_all()"/>全选</td>
        <td>图片</td>
        <td>条码</td>
        <td>名称</td>
        <td>单价</td>
        <td>数量</td>
        <td>小计</td>
        <td>备注</td>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    <?php foreach($order_detail as $d):?>
    <tr>
        <td><input onclick="setSelectAll()" id="subcheck" type="checkbox" name="goods_id" value="<?=$d['goods_id']?>"/></td>
        <td><a href="<?=site_url('goods/view').'/'.$d['goods_id']?>"><img width="65px" src="/static/uploads/square/<?=$d['goods_iamge']?>"></a></td>
        <td class="pro_code"><?=$d['product_code']?></td>
        <td class="tcol"><a href="<?=site_url('goods/view').'/'.$d['goods_id']?>"><?=$d['goods_name']?></a></td>  
       
        <td class="tprice">￥<?=$d['goods_price']?></td>
        <td><?=$d['amount']?></td>
        <td class="tprice">￥<?=$d['subtotal']?></td>
        <td class="detail"><?=$d['detail']?></td>
        <?php if($d['status'] == 1):?>
        <td class="operate"><a onclick="join_collect(<?=$d['goods_id']?>)">收藏</a></td>
        <?php endif;?>
    </tr>
    <?php endforeach;?>
    </tbody>
  </table>
	<div class="o_result">
		<a onclick="join_carts()">所选商品放入购物车</a> 
		总计：<span><?=$details_count->number?></span>件商品
		总金额：<span>￥<?=$details_count->total?></span>
	</div>
</div>