<?php
	session_start();
	header('content-type:text/html;charset = utf-8');
	include 'conn.php';
	$user_id = $_SESSION['id'];
	$rs = mysqli_query($conn, "select * from `shoppingcart` where user_id=$user_id");
	$now = date("Y-m-d H:i:s", time());
	$sql = "insert into `order` (user_id,create_time)values($user_id,'$now')";
	$result = mysqli_query($conn, $sql);
	$result = mysqli_query($conn, "select * from `order` where user_id=$user_id and create_time='$now'");
	$order_id = mysqli_fetch_array($result, MYSQLI_ASSOC)["id"];
	$price = 0;
	while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)){
		$amount = $row["amount"];
		$book_id = $row["book_id"];
		$book_name = $row["book_name"];
		$book_price = $row["book_price"];
		$price = $price + intval($amount)*intval($book_price);
		$sql = "insert into order_content (order_id, book_id, amount, book_name,
				book_price) values ($order_id, $book_id, $amount, '$book_name', $book_price)";
		mysqli_query($conn, $sql);	
	}
	$result = mysqli_query($conn, "update `order` set price=$price where id=$order_id");
	mysqli_query($conn, "delete from shoppingcart where user_id=$user_id");
?>