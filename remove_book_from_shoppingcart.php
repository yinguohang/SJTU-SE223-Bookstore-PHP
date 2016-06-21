<?php
	session_start();
	$user_id=$_SESSION["id"];
	$id = intval($_REQUEST["book_id"]);
	include 'conn.php';
	$sql = "delete from shoppingcart where user_id=$user_id and book_id=$id";
	$result = @mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>