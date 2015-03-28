<!--产品图片开始-->
<div id="img_content">
    <ul>
        <?php foreach($Goods['img_content'] as $img)
            echo "<li onClick=\"setImg('$img')\"><img src=\"$img\"></li>";
        ?>
    </ul>
    <img style=" margin-top: 20px; margin-left: 100px; " id="b_img" src="<?=$Goods['cover_image'];?>"/>
</div>
<!--产品图片结束-->
<script>
    function setImg(img) {
        var oBimg = document.getElementById('b_img');
        oBimg.src = img;
    }
</script>
<!--产品文字评价信息开始-->
<div id="tex_content">
    <!--产品信息开始-->
    <ul>
        <li><span>商品名称：</span> <b><?=$Goods['name'];?></b></li>
        <li><span>价格：</span><strong><?=$Goods['price'];?></strong></li>
        <li><span>规格：</span><i><?=$Goods['format'];?></i></li>
        <li><span>品牌：</span><i><?=$Goods['goods_brandName'];?></i></li>
        <li><span>单位：</span><i><?=$Goods['format'];?></i></li>
        <li><span>商品编码：</span><i><?=$Goods['product_code'];?></i></li>
        <li><span>产品配料：</span><p><?=$Goods['product_ingredients'];?></p></li>
        <li><span>保质期：</span><i><?=$Goods['shelf_life'];?></i></li>
        <li><span>备注：</span><i><?=$Goods['description'];?></i></li>
    </ul>
    <!--产品信息结束-->
    <div class="big_img_btns">
        <a id="increase" href="#">+</a>
        <input id="quantum" type="text" value="1"/>
        <a id="decrease" href="#">-</a>
    </div>
    <!--提交按钮开始-->
    <input onclick="join_cart(<?=$Goods['id']?>,<?=$shop['id']?>)" class="img_sub" type="submit" value="加入购物车"/>
    <input class="img_sub" type="submit" value="继续购物"/>
</div>