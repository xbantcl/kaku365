<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="http://linkagesel.xiaozhong.biz/js/jquery.js"></script>
    <link href="/static/css/admin.css" rel="stylesheet" type="text/css">
        <script src="/static/js/jquery.ztree.all-3.5.js"></script>
    <link href="/static/css/zTreeStyle.css" rel="stylesheet" type="text/css">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div class="admin_page">
    <script>
        var setting = {
            view: {
                selectedMulti: false
            },
            edit: {
                enable: true,
                showRemoveBtn: false,
                showRenameBtn: false
            },
            async: {
                enable: true,
                url:"/admin/getCategoryTreeAjax"
            },
            data: {
                keep: {
                    parent:true,
                    leaf:true
                },
                simpleData: {
                    enable: true
                }
            },
            callback: {
                beforeDrag: beforeDrag,
                beforeAsync: beforeAsync,
                onAsyncError: onAsyncError,
                onAsyncSuccess: onAsyncSuccess,
                beforeRemove: zTreeBeforeRemove,
                onRemove: zTreeOnRemove,
                beforeEditName: zTreeBeforeEditName
            }
        };
        function zTreeBeforeEditName(treeId, treeNode) {
            window.location.href = "/admin/categoryUpdate/" + treeNode.id + "/";
            return false;
        }
        function zTreeBeforeRemove(treeId, treeNode) {
            className = (className === "dark" ? "":"dark");
            showLog("[ "+getTime()+" beforeRemove ]&nbsp;&nbsp;&nbsp;&nbsp; " + treeNode.name);
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            zTree.selectNode(treeNode);
            if(!treeNode.isParent)
                return confirm("确认删除 目录 -- " + treeNode.name + " 吗？");
            else
                return false;
        }
        function zTreeOnRemove(event, treeId, treeNode) {
            $.ajax({url : "/manager/category_delete/",
                cache : false,
                type : "post",
                async : false,
                dataType: "json",
                data:{id:treeNode.id},
                success : function (result) {
                    alert(result.msg)
                }
            });
        }
        function beforeDrag(treeId, treeNodes) {
            return false;
        }
        function beforeClick(treeId, treeNode) {
            if (!treeNode.isParent) {
                alert("请选择父节点");
                return false;
            } else {
                return true;
            }
        }
        var log, className = "dark";
        function beforeAsync(treeId, treeNode) {
            className = (className === "dark" ? "":"dark");
            showLog("[ "+getTime()+" beforeAsync ] ;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
            return true;
        }
        function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) {
            showLog("[ "+getTime()+" onAsyncError ] ;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
        }
        function onAsyncSuccess(event, treeId, treeNode, msg) {
            showLog("[ "+getTime()+" onAsyncSuccess ] ;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
        }
        function showLog(str) {
            console.log(str)
        }
        function getTime() {
            var now= new Date(),
                h=now.getHours(),
                m=now.getMinutes(),
                s=now.getSeconds(),
                ms=now.getMilliseconds();
            return (h+":"+m+":"+s+ " " +ms);
        }
        function setEdit() {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
                removeTitle = "删除",
                renameTitle = "重命名";
            zTree.setting.edit.showRemoveBtn = true;
            zTree.setting.edit.showRenameBtn = true;
            zTree.setting.edit.removeTitle = removeTitle;
            zTree.setting.edit.renameTitle = renameTitle;
        }
        function showCode(str) {
            var code = $("#code");
            code.empty();
            for (var i=0, l=str.length; i<l; i++) {
                code.append("<li>"+str[i]+"</li>");
            }
        }

        $(document).ready(function(){
            $.fn.zTree.init($("#treeDemo"), setting);
            setEdit();
            $("#remove").bind("change", setEdit);
            $("#rename").bind("change", setEdit);
            $("#removeTitle").bind("propertychange", setEdit)
                .bind("input", setEdit);
            $("#renameTitle").bind("propertychange", setEdit)
                .bind("input", setEdit);
        });
    </script>
    <h3>分类管理</h3>
    <div class="zTreeDemoBackground left" style=" background-color: #f3f3f3; ">
        <ul id="treeDemo" class="ztree"></ul>
    </div>
</div>
</body>
</html>