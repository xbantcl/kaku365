<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>kaku365</title>
<link href="<?=base_url() ?>static/css/admin.css" rel="stylesheet" type="text/css">
</head>

<body style="height:999px;">
<div class="admin_page">
  <h3>会员管理</h3>
  <form action="<?php echo base_url('admin/user/search/'); ?>" method="get">
    <select name="type">
      <option value="username">ID</option>
      <option value="address">地址</option>
      <option value="phone">电话</option>
    </select>
    <input type="text" name="key">
    <input type="submit" value="搜索"/>
  </form>
</div>
<div class="admin_table">
  <table>
    <thead>
      <tr>
        <th>序号</th>
        <th>ID</th>
        <th>地址</th>
        <th>联系人</th>
        <th>电话</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($res as $item):?>
      <tr>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['username']; ?></td>
        <td><?php echo $item['address']; ?></td>
        <td><?php echo $item['contacts']; ?></td>
        <td><?php echo $item['phone']; ?></td>
        <td><a href="/admin/admin/userManage/?user_id=<?php echo $item['id'] ?>"  target="_blank">修改</a><a href="<?php echo base_url('admin/user/del/?userid').'='.$item['id']?>">删除</a></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
</body>
</html>
