<?php
	$categories=$_SESSION['categories'];
	for ($i=0; $i < sizeof($categories); $i++) { 
	 	echo
	 	'<tr>
         	<td>'.$categories[$i]["name"].'</td>
        	<td>
        		<form method="post">
        			<button type="submit" class="btn btn-danger" name="categoryDelete"><i class="bi bi-trash3"></i></button>
        			<input type="hidden" value='.$categories[$i]["id"].' name="categoryId">
        		</form>
        	</td>
        	<td>
        		<form method="post">
        			<button type="submit" class="btn btn-primary" name="categoryUpdate"><i class="bi bi-pencil"></i></button>
        			<input type="hidden" value='.$categories[$i]["id"].' name="categoryId">
        		</form>
        	</td>
    	</tr>';
	}
	unset($_SESSION['categories']);
 ?>