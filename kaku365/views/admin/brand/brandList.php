<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/static/css/manager.css" rel="stylesheet" type="text/css">
    <script src="/static/js/jquery-1.4.4.min.js"></script>
    <script src="/static/js/admin.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/simple.css" rel="stylesheet" type="text/css">
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style type="text/css">
    	.table th, .table td {
    		text-align: center;
		}
		.admin_page {
			width: 60%;
		}
    </style>
</head>
<body>
<div class="admin_page">
    <h3>管理品牌</h3>

    <div class="m_search">
        <form method="get">
            品牌名称：<input name="name" type="text"/>
            <input type="submit" value="搜索"/>
        </form>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width:1%;">序号</th>
            <th style="width:10%;">品牌名称</th>
            <th style="width:2%;">排序</th>
            <th style="width:5%;">图片标示</th>
            <th style="width:5%;">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($brands))
            foreach($brands as $br)
            {
               echo "
        <tr>
            <td>{$br['id']}</td>
            <td>{$br['name']}</td>
            <td>{$br['rank']}</td>
            <th><img src=\"{$br['image']}\" height='50' width='50'></th>
            <td><a href=\"javascript:;\" onClick=\"deleteBrands({$br['id']});\">删除</a> <a href=\"/admin/updateBrands/{$br['id']}/\">修改</a></td>
        </tr>
        ";}?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <div class="page_btn">
        <?php if(isset($preview_page)) echo "<a href=\"$preview_page\">&lt;&nbsp;上一页</a>";?>
        <?php if(isset($next_page)) echo "<a href=\"$next_page\">下一页&nbsp;&gt;</a>";?>
    </div>
    
    <!--页码跳转结束-->
</div>
</body>
</html>