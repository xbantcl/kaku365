<div id="product">
<!--店铺首页左二级导航开始-->
	<?php foreach ($category as $c): ?>
	<div class="list">
		<div class="nav_left">
			<h2><a href="<?='/search/filter?cateid='.$c['id'].'&shop_id='.$shop['id']?>"><?=$c['name']?></a></h2>
			<ul class="menu-one">
			<?php foreach ($s_category as $s): ?>
			<?php if ($s['pid'] == $c['id']): ?>
				<li class="firstChild">
					<div class="header">
						<span class="txt"><a href="<?='/search/filter?cateid='.$s['id'].'&shop_id='.$shop['id']?>"><?=$s['name']?></a></span>
						
               		</div>
	                
				</li>
			<?php endif; ?>
			<?php endforeach; ?>
			</ul>
		</div>
        <!--店铺首页产品展示模块开始-->
		<div class="product" id="<?=$c['id']?>">
					<?php foreach ($s_category as $s): ?>
						<?php foreach ($goods as $g): ?>
							<?php if ($s['pid'] == $c['id']): ?>
								<?php if ($g['category2'] == $s['id']): ?>
								<dl>
									<dt>
										<a href="<?=site_url('goods/view').'/'.$g['id']?>">
											<img src="/static/uploads/bmiddle/<?=$g['cover_image']?>" />
										</a>
									</dt>
									<dd class="t1">
										<a href="<?=site_url('goods/view').'/'.$g['id']?>">
											<?=$g['name']?>
										</a>
									</dd>
									<dd class="t2">
										<b>￥<?=$g['price']?></b>
									</dd>
									<dd class="t3">
										<input type="submit" value="加入购物车" onClick="join_cart(<?=$g['id']?>,<?=$shop['id'] ?>)"/>
										<input type="button" value="查看详情" onClick="location.href='<?=site_url('goods/view') . '/' . $g['id'] ?>'"/>
									</dd>
								</dl>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endforeach; ?>
</div>