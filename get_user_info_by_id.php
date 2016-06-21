<?php
	function get_user_info_by_id($id){
		include "conn.php";
		$ans = array();
		$sql = "select * from user where id=$id";
		$result = mysqli_query($conn, $sql);
		if ($result)
			if (mysqli_num_rows($result) == 1){
				$ans["success"] = true;
				$ans["exist"] = true;
				$arr = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$ans["ans"] = $arr;				
			}else{
				$ans["success"] = true;
				$ans["exist"] = false;
			}
		else{
			$ans["success"] = false;
		}
		return $ans;			
	}
?>
