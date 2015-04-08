$(function() {
	$('#addGoods').click(function(){
		var productName = $('input[name=name]').val();
		var productCode = $('input[name=product_code]').val();
		var productBrandId  = $('select[name=brand_id]').val();
		var productNetContent = $('input[name=net_content]').val();
		var productFormat = $('input[name=format]').val();
		var productIngredients = $('textarea[name=product_ingredients]').val();
		var productShelfLife = $('input[name=shelf_life]').val();
		var errorMsg = '';
		if (0 == productName.length) {
			errorMsg = '商品名称不能为空';
		} else if (-1 == productBrandId) {
			errorMsg = '品牌ID不能为空';
		} else if (0 == productNetContent.length) {
			errorMsg = '净含量不能为空';
		} else if (0 == productFormat.length) {
			errorMsg = '商品单位不能为空';
		} else if (productCode.length == 0) {
			errorMsg = '商品编号不能为空!';
		} else if (productCode.length != 13) {
			errorMsg = '商品编号必须为13位!';
		} else if (0 == productIngredients.length) {
			errorMsg = '商品配料不能为空';
		} else if (0 == productShelfLife.length) {
			errorMsg = '商品保质期不能为空';
		}
		if (0 != errorMsg.length) {
			alert(errorMsg);
			return false;
		}
		$('#addGoods-form').submit();
	});
});

function deleteGoodsTemplate(id)
{
    $.dialog({
        content: "确认删除这个商品吗，无法找回！",
        lock: true,
        fixed: true,
        okValue: '删除',
        ok: function () {
            $.ajax({
                url : "/admin/shop/deleteGoodsTemplate/"+id+"/",
                type : "POST",
                async : false,
                dataType: "json",
                data:{id:id},
                success : function (result){
                    $.dialog({
                        content:result.msg,
                        time:0
                    });
                }
            });
        },
        cancelValue:"取消",
        cancel:true
    });
}
function deleteBrands(id)
{
    $.dialog({
        content: "确认删除这个品牌吗，无法找回！",
        lock: true,
        fixed: true,
        okValue: '删除',
        ok: function () {
            $.ajax({
                url : "/admin/deleteBrands/"+id+"/",
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