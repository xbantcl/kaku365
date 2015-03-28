<div id="js_divide">
  <?php foreach ($category as $c): ?>
  <?php foreach ($s_category as $s):?>
  <?php if ($s['pid'] == $c['id']): ?>
  <div class="divide" style="display: block;">
    <ul>
      <li>
        <h3><a href="#">
          <?=$s_category['name']?>
          </a></h3>
      </li>
    </ul>
  </div>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php $i++; ?>
  <?php endforeach; ?>
</div>
<!--下级分类导航开始-->
<div id="js_divide">
  <?php $i=1; ?>
  <?php foreach ($category as $c): ?>
  <?php foreach ($s_category as $s):?>
  <?php if ($s['pid'] == $c['id']): ?>
  <div id="<?='devi'.$i?>" class="divide" > </div>
  <?php endif; ?>
  <?php endforeach; ?>
  <?php $i++; ?>
  <?php endforeach; ?>
</div>
<!--下级分类导航结束-->