<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>商家管理后台</title>
    <script src="/static/js/jquery-1.4.4.min.js"></script>
    <script src="/static/js/linkagesel.js"></script>
    <script src="/static/js/admin.js"></script>
    <script src="/static/js/jquery.validate.min.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/static/css/manager.css" rel="stylesheet" type="text/css">
    <link href="/static/css/member.css" rel="stylesheet" type="text/css">
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
    <h3>新增商品</h3>
    <h4>商品信息</h4>
    <form id="addGoods-form" method="post" enctype="multipart/form-data">
        <ul class="list-group">
            <li class="list-group-item">名称：<input name="name" type="text" value="<?php echo $goods['name'];?>" /></li>
            <li class="list-group-item">品牌：<select name="brand_id">
            	<option value="-1">请选择品牌</option>
                    <?php
                    if(isset($brands))
                        foreach($brands as $brand)
                        {
                        	if ($goods['brand_id'] == $brand['id']) {
                            	echo "<option value='{$brand['id']}' selected='selected'>{$brand['name']}</option>";
                        	} else {
                        		echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                        	}
                        }
                    ?>
                 </select>
            </li>
            <li class="list-group-item">净含量：<input name="net_content" type="text" value="<?php echo $goods['net_content'];?>"/></li>
            <li class="list-group-item">单位：<input name="format" type="text" value="<?php echo $goods['format'];?>"/></li>
            <li class="list-group-item">商品编码：<input name="product_code" type="text" value="<?php echo $goods['product_code'];?>"/></li>
            <li class="list-group-item" style="vertical-align:middle;">产品配料：<textarea style="vertical-align:middle;" name="product_ingredients" style="width: 250px;
height: 85px;" value=""><?php echo $goods['product_ingredients'];?></textarea></li>
            <li class="list-group-item">保质期：<input name="shelf_life" type="text" value="<?php echo $goods['shelf_life'];?>"/></li>
        </ul>
        <h4>商品图片</h4>
        <?php
        foreach($goods['images'] as $img)
        {
            if(strlen($img))
            echo "<img src=\"/static/uploads/admin_goods/$img\"/ style=\" height: 100px; width: 100px;margin: 10px;\">";
        }
        ?>
        <br/>
        <br/>
        <br/>
        <h4>替换商品图片</h4>
    	<table class="table table-bordered">
    		<tr>
    			<td><input name="images[]" type="file"/></td>
    			<td><input name="images[]" type="file"/></td>
    		</tr>
    	    <tr>
    			<td><input name="images[]" type="file"/></td>
    			<td><input name="images[]" type="file"/></td>
    		</tr>
    	    <tr>
    			<td><input name="images[]" type="file"/></td>
    			<td><input name="images[]" type="file"/></td>
    		</tr>
    	</table>
    	<div><center><input id="addGoods" class="btn btn-primary" type="button" value="提交"></center></div>
    </form>
</div>
<!--管理中心右内容结束-->
</body>
</html>