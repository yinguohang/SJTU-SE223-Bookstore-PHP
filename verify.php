<?php
	session_start();
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	include "conn.php";
	$sql = "select * from user where username='$username' and password='$password'";
	$result = mysqli_query($conn, $sql);
	if ($result){
		if (mysqli_num_rows($result) == 0){
			echo json_encode(array('msg'=>'Wrong username or password!'));
		}else{
			echo json_encode(array('success'=>true));
			$_SESSION["id"] = mysqli_fetch_array($result, MYSQLI_ASSOC)["id"];
		}
	}else{
		echo json_encode(array('msg'=>'Wrong SQL!'));
	}
?>