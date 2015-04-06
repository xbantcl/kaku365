<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div class="admin_page">
    <h3>新增品牌</h3>
    <ul class="list-group">
        <form method="post" enctype="multipart/form-data">
            <li class="list-group-item">名称：<input name="name" type="text" value="<?php if(isset($brands['name'])) echo $brands['name'];?>"/></li>
            <li class="list-group-item"><span style="float:left;">品牌标示：</span><input style="display:block;float:left;" name="image" type="file"/><span>支持格式jpg,png,gif.</span></li>
            <?php if(isset($brands['image'])) echo "<li><img src=\"{$brands['image']}\" height='100' width='100'></li>";?>
            <li class="list-group-item">排序：<input name="rank" type="text" value="<?php if(isset($brands['rank'])) echo $brands['rank'];?>"/><span>&nbsp;&nbsp;数字范围为0~255，数字越小越靠前</span></li>
            <li class="list-group-item" class="c_col8"><input class="btn btn-primary" type="submit" value="提交"></li>
        </form>
    </ul>
</div>
</body>
</html>