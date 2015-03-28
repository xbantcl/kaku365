<script>
    function send_goods(status)
    {
        $.ajax({
            url : location.href,
            cache : false,
            type : "GET",
            async : false,
            dataType: "json",
            data:{send_goods:status},
            success : function (result){
                alert(result.msg);
            }
        });
    }
</script>
<div class="c_right">
    <h3>订单详情</h3>
    <table>
        <thead>
        <tr>
            <th>图片</th>
            <th>条码</th>
            <th>名称</th>
            <th>单位</th>
            <th>单价</th>
            <th>数量</th>
            <th>备注</th>
            <th>小计</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($details)) {
            foreach ($details as $br) {
                echo "
        <tr>
            <td><img src=\"/static/uploads/square/{$br['goods_iamge']}\" height='50' width='50'/></td>
            <td>{$br['product_code']}</td>
            <td><a href=\"/good/views/{$br['id']}/\">{$br['goods_name']}</a></td>
            <td>{$br['format']}</td>
            <td style=\" font-size: 16px; color: #F00; \">￥{$br['goods_price']}</td>
            <td>{$br['amount']}</td>
            <td>{$br['detail']}</td>
            <td style=\" font-size: 16px; color: #F00;\">￥{$br['subtotal']}</td>
        </tr>
        ";
            }
        } ?>
        </tbody>
    </table>
    </br>
    <div class="o_result" style=" text-align: left; height: 80px; width: 100%; margin-bottom: 10px; ">
    <p>客户姓名：<?php echo $orders['user_name'];?></p>
    <p>用户电话：<?php echo $orders['user_tel'];?></p>
    <p>用户地址：<?php echo $orders['user_address'];?></p>

        总计：<span id="number"><?= count($details)?></span>件商品
        总金额：￥<span id="total"><?= empty($orders['price']) ? 0 : $orders['price']?></span>
    </div>
    <button style="float:right" onclick="send_goods(2)">发货</button>
    <br/>
    <br/>
    <button style="float:right" onclick="send_goods(3)">废除</button>


</div>
