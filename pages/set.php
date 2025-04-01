<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
    <script type="text/javascript" src="js/set.js"></script>
	<title>Készlet</title>
</head>
<body class="d-flex flex-column min-vh-100">
	<?php include("modules/navbar.php"); ?>
	<div class="container flex-grow-1">
		<div class="row text-center pt-3 pb-3">
			<form method="get" class="mb-4">
				<input type="hidden" name="page" value="set">
	            <div class="row g-3">
	                <div class="col-md-3">
	                    <label for="nameFilter" class="form-label">Név:</label>
	                    <input type="text" name="name" class="form-control" placeholder="Név" value="<?php if(isset($_GET['name'])){echo $_GET['name'];} ?>">
	                </div>
	                <div class="col-md-3">
	                    <label for="priceFilter" class="form-label">Min Ár (Ft):</label>
	                    <input type="number" min="0" name="minprice" class="form-control" placeholder="Min ár" value="<?php if(isset($_GET['minprice'])){echo $_GET['minprice'];} ?>">
	                </div>
	                <div class="col-md-3">
	                    <label for="priceFilter" class="form-label">Max Ár (Ft):</label>
	                    <input type="number" min="0" name="maxprice" class="form-control" placeholder="Max ár" value="<?php if(isset($_GET['maxprice'])){echo $_GET['maxprice'];} ?>">
	                </div>
	                <div class="col-md-3">
	                    <label for="categoryFilter" class="form-label">Kategória:</label>
	                    <select name="category" class="form-select">
	                        <option value="0">Összes</option>
	                        <?php
	                        	$categories=$_SESSION["categories"];
	                        	for ($i=0; $i < sizeof($categories); $i++) {
	                        		$selected="";
	                        		if(isset($_GET["category"])&&$categories[$i]["id"]==$_GET['category'])
	                        		{
	                        			$selected="selected";
	                        		}
	                        	 	echo '<option value="'.$categories[$i]["id"].'" '.$selected.'>'.$categories[$i]["name"].'</option>';
	                        	} 
	                        	unset($_SESSION["categories"]);
	                         ?>
	                    </select>
	                </div>
	            </div>
	            <div class="text-center mt-3">
	                <input type="submit" name="search" value="keresés" class="btn btn-dark">
	            </div>
	        </form>
		</div>
	</div>
	<div class="container mt-4">
		<div class="row row-cols-lg-4" id="cards">
			<?php include("modules/set_table.php"); ?>
		</div>
		<div class="text-center mb-3">
			<button id="more" class="btn btn-primary">Többi betöltése</button>
		</div>
	</div>
	<?php include("modules/footer.php"); ?>
</body>
</html>
<?php unset($_SESSION['categories']); ?>