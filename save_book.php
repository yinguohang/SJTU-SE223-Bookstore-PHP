<?php
	session_start();
	$name = $_REQUEST["name"];
	//$seller_id = $_REQUEST["seller_id"];
	$seller_id = $_SESSION["id"];
	$price = $_REQUEST["price"];
	$now = date("Y-m-d H:i:s", time());
	$create_time = $now;
	$update_time = $now;
	include 'conn.php';
	$sql = "insert into book(name,seller_id,price,create_time,update_time)
	values('$name',$seller_id,$price,'$create_time','$update_time')";
	$result = @mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array('success'=>true));
	}else{
		echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>