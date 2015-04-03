<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>kaku365</title>
<link href="/static/css/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="admin_page">
  <dl>
    <dt>一周动态</dt>
    <dd><strong>新增会员数：</strong><span>
      <?= $userweeknums?>
      </span></dd>
    <dd><strong>新增商家数：</strong><span>
      <?= $shopweeknums?>
      </span></dd>
  </dl>
  <dl>
    <dt>统计信息</dt>
    <dd><strong>会员总数：</strong><span>
      <?=$usernums?>
      </span></dd>
    <dd><strong>商家总数：</strong><span>
      <?=$shopnums?>
      </span></dd>
  </dl>
</div>
</body>
</html>
