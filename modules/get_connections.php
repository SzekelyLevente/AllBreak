<?php
	$connections=$_SESSION['connections'];
	for ($i=0; $i < sizeof($connections); $i++) { 
	 	echo
	 	'<div class="card bg-dark text-white mt-2">
			<div class="card-body">
				<h4 class="card-title">'.$connections[$i]["name"].'</h4>
				<p class="card-text">'.$connections[$i]["text"].'</p>
				<a href="'.$connections[$i]["link"].'" class="card-link"><i class="bi bi-facebook"></i>Facebook</a>
			</div>
		</div>';
	 } 
 ?>