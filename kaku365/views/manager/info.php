<div class="c_right">
    <script src="<?=base_url() ?>static/js/basic.js"></script>
    <script src="<?=base_url() ?>static/js/shopvilidate.js"></script>
    <h3>商家名片</h3>
    <ul class="c_text">
        <form method="post" enctype="multipart/form-data" id="shop_info">
        <li class="c_col1"><b>商家近照：</b><input type="file" name="img_path"><span>支持格式jpg,png,gif</span></li>
        <li class="c_col2">
        <?php if(isset($shop['img_path']) && strlen($shop['img_path']) >5 ): ?>
        <img src='<?=$shop['img_path']?>'/>
        <?php endif;?>
        </li>
        <li class="c_col3"><b>商家名称：</b><input maxlength="10" name="name" id="name" type="text" value="<?php echo $shop['name'];?>" datatype="*"></li>
        <li class="c_col3"><b>商家法人：</b><input maxlength="8" name="contacts" id="contacts" type="text" value="<?php echo $shop['contacts'];?>" datatype="*"></li>
        <li class="c_col4"><b>联系电话：</b><input maxlength="13" name="telephone" id="telephone"  type="text" value="<?php echo $shop['telephone'];?>" datatype="*"></li>
        <li class="c_col5   "><b>详细地址：</b><input maxlength="20" name="address" id="address" type="text" value="<?php echo $shop['address'];?>" datatype="*"></li>
        <li class="c_col6"><b>商家简介：</b></li>
        <li class="c_col7"><textarea maxlength="140" id="introduce" name="introduce" >  <?php echo $shop['introduce'];?></textarea></li>
        <li class="c_col8"><input id="c_sub" type="submit" value="提交"></li>
        </form>
    </ul>

</div>