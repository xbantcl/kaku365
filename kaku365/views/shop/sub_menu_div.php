<div id="js_divide">
	<?php foreach($category as $c):?>
	<div class="divide" id="<?='menu_'.$c['id']?>"> 
		<ul>
    	<?php foreach($s_category as $s):?>
    	<?php if($s['pid']==$c['id']):?>
      		<li>
        		<h3><a href="<?='/search/filter?cateid='.$s['id'].'&shop_id='.$shop['id']?>"><?=$s['name']?></a></h3>
        		<p>
        		<?php foreach($th_category as $th):?>
        		<?php if($th['pid']==$s['id']):?>
        		<a href="<?='/search/filter?cateid='.$th['id'].'&shop_id='.$shop['id']?>"><?=$th['name']?></a>
        		<?php endif;?>
        		<?php endforeach;?>
        		</p>
      		</li>
      	<?php endif;?>
      	<?php endforeach;?>
		</ul>
	</div>
	<?php endforeach;?>
</div>
