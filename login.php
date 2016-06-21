<?php 
	session_start();
	if (isset($_SESSION['id'])){
		include "get_user_info_by_id.php";
		$arr = get_user_info_by_id($_SESSION["id"]);
		if ($arr['success'] == true)
			if ($arr['exist'] == true){
				echo '
					<html>
						<meta charset="UTF-8">
						<head>
							<meta http-equiv="refresh" content="1; url=./main.php">
						</head>
						<body>
							您已成功登陆!1s中之后将自动跳转到"书目一览"界面~
						</body>
					</html>
					';
				exit;
			}
		unset($_SESSION['id']);
	}
?>
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
						
		</script>
		<script type="text/javascript">
			function login(){	
				$('#form').form('submit', {
					url:"verify.php",
					onSubmit: function(){
						if ($('#username').val() == ""){
							alert("用户名不能为空");
							return false;
						}
						if ($('#password').val() == ""){
							alert("密码不能为空");
							return false;
						}
						return true;	
					},
					success:function(data){
						var arr = jQuery.parseJSON(data);
						if ('success' in arr)
							location.reload();
						else{
							$("#info").html("<p>错误的用户名或密码!</p>");
							$("#username").val("");
							$("#password").val("");
						}
					}
				});
			}
		</script>
		
		<div class="easyui-panel" title="登录/注册" style="width:400px">
        <div style="padding:10px 60px 20px 60px">
        <form id="form" method="post">
			<div style="padding:3px">
				<label>用户名:</label>
				<input class="easyui-textbox" type="text" name="username"id="username">
			</div>
			<div style="padding:3px">
				<label>密码:</label>
				<input class="easyui-textbox" type="password"name="password"id="password">
			</div>
			<div style="padding:3px">
				<input type="button" onclick="login()" value="登陆">
				<a href="register.php"><input type="button" value="注册"></a>
			</div>
			<div id="info">
			</div>
		</form>
		</div>
    	</div>
	</body>
</html>