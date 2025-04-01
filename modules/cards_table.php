<?php
	$cards=$_SESSION['cards'];
	for ($i=0; $i < sizeof($cards); $i++) {
		$highlited="";
		switch ($cards[$i]["highlited"]) {
			case 0:
				$highlited="Nem";
				break;
			case 1:
				$highlited="Igen";
				break;
		}
    $isnew="";
    switch ($cards[$i]["isnew"]) {
      case 0:
        $isnew="Nem";
        break;
      case 1:
        $isnew="Igen";
        break;
    }
	 	echo
	 	'<div class="card mt-2 mb-2 bg-secondary rounded text-center">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h4 class="card-title" id="nam'.$cards[$i]["id"].'">'.$cards[$i]["name"].'</h4>
            <img src="./cardimages/'.$cards[$i]["id"].'-'.$cards[$i]["img"].'" style="height: 100px">
            <div class="mt-3">
              <form method="post" style="display: inline;">
                <button type="submit" class="btn btn-danger" name="cardDelete"><i class="bi bi-trash3"></i></button>
                <input type="hidden" value="'.$cards[$i]["id"].'" name="cardId">
              </form>
              <button class="btn btn-primary cardUpdate" data-id="'.$cards[$i]["id"].'"><i class="bi bi-pencil"></i></button>
            </div>
          </div>
          <div class="col-6">
            <p class="card-text"><strong>Kategória:</strong> '.$cards[$i]["cname"].'</p>
            <p class="card-text"><strong>Ár:</strong> <span id="pric'.$cards[$i]["id"].'">'.$cards[$i]["price"].'</span> Ft/<span id="uni'.$cards[$i]["id"].'">'.$cards[$i]["unit"].'</span></p>
            <p class="card-text"><strong>Készlet:</strong> <span id="cou'.$cards[$i]["id"].'">'.$cards[$i]["count"].' db</span></p>
            <p class="card-text"><strong>Megjegyzés:</strong> <span id="com'.$cards[$i]["id"].'">'.$cards[$i]["comment"].'</span></p>
            <p class="card-text"><strong>Kiemelt:</strong> <span id="hig'.$cards[$i]["id"].'">'.$highlited.'</span></p>
            <p class="card-text"><strong>Prioritás:</strong> <span id="prio'.$cards[$i]["id"].'">'.$cards[$i]["priority"].'</span></p>
            <p class="card-text"><strong>Újdonság:</strong> <span id="isn'.$cards[$i]["id"].'">'.$isnew.'</span></p>
          </div>
        </div>
      </div>
      <div id="upd'.$cards[$i]["id"].'" style="display: none">
        <div class="mb-3 mt-3">
          <label for="name" class="form-label">Név:</label>
          <input type="text" id="name'.$cards[$i]["id"].'" class="form-control" value="'.$cards[$i]["name"].'">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Ár:</label>
          <input type="number" id="price'.$cards[$i]["id"].'" class="form-control" value="'.$cards[$i]["price"].'">
        </div>
        <div class="mb-3">
          <label for="unit" class="form-label">Egység:</label>
          <input type="text" id="unit'.$cards[$i]["id"].'" class="form-control" value="'.$cards[$i]["unit"].'">
        </div>
        <div class="mb-3">
          <label for="count" class="form-label">Darab:</label>
          <input type="number" id="count'.$cards[$i]["id"].'" class="form-control" value="'.$cards[$i]["count"].'">
        </div>
        <div class="mb-3">
          <label for="highlited" class="form-label">Kiemelt:</label>
          <select id="highlited'.$cards[$i]["id"].'" class="form-select">
            <option value="0" '; if($highlited=="Nem"){echo 'selected';} echo '>Nem</option>
            <option value="1" '; if($highlited=="Igen"){echo 'selected';} echo '>Igen</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="comment" class="form-label">Megjegyzés:</label>
          <textarea id="comment'.$cards[$i]["id"].'" class="form-control">'.$cards[$i]["comment"].'</textarea>
        </div>
        <div class="mb-3">
          <label for="priority" class="form-label">Prioritás:</label>
          <input type="number" id="priority'.$cards[$i]["id"].'" class="form-control" value="'.$cards[$i]["priority"].'">
        </div>
        <div class="mb-3">
          <label for="isnew" class="form-label">Újdonság:</label>
          <select id="isnew'.$cards[$i]["id"].'" class="form-select">
            <option value="0" '; if($isnew=="Nem"){echo 'selected';} echo '>Nem</option>
            <option value="1" '; if($isnew=="Igen"){echo 'selected';} echo '>Igen</option>
          </select>
        </div>
        <button class="btn btn-primary updateCard" data-id="'.$cards[$i]["id"].'">Módosítás</button>
      </div>
    </div>';
	}
	unset($_SESSION['cards']); 
 ?>