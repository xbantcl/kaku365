<?php if(!isset($is_words)):?>
<div id="main"> 
	<!--产品展示框开始-->
	<div id="goods">
		<?php foreach($goods as $g):?>
		<dl class="adl">
			<dt><img src="<?=$g['cover_image']?>"/></dt>
			<dd class="s1"> <a><?=$g['name']?></a></dd>
			<dd class="s2"><b>￥<?=$g['price']?></b></dd>
			<dd class="s3">
				<input type="submit" value="加入购物车" onClick="join_cart(<?=$g['id']?>,<?=$shop['id'] ?>)"/>
				<input type="submit" value="查看详情" onClick="show_goods(<?=$g['id']?>)"/>
			</dd>
		</dl>
		<?php endforeach;?>
	</div>
	<!--产品展示框结束--> 
	<?php if(!empty($goods)):?>
	
	</div>
	<?php endif;?>
</div>
<?php elseif(empty($goods)):?>
<h2>您需要的商品暂未上架喔！！</h2>
<?php else:?>
<div id="main"> 
	<!--产品展示框开始-->
	<div id="goods">
		<?php foreach($goods as $g):?>
		<dl class="adl">
			<dt><a href="/goods/view/<?=$g['id']?>"> <img src="/static/uploads/bmiddle/<?=$g['cover_image']?>"/></a></dt>
			<dd class="s1"> <a><?=$g['name']?></a></dd>
			<dd class="s2"><b>￥<?=$g['price']?></b></dd>
			<dd class="s3">
				<input type="submit" value="加入购物车" onClick="join_cart(<?=$g['id']?>,<?=$shop['id'] ?>)"/>
				<input type="submit" value="查看详情" onClick="show_goods(<?=$g['id']?>)"/>
			</dd>
		</dl>
		<?php endforeach;?>
	</div>
	<!--产品展示框结束-->
	<div id="page_down" style=" float: right; ">
        <?php
        $link = $_GET;
        $href = '';
        foreach($link as $key=>$value)
            $href .= "&$key=$value";
        if($page < $all_page)
            echo "<a href=\"?$href&p=" . ($page+1) ."\" style=\" width: 60px; \"> 下一页</a>";
        for($i = $all_page;$i> 0;$i--)     {
            if($i == $page)
                echo "<b>$i&nbsp;</b>";
            else
                echo "<a href=\"?$href&p=$i\">$i&nbsp;</a>";
        }
        $preview_page = $page - 1;
        if($page > 1)
            echo "<a href=?\"$href&p=$preview_page\" style=\" width: 60px;\">上一页&nbsp;</a>";

        ?>
</div>
<?php endif;?>
