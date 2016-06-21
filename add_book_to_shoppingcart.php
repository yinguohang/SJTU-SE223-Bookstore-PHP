<?php
	session_start();
	$book_id = $_REQUEST["buy_book_id"];
	$user_id = $_SESSION["id"];
	$amount = $_REQUEST["amount"];
	include 'conn.php';
	$sql = "select * from book where id=$book_id";
	$result = @mysqli_query($conn, $sql);
	if ($result){
		if (mysqli_num_rows($result) == 0){
			echo json_encode(array('msg'=>'No such book.'));
			return;
		}else{
			$arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$book_name = $arr["name"];
			$book_price = $arr["price"];
		}		
	}else{
		echo json_encode(array('msg'=>'! Some errors occured.'));
		return;
	}
	$sql = "insert into shoppingcart(user_id,book_id,amount,book_name,book_price)
	values($user_id,$book_id,$amount,'$book_name',$book_price)";
	$result = @mysqli_query($conn, $sql);
	if ($result){
		echo json_encode(array('success'=>true));
	}else{
		echo json_encode(array('msg'=>'Some errors occured.'));
	}
?>