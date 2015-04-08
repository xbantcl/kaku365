<!--管理中心右内容开始-->
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
<div class="c_right">
    <h3>新增商品</h3>
    <h4>商品信息</h4>
    <form method="post" enctype="multipart/form-data">
    <ul>
        <div id="element_id">
        <li>商品分类：<select id="p_category"></select></li>
            <input type="hidden" id="category1" name="category1">
            <input type="hidden" id="category2" name="category2">
            <input type="hidden" id="category3" name="category3">
        </div>

        <li>名称：<input name="name" type="text" value="<?php echo $name;?>"/></li>
        <input name="name_h" type="hidden" value="<?php echo $name;?>"/>
        <li>品牌：<input name="brand_name" type="text" disabled="disabled" value="<?php echo $brand_name;?>"/>
        <input name="brand_id" type="hidden" value="<?php echo $brand_id;?>" />
        <li>价格：<input name="price" type="text" /></li>
        <li>单位：<input name="format" type="text" disabled="disabled" value="<?php echo $format;?>"/></li>
        <input name="format_h" type="hidden" value="<?php echo $format;?>"/>
        <li>商品编码：<input name="product_code" type="text" disabled="disabled" value="<?php echo $product_code;?>"/></li>
        <input name="product_code_h" type="hidden" value="<?php echo $product_code;?>"/>
        <li>产品配料：</li>
        <li><textarea name="product_ingredients" disabled="disabled"><?php echo $product_ingredients;?></textarea></li>
        <input name="product_ingredients_h" type="hidden" value="<?php echo $product_ingredients;?>"/>
        <li>保质期：<input name="shelf_life" type="text" disabled="disabled" value="<?php echo $shelf_life;?>"/></li>
        <input name="shelf_life_h" type="hidden" value="<?php echo $shelf_life;?>"/>
        <input name="cover_image" type="hidden" value="<?php echo $cover_image;?>"/>
        <input name="prd_images" type="hidden" value="<?php echo $prd_images;?>"/>
        <li>备注：</li>
        <li><textarea name="description"></textarea></li>
        <li>品牌：<select name="status">
                <option value="1">显示</option>
                <option value="0">隐藏</option>
            </select></li>
    </ul>
    <h4>商品图片</h4>
        <?php
        foreach($images as $img)
        {
            if(strlen($img))
            echo "<img src=\"/static/uploads/brands_{$brand_id}/$img\"/ style=\" height: 100px; width: 100px;margin: 10px;\">";
        }
        ?>
    <div class="c_col8"><input type="submit" value="提交"></div>
    </form>
</div>
<!--管理中心右内容结束-->