<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>商家管理后台</title>
    <script src="/static/js/jquery-1.9.1.min.js"></script>
    <script src="/static/js/admin.js"></script>
    <script src="/static/js/jquery.validate.min.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/static/css/simple.css" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style type="text/css">
    	.table th, .table td {
    		text-align: center;
		}
    </style>
</head>
<body>
<!--管理中心内容开始-->
<div class="admin_page">
    <h3>管理商品</h3>
    <div class="m_search">
        <form method="get">
            <span>商品名称：</span>
            <input name="name" type="text"/>
            <span>品牌：</span>
            <select name="brand_id">
                <option value=''>全部</option>
                <?php
                if (isset($brands)) {
                    foreach ($brands as $brand) {
                    	if ($brand['id'] == $brand_id) {
                        	echo "<option value='{$brand['id']}' selected='selected'>{$brand['name']}</option>";
                    	} else {
                    		echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                    	}
                    }
                }
                ?>
            </select>
            <span>状态：</span>
            <select name="status">
            	<?php 
            		if ($status == 'all') {
            			echo '<option value="all" selected="selected">全部</option>';
            			echo '<option value="1">显示</option>';
                		echo '<option value="0">隐藏</option>';
            		} elseif ($status == 1) {
            			echo '<option value="all">全部</option>';
            			echo '<option value="1" selected="selected">显示</option>';
            			echo '<option value="0">隐藏</option>';
            		} elseif ($status == 0) {
            			echo '<option value="all">全部</option>';
                		echo '<option value="1">显示</option>';
            			echo '<option value="0">隐藏</option>';
            		} else {
            			echo '<option value="all">全部</option>';
                		echo '<option value="1">显示</option>';
                		echo '<option value="0">隐藏</option>';
            		}
            	?>

            </select>
            <input type="submit" value="搜索"/>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width:5%;"><label><input id="SelectAll" type="checkbox" onclick="select_all()"/>全选</label></th>
            <th style="width:8%;">图片</th>
            <th style="width:8%;">名称</th>
            <th style="width:8%;">品牌</th>
            <th style="width:10%;">条码</th>
            <th>配料</th>
            <th style="width:4%;">状态</th>
            <th style="width:6%;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($goods))
        foreach($goods as $go)
        {
        ?>
        <tr class="admin_product">
            <td><input onclick="setSelectAll()" id="subcheck"  type="checkbox"/></td>
            <td><img src="<?php if(isset($go['images'][0]) && strlen($go['images'][0])) echo '/static/uploads/square/' . $go['images'][0];?>"></td>
            <td><?php echo $go['name'];?></td>
            <td><?php echo $go['brand_name'];?></td>
            <td><?= $go['product_code']?></td>
            <td><?= $go['product_ingredients']?></td>
            <td><?php if($go['status']) echo " 显示";else echo "隐藏";?></td>
            <td><a href="javascript:deleteGoodsTemplate('<?php echo $go['id'];?>');">删除</a> <a href="/admin/shop/updateGoods/<?php echo $go['id'];?>/">修改</a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <?php echo $pagination;?>

    <!--页码跳转结束-->
</div>
</body>
</html>