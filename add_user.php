<?php
	session_start();
	include "conn.php";
	$username=$_REQUEST["username"];
	$password=$_REQUEST["password"];
	$email=$_REQUEST["email"];
	$sql = "select * from user where username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 1){
		echo json_encode(array("msg"=>"Exist!"));
	}else{
		$sql = "insert into user (username, password, email) values ('$username', '$password', '$email')";		
		$result = mysqli_query($conn, $sql);
		$sql = "select * from user where username='$username'";
		$result = mysqli_query($conn, $sql);
		$arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$_SESSION['id'] = $arr['id'];
		echo json_encode(array("success"=>true));
	}
?>