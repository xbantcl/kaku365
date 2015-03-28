<div class="c_right">
    <h3>订单管理</h3>

    <div class="m_search">
        <form method="get">
            <div class="m_search">
                <span>订单状态：<select name="status">
                        <option value="0" <?php if(isset($_GET['status']) && $_GET['status'] == 0) echo 'selected';?>>全部订单</option>
                        <option value="1" <?php if(isset($_GET['status']) && $_GET['status'] == 1) echo 'selected';?>>未处理</option>
                        <option value="2" <?php if(isset($_GET['status']) && $_GET['status'] == 2) echo 'selected';?>>已处理</option>
                        <option value="3" <?php if(isset($_GET['status']) && $_GET['status'] == 3) echo 'selected';?>>已废除</option>
                    </select></span><input type="submit" value="搜索">
            </div>
        </form>
    </div>
    <table>
        <thead>
        <tr>
            <th>订单号</th>
            <th>客户名称</th>
            <th>下单时间</th>
            <th>订单金额</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($orders)) {
            foreach ($orders as $br) {
                $order_id = date("YmdHis",strtotime($br['created_at']));
                echo "
        <tr>
            <td>{$order_id}</td>
            <td>{$br['user_name']}</td>
            <td>{$br['created_at']}</td>
            <td>{$br['price']}</td>
            <th>{$status[$br['status']]}</th>
            <td><a href=\"/manager/order_detail/{$br['id']}/\">查看详情</a></td>
        </tr>
        ";
            }
        } ?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <div class="page_btn">
        <?php if (isset($preview_page)) {
            echo "<a href=\"$preview_page\">&lt;&nbsp;上一页</a>";
        } ?>
        <?php if (isset($next_page)) {
            echo "<a href=\"$next_page\">下一页&nbsp;&gt;</a>";
        } ?>
    </div>
    
    <!--页码跳转结束-->
</div>