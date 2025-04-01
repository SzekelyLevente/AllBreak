<?php
	$connections=$_SESSION['connections'];
	for ($i=0; $i < sizeof($connections); $i++) {
	 	echo
	 	'<tr>
         	<td>'.$connections[$i]["name"].'</td>
         	<td>'.$connections[$i]["text"].'</td>
         	<td>'.$connections[$i]["link"].'</td>
        	<td>
        		<form method="post">
        			<button type="submit" class="btn btn-danger" name="connectionDelete"><i class="bi bi-trash3"></i></button>
        			<input type="hidden" value='.$connections[$i]["id"].' name="connectionId">
        		</form>
        	</td>
        	<td>
        		<form method="post">
        			<button type="submit" class="btn btn-primary" name="connectionUpdate"><i class="bi bi-pencil"></i></button>
        			<input type="hidden" value='.$connections[$i]["id"].' name="connectionId">
        		</form>
        	</td>
    	</tr>';
	}
	unset($_SESSION['connections']); 
 ?>