<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<link href="<?=base_url() ?>static/css/admin.css" rel="stylesheet" type="text/css">
	<title>修改密码</title>
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script>
 	$(function(){
			$('#newpassword').blur(function(){
				var pass1 = $("#password").val();
				var pass2 = $("#newpassword").val();
				if(pass1 != pass2 || pass1 =='')
				{
					$("#passts").css('display','block');
				}
				else
				{
					$("#passts").css('display','none');
				}
			});

			$('#password').blur(function(){
				var pass1 = $("#password").val();
				var pass2 = $("#newpassword").val();
				if(pass1 != pass2 || pass1 =='')
				{
					$("#passts").css('display','block');
				}
				else
				{
					$("#passts").css('display','none');
				}
			});
                        
                        
                        
			$("#myform").submit(function(){
				var pass1 = $("#password").val();
				var pass2 = $("#newpassword").val();
   
				if(pass1.length < 6)
				{
					alert('密码长度不有低于6位！');
					return false;
				}
				if(pass1 != pass2 || pass1 =='')
				{
					return false;
				}
				else
				{
					return true;
				}
			});
			
		});
	</script>
</head>
<body>
	<div class="admin_page alterpass">
            <form action="#" method="post" id="myform">

			<div class="inputgroup">
				<label>原密码</label>
				<input type="password" name="oldpassword" id="oldpassword" />
			</div>

			<div class="inputgroup">
				<label>新密码</label>
				<input type="password" name="password" id="password"/>
			</div>

			<div class="inputgroup">
				<label>重复密码</label>
				<input type="password" name="newpassword" id="newpassword" />
				<p class="passts" id="passts">密码不同</p>
			</div>
			
			<div class="inputgroup">
				<input id="alterbottom" class="alterbottom" type="submit" value="修 改" >
			</div>

			
		</form>
	</div>
</body>
</html>