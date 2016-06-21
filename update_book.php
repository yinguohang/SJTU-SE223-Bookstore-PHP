<?php
	session_start();
	$user_id=$_SESSION["id"];
	$id=intval($_REQUEST['id']);
	include 'conn.php';
	$sql="select * from book where id=$id";
	$result=mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) == 0){
		echo json_encode(array('msg'=>'对不起, 这本书不存在!'));
		exit;
	}
	if (mysqli_fetch_array($result, MYSQLI_ASSOC)['seller_id'] != $user_id){
		echo json_encode(array('msg'=>'你不是这本书的卖家,所以不能更改!'));
		exit;
	}
	$name = $_REQUEST["name"];
	$price = $_REQUEST["price"];
	$now = date("Y-m-d H:i:s", time());
	$update_time = $now;
	$sql = "update book set name='$name',
	price=$price, update_time='$update_time' where id=$id";
	$result = @mysqli_query($conn, $sql);
	if ($result){
	echo json_encode(array('success'=>true));
	} else {
	echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>