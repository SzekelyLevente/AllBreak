<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<title>Főoldali képek</title>
</head>
<body>
	<?php include("modules/navbar.php"); ?>
	<div class="container mt-2">
		<div class="row">
			<div class="col-lg-2 bg-secondary rounded">
				<?php include("modules/admin_sidebar.php"); ?>
			</div>
			<div class="col-lg-10 text-center mt-2">
				<h1 class="bg-secondary rounded pt-3 pb-3">Főoldali képek</h1>
				<div class="rounded bg-secondary mb-5">
					<h3>Kép hozzáadása</h3>
					<p>Megjegyzés: a 16x9 vagy a nagyjából ugyanilyen méretarányú képek ajánlottak</p>
					<form method="post" enctype="multipart/form-data">
						<input class="form-control bg-secondary mb-2" type="file" name="image" accept=".jpg,.jpeg,.png,.gif">
						<input class="btn btn-primary" type="submit" name="upload" value="feltöltés">
					</form>
				</div>
				<?php include("modules/mainimages_load.php"); ?>
			</div>
		</div>
	</div>
</body>
</html>