<?php
	include "is_login.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>书目一览</title>
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="dict/jquery-easyui-1.4.2/themes/icon.css">
		<script type="text/javascript" src="dict/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="dict/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
	</head>
	<body>
		<script type="text/javascript">
			function add(){
				if ($('#amount').val() == 0||$('#buy_book_id').val() == 0){
					alert("图书ID和购买数量不能为空!");
					return;
				}
				$.ajax({
					url:"add_book_to_shoppingcart.php",
					data:"buy_book_id="+$("#buy_book_id").val()+"&amount="+$("#amount").val(),
					success:function(data){
						$('#shoppingcart_table').datagrid('reload');
						$("#buy_book_id").val("");
						$("#amount").val("");
					}
				})
			}
			function remove_from_shoppingcart(){
				if ($('#buy_book_id').val() == 0){
					alert("图书ID不能为空!");
					return;
				}
				$.ajax({
					url:"remove_book_from_shoppingcart.php",
					data:"book_id="+$("#buy_book_id").val(),
					success:function(data){
						$('#shoppingcart_table').datagrid('reload');
						$("#buy_book_id").val("");
						$("#amount").val("");
					}
				})
			}
			function create_order(){
				$.ajax({
					url:"create_order.php",
					success:function(data){
						$('#shoppingcart_table').datagrid('reload');
						$("#buy_book_id").val("");
						$("#amount").val("");
					}
				})
			}
			function send_to_save(){
				$('#form').form('submit', {
					url:"save_book.php",
					onSubmit: function(){
						if ($('#name').val() == ""){
							alert("名字不能为空");
							return false;
						}
						if ($('#price').val() == ""){
							alert("价钱不能为空");
							return false;
						}
						return true;	
					},
					success:function(data){
						location.reload();
					}
				});
			}	
			function send_to_remove(){
				$('#form').form('submit', {
					url:"remove_book.php",
					onSubmit: function(){
						if ($('#id').val() == ""){
							alert("ID不能为空");
							return false;
						}
						return true;	
					},
					success:function(data){
						var arr = jQuery.parseJSON(data);
						if ('success' in arr)
							location.reload();
						else{
							$("#info").html('<p>'+arr.msg+'</p>');
						}
					}
				});
			}
			function send_to_update(){
				$('#form').form('submit', {
					url:"update_book.php",
					onSubmit: function(){
						if ($('#id').val() == ""){
							alert("ID不能为空");
							return false;
						}
						if ($('#name').val() == ""){
							alert("名字不能为空");
							return false;
						}
						if ($('#price').val() == ""){
							alert("价钱不能为空");
							return false;
						}
						return true;	
					},
					success:function(data){
						var arr = jQuery.parseJSON(data);
						if ('success' in arr)
							location.reload();
						else{
							$("#info").html('<p>'+arr.msg+'</p>');
						}
					}
				});
			}
		</script>
		<p>欢迎您,<?php echo $user_info['username']; ?>(<?php echo $user_info['id']; ?>)
			<a href="log_out.php">登出</a>
			<a href="show_orders.php">我的订单</a>
		</p>
		<div style="display:inline-block;vertical-align:top;">
			<table id="shoppingcart_table" class="easyui-datagrid" title="购物车" 
				style="width:700px;height:335px"
				data-options="singleSelect:true,collapsible:false,url:'get_shoppingcart.php',method:'get'"
				pagination="true">
				<thead>
					<tr>
						<th data-options="field:'book_id'">Book ID</th>
						<th data-options="field:'amount'">Amount</th>
						<th data-options="field:'book_name'">Name</th>
						<th data-options="field:'book_price'">Price(per one)</th>					
					</tr>
				</thead>
			</table>
		</div>
		<div style="display:inline-block;vertical-align:top;">
			<div class="easyui-panel" style="
				width:500px;
				padding:5px;
				float:left">
				<p>购物</p>
				<div>
					<label>Book ID</label>
					<input type="text" id ="buy_book_id">
				</div>
				<div>
					<label>Amount</label>
					<input type="text" id ="amount">
				</div>
				<div>
					<input type="button" onclick="add()" value="添加到购物车">
					<input type="button" onclick="remove_from_shoppingcart()" value="从购物车删除">
					<input type="button" onclick="create_order()" value="结算购物车并下单">
				</div>
			</div>
		</div>
		<div style="display:inline-block;vertical-align:top;">
			<table class="easyui-datagrid" title="书籍目录" style="width:700px;height:335px"
				data-options="singleSelect:true,collapsible:false,url:'get_books.php',method:'get'"
				pagination="true">
				<thead>
					<tr>
						<th data-options="field:'id',width:60">Book ID</th>
						<th data-options="field:'name'">Name</th>
						<th data-options="field:'seller_id'">Seller ID</th>
						<th data-options="field:'price'">Price</th>
						<th data-options="field:'create_time'">Create Time</th>
						<th data-options="field:'update_time'">Update Time</th>
					</tr>
				</thead>
			</table>
		</div>
		<div style="display:inline-block;vertical-align:top;">
			<div class="easyui-panel" style="
				width:500px;
				padding:5px;
				float:left">
				<form id="form" method="get">
			    	<div>
			    		<label>书籍操作:</label>
			    		<input name="type" id="cc" style="width:100px" 
			    			url="data/combobox_data.json" valueField="id" textField="text"
			    			>
					</div>
					<div id="remain">
					
			    	</div>
			    </form>
	    	</div>
	    </div>
		<div id="info">
		</div>
		<script type="text/javascript">
			$(function(){
				var combo = $('#cc').combobox({
					formatter:function(row){
						return '<span class="item-text">'+row.text+'</span>';
					},
					onSelect: function(record) {
						console.log(record);
						htmlobj = $.ajax({url:"form_content.php", data: "id="+record["id"], async:false});
						$('#remain').html(htmlobj.responseText);
					}
				});
			});
		</script>
	</body>
</html>