<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="/static/js/jquery-1.4.4.min.js"></script>
    <script src="/static/js/linkagesel.js"></script>
    <script src="/static/js/manager.js"></script>
    <script src="/static/js/jquery.validate.min.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/static/css/manager.css1" rel="stylesheet" type="text/css">
    <link href="/static/css/member.css1" rel="stylesheet" type="text/css">
    <link href="/static/css/simple.css1" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<!--管理中心内容开始-->
<div class="admin_page">
    <h3>商家管理</h3>
<!--管理中心右内容开始-->
    <form method="post" enctype="multipart/form-data">
    <ul class="list-group">
        <li class="list-group-item">商品分类：<select id="p_category"></select></li>
        <input type="hidden" id="category1" name="category1">
        <input type="hidden" id="category2" name="category2">
        <input type="hidden" id="category3" name="category3">
        <li class="list-group-item">名称：<input name="name" type="text" /></li>
        <li class="list-group-item">品牌：<select name="brand_id">
                <?php
                if(isset($brands))
                foreach($brands as $brand)
                {
                    echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                }
                ?>
                <option value="0">其它</option></select></li>
        <li class="list-group-item">价格：<input name="price" type="text" /></li>
        <li class="list-group-item">单位：<input name="format" type="text" /></li>
        <li class="list-group-item">商品编码：<input name="product_code" type="text" /></li>
        <li class="list-group-item" style="vertical-align:middle;">产品配料：<textarea style="vertical-align:middle;" name="product_ingredients"></textarea></li>
        <li class="list-group-item">保质期：<input name="shelf_life" type="text"/></li>
    </ul>
    <h4>商品图片</h4>
    <ol class="list-group">
        <li class="list-group-item"><input name="images[]" type="file"/></li>
        <li class="list-group-item"><input name="images[]" type="file"/></li>
        <li class="list-group-item"><input name="images[]" type="file"/></li>
        <li class="list-group-item"><input name="images[]" type="file"/></li>
        <li class="list-group-item"><input name="images[]" type="file"/></li>
        <li class="list-group-item"><input name="images[]" type="file"/></li>
    </ol>
    <div class="c_col8"><input class="btn btn-primary" type="submit" value="提交"></div>
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