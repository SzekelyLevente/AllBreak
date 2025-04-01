<?php
	$categories=$_SESSION["categories"];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<script type="text/javascript" src="js/cards.js"></script>
	<title>Kártyák</title>
</head>
<body>
	<?php include("modules/navbar.php"); ?>
	<div class="container mt-2">
		<div class="row">
			<div class="col-lg-2 bg-secondary rounded">
				<?php include("modules/admin_sidebar.php"); ?>
			</div>
			<div class="col-lg-10 mt-2">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h1 class="bg-secondary rounded pt-3 pb-3">Kártyák</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
							<?php if(isset($_SESSION['card'])){include("modules/card_update.php");} ?>
							<h3>Kártya hozzáadása</h3>
							<form method="post" enctype="multipart/form-data">
								<div class="mb-3 mt-3">
									<label for="name" class="form-label">Név:</label>
									<input type="text" name="name" class="form-control">
								</div>
								<div class="mb-3">
									<label for="price" class="form-label">Ár:</label>
									<input type="number" name="price" class="form-control">
								</div>
								<div class="mb-3">
									<label for="price" class="form-label">egység:</label>
									<input type="text" name="unit" class="form-control">
								</div>
								<div class="mb-3">
									<label for="img" class="form-label">Kép:</label>
									<p>Megjegyzés: a 3x4 vagy a nagyjából ugyanilyen méretarányú képek ajánlottak</p>
									<input type="file" name="img" class="form-control" accept=".jpg,.jpeg,.png,.gif">
								</div>
								<div class="mb-3">
									<label for="count" class="form-label">Darab:</label>
									<input type="number" name="count" class="form-control">
								</div>
								<div class="mb-3">
									<label for="highlited" class="form-label">Kiemelt:</label>
									<select name="highlited" class="form-select">
										<option value="0">Nem</option>
										<option value="1">Igen</option>
									</select>
								</div>
								<div class="mb-3">
									<label for="comment" class="form-label">Megjegyzés:</label>
									<textarea name="comment" class="form-control"></textarea>
								</div>
								<div class="mb-3">
									<label for="priority" class="form-label">Prioritás:</label>
									<input type="number" name="priority" class="form-control">
								</div>
								<div class="mb-3">
									<label for="isnew" class="form-label">Újdonság:</label>
									<select name="isnew" class="form-select">
										<option value="0">Nem</option>
										<option value="1">Igen</option>
									</select>
								</div>
								<div class="mb-3">
									<label for="category" class="form-label">Kategória:</label>
									<select name="categoryid" class="form-select">
										<?php
											for ($i=0; $i < sizeof($categories); $i++) { 
											 	echo '<option value="'.$categories[$i]["id"].'">'.$categories[$i]["name"].'</option>';
											 } 
										 ?>
									</select>
								</div>
								<input type="submit" name="addCard" value="Hozzáadás" class="btn btn-primary">
							</form>
							<input type="text" id="search" class="form-control mt-2" placeholder="keresés név alapján">
						</div>
						<div class="col-sm-2"></div>
					</div>
					<div class="row">
						<div class="col-sm-12" id="cards">
							<?php include("modules/cards_table.php"); ?>
						</div>
						<div class="text-center mb-3">
							<button id="more" class="btn btn-primary">Többi betöltése</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php unset($_SESSION["categories"]); ?>