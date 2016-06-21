<?php 
	include "is_login.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>我的订单</title>
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/icon.css">
		<script type="text/javascript" src="dict/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="dict/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
	</head>
	<body>
		<p>欢迎您,<?php echo $user_info['username']; ?>(<?php echo $user_info['id']; ?>)
			<a href="log_out.php">登出</a>
			<a href="main.php">书目一览</a>
		</p>
		<script type="text/javascript">
		</script>
		<table id="table" class="easyui-datagrid" title="我的订单" style="width:700px;height:335px"
			data-options="singleSelect:true,collapsible:false,url:'get_orders.php',method:'get'"
			pagination="true">
			<thead>
				<tr>
					<th data-options="field:'id'">Order ID</th>
					<th data-options="field:'user_id'">User ID</th>
					<th data-options="field:'price'">Price</th>
					<th data-options="field:'create_time'">Create Time</th>
				</tr>
			</thead>
		</table>
		<script type="text/javascript">
			function remove_order(){
				if ($("#order_id").val() == ""){
					alert("订单号不能为空!");
					return;
				}
				$.ajax({
					url:"remove_order.php",
					data:"order_id="+$("#order_id").val(),
					success:function(data){
						$("#table").datagrid("reload");
						$("#order_id").val("");
					}
				});
			}
		</script>
		<div style="padding:5px">
			<label>订单号:</label>
			<input type="text" id="order_id">
			<input type="button" onclick="remove_order()" value="删除订单">
		</div>
	</body>
</html>