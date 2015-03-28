<div class="c_right">
    <h3>管理品牌</h3>

    <div class="m_search">
        <form method="get">
            品牌名称：<input name="name" type="text"/>
            <input type="submit" value="搜索"/>
        </form>
    </div>
    <table>
        <thead>
        <tr>
            <th>序号</th>
            <th>品牌名称</th>
            <th>排序</th>
            <th>图片标示</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($brands))
            foreach($brands as $br)
            {
               echo "
        <tr>
            <td>{$br['id']}</td>
            <td>{$br['name']}</td>
            <td>{$br['rank']}</td>
            <th><img src=\"/static/uploads/{$br['image']}\" height='50' width='50'></th>
            <td><a href=\"javascript:delete_brands({$br['id']});\">删除</a> <a href=\"/manager/update_brands/{$br['id']}/\">修改</a></td>
        </tr>
        ";}?>
        </tbody>
    </table>
    <!--页码跳转开始-->
    <div class="page_btn">
        <?php if(isset($preview_page)) echo "<a href=\"$preview_page\">&lt;&nbsp;上一页</a>";?>
        <?php if(isset($next_page)) echo "<a href=\"$next_page\">下一页&nbsp;&gt;</a>";?>
    </div>
    
    <!--页码跳转结束-->
</div>