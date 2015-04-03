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
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div class="admin_page">
    <h3>新增分类</h3>
    <ul class="list-group">
        <form id="add_category" method="post" enctype="multipart/form-data">
            <li class="list-group-item">分类等级：<select id="leave" name="leave">
                    <option value="1">一级分类</option>
                    <option value="2">二级分类</option>
                    <option value="3">三级分类</option>
                </select><span>新增一级分类隐藏归属，二级归属对应一级，三级归属对应二级</span></li>
            <li class="list-group-item">上级分类：<select id="p_category"></select></li>
            <input type="hidden" name="pid" id="pid" value="0">
            <li class="list-group-item">分类名称：<input name="name" type="text"/></li>
            <li class="list-group-item">显示：<select name="status">
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select></li>
            <li class="list-group-item"><input class="btn btn-primary" type="submit" value="提交"/></li>
        </form>
    </ul>
</div>
<script>
    var districtData =<?php echo json_encode($categorys);?>;
    /*
    $(document).ready(function () {
        var opts14 = {
            data: districtData,
           // ajax: '/admin/getCategoryAjax?',    // ajax与data配合获取未定义的下级数据
            selStyle: 'margin-left: 3px;',
            select: '#p_category',
            head: '请选择',
        };
        var linkageSel14 = new LinkageSel(opts14);
        linkageSel14.onChange(function () {
            var SelectedArr = this.getSelectedArr();
            for (var i = 0, len = SelectedArr.length; i < len; i++) {
                if (SelectedArr[i] > 0)
                    $("#pid").val(SelectedArr[i]);
            }
        });
        $('form#add_category').submit(function(){
            if($(".category option").length >= 7 && $("#p_category").val() <= 0)
            {
                alert("只能新建5个一级分类");
                return false;
            }
        });
    });
    */
    var data1 = {
            1: {name: '蔬菜', cell: { 10: {name: '菠菜', price: 4 }, 11: {name: '茄子', price: 5} }
            },
            3: {name: '水果', 
                cell: { 
                    20: {name: '苹果', cell: {201: {name: '红富士', price: 20}  } } ,
                    21: {name: '桃', 
                            cell: { 
                                210: {name: '猕猴桃', price: 30}, 
                                211: {name: '油桃', price: 31}, 
                                212: {name: '蟠桃', priece: 32} }
                    }
                }
            },
            9: {name: '粮食', 
                cell: { 
                    30: {name: '水稻',    cell: { 301: {name: '大米', cell: {3001: {name: '五常香米', price: 50}} } }   } 
                }
            }
        };
        var opts = {
                data: data1,
                select: '#p_category'
        };
        var linkageSel1 = new LinkageSel(opts);
</script>
</body>
</html>