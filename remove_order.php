<?php
	session_start();
	$order_id = intval($_REQUEST["order_id"]);
	include 'conn.php';
	$sql = "delete from `order` where id=$order_id";
	$result = @mysqli_query($conn, $sql);
	if ($result){
		$sql = "delete from order_content where order_id=$order_id";
		$result = @mysqli_query($conn, $sql);
		if ($result)
			echo json_encode(array('success'=>true));
		else 
			echo json_encode(array('msg'=>'Some errors occured.'));
	} else {
		echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>