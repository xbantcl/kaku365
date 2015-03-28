<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>商家管理后台</title>
    <script src="/static/js/jquery-1.4.4.min.js"></script>
    <script src="/static/js/linkagesel.js"></script>
    <script src="/static/js/manager.js"></script>
    <script src="/static/js/jquery.validate.min.js"></script>
    <script src="/static/js/jquery.artDialog.min.js"></script>
    <link href="/static/css/basic.css" rel="stylesheet" type="text/css">
    <link href="/static/css/manager.css" rel="stylesheet" type="text/css">
    <link href="/static/css/member.css" rel="stylesheet" type="text/css">
    <link href="/static/css/simple.css" rel="stylesheet" type="text/css">
</head>

<body>

<!--头部标题注册搜索开始-->
<div id="header">
    <h1 title="返回首页"><a href="<?php if($user['shop_id']) echo'/shop/index/' . $user['shop_id'];?>">kaku365</a></h1>
    <span><a href=""><?php if(isset($user['username'])) echo $user['username'];else echo '已登录'; ?></a>|<a href="<?=site_url('shop_user/logout')?>">退出</a></span></div>
<!--头部标题注册搜索结束-->
<!--管理中心内容开始-->
<div id="content">

