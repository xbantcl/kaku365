<script>
    var districtData =<?php echo json_encode($categorys);?>;
    $(document).ready(function () {
        var opts14 = {
            data: districtData,
            //ajax: '/manager/get_category_ajax/?',    // ajax与data配合获取未定义的下级数据
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
<div class="c_right">
    <h3>新增分类</h3>
    <ul>
        <form method="post" enctype="multipart/form-data">
            <li>分类等级：<select name="leave">
                    <option value="1">一级分类</option>
                    <option value="2">二级分类</option>
                    <option value="3">三级分类</option>
                </select><span>新增一级分类隐藏归属，二级归属对应一级，三级归属对应二级</span></li>
            <li>上级分类：<select id="p_category"></select></li>
            <input type="hidden" name="pid" id="pid" value="0">
            <li>分类名称：<input name="name" type="text" value="<?php if(isset($category['name'])) echo $category['name'];?>"/></li>
            <li>显示：<select name="status">
                    <option value="1">显示</option>
                    <option value="0">隐藏</option>
                </select></li>
            <li><input type="submit" value="更新"/></li>
        </form>
    </ul>
</div>

</div>