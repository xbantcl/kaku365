<div class="order" id="r_content">
	<h3>我的订单</h3>
	<div class="order_select">
		<select name="terms">
			<option value="all">全部订单</option>
			<option value="dealing">处理中订单</option>
			<option value="done">已完成订单</option>
			<option value="month">近一月订单</option>
		</select>
		<input type="button" value="提交" onclick="order_selection()"/>
	</div>
	<table>
		<thead>
			<tr>
				<td>订单编号</td>
				<td>商家名称</td>
				<td>下单时间</td>
				<td>订单金额</td>
				<td>状态</td>
				<td>操作</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($orders as $o):
                $order_id = date("YmdHis",strtotime($o['created_at']));?>
				<tr>
				<td><?=$order_id?></td>
				<td><a href="<?=site_url('shop/index').'/'.$o['shop_id']?>"><?=$o['shop_name']?></a></td>
				<td><?=$o['created_at']?></td>
				<td class="tprice">￥<?=$o['price']?></td>
				<td>
					<?php if($o['status']==1):?>
                        待确认
					<?php elseif($o['status']==2):?>
						已发货
					<?php elseif($o['status']==3):?>
                        已取消
					<?php else:?>
						交易取消
					<?php endif;?>
				</td>
				<td><a onclick="order_detail(<?=$o['id']?>)">详情</a></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<p>您共有<b><?=$order_count->number?></b>张有效订单； 累计消费 <b><?=!empty($order_count->total)?$order_count->total:0;?></b> 元； 其中已成交订单共 <b><?=$order_s_count->s_number?></b> 张； 累积成交订单总金额 <b><?=!empty($order_s_count->s_total)?$order_s_count->s_total:0?></b> 元
	</p>
</div> 