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
                        echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
                    }
                }
                ?>
                <option value="0">全部</option>
            </select>
            <span>状态：</span>
            <select name="status">
                <option value="all">全部</option>
                <option value="1">显示</option>
                <option value="0">隐藏</option>
            </select>
            <input type="submit" value="搜索"/>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width:5%;"><label><input id="SelectAll" type="checkbox" onclick="select_all()"/>全选</label></th>
            <th style="width:8%;">图片</th>
            <th>名称</th>
            <th>品牌</th>
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
        <tr class="manage_product">
            <td><input onclick="setSelectAll()" id="subcheck"  type="checkbox"/></td>
            <td><a href="/goods/view/<?php echo $go['id'];?>"><img src="<?php if(isset($go['images'][0]) && strlen($go['images'][0])) echo '/static/uploads/square/' . $go['images'][0];?>"></a></td>
            <td><a href="/goods/view/<?php echo $go['id'];?>"><?php echo $go['name'];?></a></td>
            <td><?php echo $go['brand_id'];?></td>
            <td><?= $go['product_code']?></td>
            <td><?= $go['product_ingredients']?></td>
            <td><?php if($go['status']) echo " 显示";else echo "隐藏";?></td>
            <td><a href="javascript:deleteGoodsTemplate('<?php echo $go['id'];?>');">删除</a> <a href="/admin/shop/updateGoods/<?php echo $go['id'];?>/">修改</a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <div class="page_btn">
    </div>
    <!--页码跳转结束-->
</div>
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
                $("#category" + (i + 1)).val(SelectedArr[i]);
            }
        });
    });
</script>
</body>
</html>