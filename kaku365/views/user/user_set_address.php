<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>kaku365</title>
		<link href="<?=base_url() ?>static/css/basic.css" rel="stylesheet" type="text/css">
		<link href="<?=base_url() ?>static/css/member.css" rel="stylesheet" type="text/css">
		<script src="/static/js/jquery-1.11.1.min.js"></script>
		<script src="<?=base_url() ?>static/js/basic.js"></script>
		<script src="<?=base_url() ?>static/js/PCASClass.js"></script>
	</head>
	<body>
		<?php require_once('user_header.php');?>
		<?php require_once('user_left.php');?>
		<div class="mcontent_right">
			<?php require_once ('user_welcome.php'); ?>
			<?php require_once ('user_set_address_div.php'); ?>
		</div>
		<?php require_once ('user_footer.php'); ?>
	</body>
</html>
