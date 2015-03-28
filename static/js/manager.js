function delete_goods(id)
{
    $.dialog({
        content: "确认删除这个商品吗，无法找回！",
        lock: true,
        fixed: true,
        okValue: '删除',
        ok: function () {
            $.ajax({
                url : "/manager/delete_goods/"+id+"/",
                type : "POST",
                async : false,
                dataType: "json",
                data:{id:id},
                success : function (result){
                    $.dialog({
                        content:result.msg,
                        time:2000
                    });
                }
            });
        },
        cancelValue:"取消",
        cancel:true
    });
}
function delete_brands(id)
{
    $.dialog({
        content: "确认删除这个品牌吗，无法找回！",
        lock: true,
        fixed: true,
        okValue: '删除',
        ok: function () {
            $.ajax({
                url : "/manager/delete_brands/"+id+"/",
                type : "POST",
                async : false,
                dataType: "json",
                data:{id:id},
                success : function (result){
                    $.dialog({
                        content:result.msg,
                        time:2000
                    });
                }
            });
        },
        cancelValue:"取消",
        cancel:true
    });
}
function show_goods(id)
{
    $.dialog({
        content: "确认显示这个商品吗?",
        lock: true,
        fixed: true,
        okValue: '删除',
        ok: function () {
            $.ajax({
                url : "/manager/delete_goods/"+id+"/",
                type : "POST",
                async : false,
                dataType: "json",
                data:{id:id},
                success : function (result){
                    $.dialog({
                        content:result.msg,
                        time:2000
                    });
                }
            });
        },
        cancelValue:"取消",
        cancel:true
    });
}