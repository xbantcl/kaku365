<div class="c_right">
    <h3>新增品牌</h3>

    <ul>
        <form method="post" enctype="multipart/form-data">
            <li>名称：<input name="name" type="text" value="<?php if(isset($brands['name'])) echo $brands['name'];?>"/></li>
            <li>品牌标示：<input name="image" type="file"/><span>支持格式jpg,png,gif.</span></li>
            <?php if(isset($brands['image'])) echo "<li><img src=\"/static/uploads/{$brands['image']}\" height='100' width='100'></li>";?>
            <li>排序：<input name="rank" type="text" value="<?php if(isset($brands['rank'])) echo $brands['rank'];?>"/><span>数字范围为0~255，数字越小越靠前</span></li>
            <li class="c_col8"><input type="submit" value="提交"></li>
        </form>
    </ul>

</div>