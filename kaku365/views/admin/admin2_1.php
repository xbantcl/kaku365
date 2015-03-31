<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>无标题文档</title>
<link href="<?php echo base_url() ?>static/css/admin.css" rel="stylesheet" type="text/css">
</head>

<body >
<div class="admin_page">
  <h3>商家管理</h3>
  <form action="<?php echo base_url('admin/shop/search/'); ?>" method="get">
    <select name="type">
      <option value="name">名称</option>
      <option value="address">地址</option>
      <option value="telephone">电话</option>
    </select>
    <input type="text" name="key" />
    <input type="submit" value="搜索"/>
  </form>
</div>
<div class="admin_table">
  <table>
    <thead>
      <tr>
        <th>序号</th>
        <th>名称</th>
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
        <td><a href="admin/shopManage/?shop_user_id=<?php echo $item['user_id'] ?>" target="_blank"><?php echo $item['name']; ?></a></td>
        <td><?php echo $item['address']; ?></td>
        <td><?php echo $item['contacts']; ?></td>
        <td><?php echo $item['telephone']; ?></td>
        <td><a href="admin/shopManage/?shop_user_id=<?php echo $item['user_id'] ?>" target="_blank">修改</a><a href="<?php echo base_url('admin/shop/del/?shopid').'='.$item['id']?>">删除</a></td>
      </tr>
      <?php endforeach;?>


        </tbody>
  </table>
</div>
<?php echo $pagination;?>
</body>
</html>
