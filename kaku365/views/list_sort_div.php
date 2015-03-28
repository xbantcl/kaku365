<div id="sort">
	<p>排列方式：</p>
	<!--价格销量新品排序开始-->
	<div id="sort_auto">
        <?php
        $link = $_GET;
        $href = '';
        unset($link['sort_price']);
        foreach($link as $key=>$value)
            $href .= "&$key=$value";?>
        <?php if(isset($sort_price) && $sort_price == 'asc')
            echo "<a href=\"?$href&sort_price=desc\"><img src='/static/images/list_price.jpg'/> </a>";
        else
            echo "<a href=\"?$href&sort_price=asc\"><img src='/static/images/list_price2.jpg'/></a>";
        ?>


    </div>
    <!--价格销量新品排序结束--> 
    <!--搜索结果数字显示开始-->
    <div id="number"> 总共找到了<b><?=$goods_count?></b>个商品 </div>
    <!--搜索结果数字显示结束--> 
    <!--上页下页开始-->
    <!--<div id="page"> 
		<a><img src="/static/images/on_up.jpg"/></a> 
		<a><img src="/static/images/on_down.jpg"/></a> 
	</div>-->
    <!--上页下页结束--> 
</div>