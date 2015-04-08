<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <script src="/static/js/linkagesel.js"></script>
    <script type="text/javascript" src="/static/js/jquery-1.9.1.min.js"></script>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div class="admin_page">
    <h3>更新分类</h3>
    <ul class="list-group">
        <form method="post" enctype="multipart/form-data">
            <li class="list-group-item">分类等级：<select name="leave">
                    <option value="1">一级分类</option>
                    <option value="2">二级分类</option>
                    <option value="3">三级分类</option>
                </select><span>新增一级分类隐藏归属，二级归属对应一级，三级归属对应二级</span></li>
            <li class="list-group-item">上级分类：<select id="p_category"></select></li>
            <input type="hidden" name="pid" id="pid" value="0">
            <li class="list-group-item">分类名称：<input name="name" type="text" value="<?php if(isset($category['name'])) echo $category['name'];?>"/></li>
            <li class="list-group-item">显示：<select name="status">
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select></li>
            <li class="list-group-item"s><input class="btn btn-primary" type="submit" value="更新"/></li>
        </form>
    </ul>
</div>
<script>
    var districtData =<?php echo json_encode($categorys);?>;
    $(document).ready(function () {
        var opts14 = {
            data: districtData,
            selStyle: 'margin-left: 3px;',
            loaderImg: '/static/images/ui-anim_basic_16x16.gif',
            select: '#p_category',
            head: '请选择',
            level: 2,
            autoLink: false
            <?php if($categorys_path)
            echo ",defVal: [$categorys_path]";?>
        };

        var linkageSel14 = new LinkageSel(opts14);

        linkageSel14.onChange(function () {
            var SelectedArr = this.getSelectedArr();
            for (var i = 0, len = SelectedArr.length; i < len; i++) {
                if (SelectedArr[i] > 0)
                    $("#pid").val(SelectedArr[i]);
            }
        });
    });
</script>
</body>
</html>