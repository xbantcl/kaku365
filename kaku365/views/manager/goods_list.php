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
<div class="c_right">
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

            </br>
            </br>
        <span id="element_id">分类：
      <select id="p_category"></select>
            <input type="hidden" id="category1" name="category1">
            <input type="hidden" id="category2" name="category2">
            <input type="hidden" id="category3" name="category3">
      </span>
            <input type="submit" value="搜索"/>
        </form>
    </div>
    <table>
        <thead>
        <tr>
            <th><label><input id="SelectAll" type="checkbox" onclick="select_all()"/>全选</label></th>
            <th>图片</th>
            <th>名称</th>
            <th>品牌</th>
            <th>条码</th>
            <th>价格</th>
            <th>分类</th>
            <th>状态</th>
            <th>操作</th>
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
            <td><?php if(isset($all_brands[$go['brand_id']])) echo $all_brands[$go['brand_id']];?></td>
            <td><?= $go['product_code']?></td>
            <td>￥<?= $go['price']?></td>
            <td><?php if(isset($all_category[$go['category1']]) && $go['category1'] >0) echo $all_category[$go['category1']]['name'] ;if(isset($all_category[$go['category2']]) && $go['category2'] >0) echo '>' . $all_category[$go['category2']]['name'];if(isset($all_category[$go['category3']]) && $go['category3'] >0) echo '>' . $all_category[$go['category3']]['name'];?></td>
            <td><?php if($go['status']) echo " 显示";else echo "隐藏";?></td>
            <td><a href="javascript:delete_goods('<?php echo $go['id'];?>');">删除</a> <a href="/manager/update_goods/<?php echo $go['id'];?>/">修改</a></td>
        </tr>
        <?php }?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <?php echo $pagination;?>
    <!--页码跳转结束-->
</div>