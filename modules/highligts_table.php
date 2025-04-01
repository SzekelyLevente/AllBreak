<div class="d-flex">
<?php
	$cards=$_SESSION["cards"];
	for ($i=0; $i < sizeof($cards); $i++) {
		echo
		'<div class="mb-3 col-lg-3 col-sm-4 col-6">
            <div class="card me-3 h-100 d-flex flex-column" title="'.$cards[$i]["name"].'">
                <img src="./cardimages/'.$cards[$i]["id"].'-'.$cards[$i]["img"].'" class="card-img-top" alt="product">
                <div class="card-body d-flex flex-column flex-grow-1">
                    <h5>'.$cards[$i]["name"].'</h5>
                    <p class="card-text" class="card-title flex-grow-1">'.$cards[$i]["comment"].'</p>
                    <p class="card-text"><strong>Kategória:</strong> '.$cards[$i]["cname"].'</p>
                    <p class="card-text"><strong>Készleten:</strong> '.$cards[$i]["count"].' db</p>
                    <p class="card-text"><strong>Ár:</strong> '.$cards[$i]["price"].' Ft/'.$cards[$i]["unit"].'</p>
                </div>
            </div>
        </div>';
	}
	unset($_SESSION["cards"]);
 ?>
</div>