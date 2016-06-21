<?php
	function go_to_log_in(){
		echo 		'
						<html>
							<meta charset="UTF-8">
							<head>
								<meta http-equiv="refresh" content="1; url=./login.php">
							</head>
							<body>
								请先登陆!1s中之后将自动跳转到"登陆"界面~
							</body>
						</html>
						';
		exit;
	}
	session_start();
	if (!isset($_SESSION['id'])){
		go_to_log_in();
	}
	$id = $_SESSION['id'];
	include "get_user_info_by_id.php";
	$arr = get_user_info_by_id($id);
	if ($arr['success'] == false){
		unset($_SESSION['id']);
		go_to_log_in();
	}else if ($arr['exist'] == false){
		unset($_SESSION['id']);
		go_to_log_in();
	}else{
		$user_info=$arr['ans'];
	}		
?>