<?php
	header('content-type:text/html;charset = utf-8');
	$page = isset($_REQUEST['page'])?intval($_REQUEST['page']) : 1;
	$rows = isset($_REQUEST['rows'])?intval($_REQUEST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$result = array();
	include 'conn.php';
	//$rs represents the number of records
	$rs = mysqli_query($conn, "select count(*) from book");
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysqli_query($conn, "select * from book limit $offset,$rows");
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	echo json_encode($result);
?>