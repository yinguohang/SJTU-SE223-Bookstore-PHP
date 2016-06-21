<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>登陆</title>
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/icon.css">
		<script type="text/javascript" src="dict/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="dict/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
	</head>
	<body>
		<script type="text/javascript">
			function register(){	
				$('#form').form('submit', {
					url:"add_user.php",
					onSubmit: function(){
						if ($('#username').val() == ""){
							alert("用户名不能为空");
							return false;
						}
						if ($('#password').val() == ""){
							alert("密码不能为空");
							return false;
						}
						if ($('#email').val() == ""){
							alert("邮箱不能为空");
							return false;
						}
						if ($('#password').val() != $('#confirm').val()){
							alert("两次密码填写不一致");
							return false;
						}
						return true;	
					},
					success:function(data){
						var arr = jQuery.parseJSON(data);
						if ('success' in arr)
							location.href = "main.php";
						else{
							$("#info").html("<p>用户名已存在</p>");
							$("#username").val("");
						}
					}
				});
			}
		</script>
		<form id="form" method="post">
			<div>
				<label>用户名:</label><input type="text" name="username"id="username">
			</div>
			<div>
				<label>密码:</label><input type="password"name="password"id="password">
			</div>
			<div>
				<label>确认密码:</label><input type="password"name="confirm"id="confirm">
			</div>
			<div>
				<label>邮箱:</label><input type="text"name="email"id="email">
			</div>
			<div>
				<input type="button" onclick="register()" value="注册">
			</div>
			<div id="info">
			</div>
		</form>
	</body>
</html>