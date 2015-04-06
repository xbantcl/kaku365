<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="/static/js/jquery-1.4.4.min.js"></script>
    <script src="/static/js/admin.js"></script>
    <script src="/static/js/jquery.validate.min.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<!--管理中心内容开始-->
<div class="admin_page">
    <h3>添加商品模板</h3>
<!--管理中心右内容开始-->
    <form id="addGoods-form" method="post" enctype="multipart/form-data">
    <ul class="list-group">
        <li class="list-group-item">名称：<input name="name" type="text" /></li>
        <li class="list-group-item">品牌：
        	<select name="brand_id">
        	<option value="-1">请选择品牌</option>
        	<?php
        		if(!empty($brands)) {
                	foreach($brands as $brand)
                	{
                    	echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                	}
        		}
        	?>
        	</select>
       	</li>
        <li class="list-group-item">净含量：<input name="net_content" type="text" /></li>
        <li class="list-group-item">单位：<input name="format" type="text" /></li>
        <li class="list-group-item">商品编码：<input name="product_code" type="text" /></li>
        <li class="list-group-item" style="vertical-align:middle;">产品配料：<textarea style="vertical-align:middle;" name="product_ingredients"></textarea></li>
        <li class="list-group-item">保质期：<input name="shelf_life" type="text"/></li>
    </ul>
    <h4>商品图片</h4>
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
<script>
    var districtData =<?php echo json_encode($categorys);?>;
    $(document).ready(function () {
        var opts14 = {
            data: districtData,
            ajax: '/manager/get_category_ajax/?',    // ajax与data配合获取未定义的下级数据
            selStyle: 'margin-left: 3px;',
            loaderImg: '/static/images/ui-anim_basic_16x16.gif',
            select: '#p_category',
            head: '请选择',
            level: 3,
            autoLink: false
        };

        var linkageSel14 = new LinkageSel(opts14);

        linkageSel14.onChange(function () {
            var SelectedArr = this.getSelectedArr();
            for (var i = 0, len = SelectedArr.length; i < len; i++) {
                $("#category" + (i+1)).val(SelectedArr[i]);
            }
        });
    });
</script>
</body>
</html>