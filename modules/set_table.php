<?php
	$cards=$_SESSION['cards'];
	for ($i=0; $i < sizeof($cards); $i++) { 
        $name=$cards[$i]["name"];
	 	echo
	 	'<div class="col-md-4 col-sm-6 col-6 mb-3">
            <div class="card h-100 d-flex flex-column" title="'.$cards[$i]["name"].'">
                <img src="./cardimages/'.$cards[$i]["id"].'-'.$cards[$i]["img"].'" class="card-img-top" alt="product">
                <div class="card-body d-flex flex-column flex-grow-1">
                    <h5 class="card-title ">'.$name.'</h5>
                    <p class="card-text" class="flex-grow-1">'.$cards[$i]["comment"].'</p>
                    <p class="card-text"><strong>Kategória:</strong> '.$cards[$i]["cname"].'</p>
                    <p class="card-text"><strong>Készleten:</strong> '.$cards[$i]["count"].' db</p>
                    <p class="card-text"><strong>Ár:</strong> '.$cards[$i]["price"].' Ft/'.$cards[$i]["unit"].'</p>
                </div>
            </div>
        </div>';
	}
	unset($_SESSION['cards']);
 ?>