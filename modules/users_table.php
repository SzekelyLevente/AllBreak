<?php
	$users=$_SESSION['users'];
	for ($i=0; $i < sizeof($users); $i++) { 
	 	echo
	 	'<tr>
         	<td>'.$users[$i]["name"].'</td>
        	<td>'.$users[$i]["permission"].'</td>
        	<td>';
        	if($_SESSION["usr"]["id"]!=$users[$i]["id"])
        	{
        		echo
        		'<form method="post">
        			<button type="submit" class="btn btn-danger" name="userDelete"><i class="bi bi-trash3"></i></button>
        			<input type="hidden" value='.$users[$i]["id"].' name="userId">
        		</form>';
        	}
        	echo '</td>
        	<td>
        		<form method="post">
        			<button type="submit" class="btn btn-primary" name="userUpdate"><i class="bi bi-pencil"></i></button>
        			<input type="hidden" value='.$users[$i]["id"].' name="userId">
        		</form>
        	</td>
    	</tr>';
	}
	unset($_SESSION['users']);
 ?>