<?php
	$status = $_REQUEST['id'];
	if ($status == 1)
		echo '
			<div>
				<label>Name:</label>
				<input type="text" name="name" id="name"/>		
	    	</div>
	    	<div>
				<label>Price:</label>
				<input type="text" name="price" id="price"/>		
	    	</div>
	    	<div>
	    		<input type="button" onClick="send_to_save()" value="提交"/>
	    	</div>
			';
	elseif ($status == 2) 
		echo '
			<div>
	    		<label>Book ID:</label>
	    		<input type="text" name="id" id="id" />
			</div>
			<div>
	    		<input type="button" onClick="send_to_remove()" value="提交"/>
	    	</div>
			';
	elseif ($status == 3)
		echo '
			<div>
	    		<label>Book ID:</label>
	    		<input type="text" name="id" id="id" />
			</div>
			<div>
				<label>Name:</label>
				<input type="text" name="name" id="name"/>		
	    	</div>
	    	<div>
				<label>Price:</label>
				<input type="text" name="price" id="price"/>		
	    	</div>
	    	<div>
	    		<input type="button" onClick="send_to_update()" value="提交"/>
	    	</div>
			';
?>