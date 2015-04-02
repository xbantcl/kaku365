<div id="select"> 
	<!--选择器指示条开始-->
	<div id="hint">
	<p>您已选择：
		<b>
			<?php if($tag['leave']==1):?>
				<?=$tag['name']?>	
			<?php elseif($tag['leave']==2):?>
				<?php foreach($category as $c):?>
						<?php if($tag['pid']==$c['id']):?>
							<?=$c['name']?>
						<?php endif;?>
				<?php endforeach;?>
			<?php else:?>
				<?php foreach($category as $c):?>
					<?php foreach($s_category as $s):?>
						<?php if($c['id']==$s['pid']):?>
							<?php if($s['id']==$tag['pid']):?>
								<?=$c['name']?>
							<?php endif;?>	
						<?php endif;?>
					<?php endforeach;?>
				<?php endforeach;?>
			<?php endif;?>
		</b>
		<?php if($tag['leave']!=1):?>
			<span id="category_s"><em>分类：</em><i id="i_<?=$tag['id']?>"><?=$tag['name']?></i><a href="?<?php
                $link = $_GET;
                $link['cateid'] = $root_pid;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>"><strong></strong></a></span>
		<?php endif;?>
		<?php if(isset($_GET['brand_name'])):?>
            <span id="brand_s"><em>品牌：</em><i><?= $_GET['brand_name']?></i><a href="?<?php
                $link = $_GET;
                unset($link['brand_name']);
                unset($link['brand_id']);
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>"><strong></strong></a></span>
		<?php endif;?>
		<?php if(isset($_GET['price'])):?>
            <?php $price_s = array('1'=>'50元以下','2'=>'50-100元','3'=>'101-200元','4'=>'201-300元','5'=>'300以上');?>
            <span id="price_s"><em>价格：</em><i><?= $price_s[$_GET['price']]?></i><a href="?<?php 
                $link = $_GET;
                unset($link['price']);
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>"></a></span>
		<?php endif;?>
	</p>
    </div>
    <!--选择器指示条结束-->
    <?php if(!isset($_GET['brand_id']))
    {?>
    <!--品牌筛选开始-->
    <div id="brand">
		<h4>品牌筛选</h4>
		<div id="brand_c">
        <p>
        	<?php foreach($brands as $b):?>
        	<a href="?<?php
            $link = $_GET;
            $link['brand_name'] = $b['name'];
            $link['brand_id'] = $b['id'];
            foreach($link as $key=>$value)
                echo "&$key=$value";
            ?>"><?=$b['name']?><b>(<?=$b['goods_amount']?>)</b></a>
        	<?php endforeach;?>
		</p>
        <span id="btn1"><img  src="/static/images/1-new-close.jpg"/></span>
		</div>
	</div>

    <!--品牌筛选结束-->
    <?php
    }?>
    <?php if(!isset($_GET['price'])):?>
    <!--价格筛选开始-->
    <div id="price">
		<h4>价格筛选</h4>
			<div> 
				<a href="?<?php
                $link = $_GET;
                $link['price'] = 1;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>" id="price_1">50元以下</a>
				<a href="?<?php
                $link['price'] = 2;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>" id="price_2">50-100元</a>
				<a href="?<?php
                $link['price'] = 3;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>" id="price_3">101-200元</a>
				<a href="?<?php
                $link['price'] = 4;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>" id="price_4">201-300元</a>
				<a href="?<?php
                $link['price'] = 5;
                foreach($link as $key=>$value)
                    echo "&$key=$value";
                ?>" id="price_5">300以上</a>
			</div>
    </div>
    <!--价格筛选结束-->
    <?php endif;?>
    <!--分类筛选开始-->
    <div id="classify">
		<h4>分类</h4>
			<div id="classify_c">
				<p> 
					<?php
                    $classify_c = 0
                    ;foreach($s_category as $th):?>
					<?php if($th['pid']==$tag['id']): $classify_c++;?>
					<a href="?<?php
                    $link = $_GET;
                    $link['cateid'] = $th['id'];
                    foreach($link as $key=>$value)
                        echo "&$key=$value";
                    ?>" id='a_<?=$th['id']?>'><?=$th['name']?></a>
					<?php endif;?>
					<?php endforeach;?>

					<?php foreach($category as $th):?>
					<?php if($th['pid']==$tag['id']): $classify_c++;?>
					<a href="?<?php
                    $link = $_GET;
                    $link['cateid'] = $th['id'];
                    foreach($link as $key=>$value)
                        echo "&$key=$value";
                    ?>" id='a_<?=$th['id']?>'><?=$th['name']?></a>
					<?php endif;?>
					<?php endforeach;?>

					<?php foreach($th_category as $th):?>
					<?php if($th['pid']==$tag['id']): $classify_c++;?>
					<a href="?<?php
                    $link = $_GET;
                    $link['cateid'] = $th['id'];
                    foreach($link as $key=>$value)
                        echo "&$key=$value";
                    ?>" id='a_<?=$th['id']?>'><?=$th['name']?></a>
					<?php endif;?>
					<?php endforeach;?>
				</p>
        		<span id="btn_cate"><img src="/static/images/1-new-close.jpg"/></span>
                <?php
                if($classify_c==0){?>
                <style>
                    #classify {
                        display:none;
                    }
                </style>
                <?php }?>
        	</div>
    </div>
    <!--分类筛选结束--> 
</div>