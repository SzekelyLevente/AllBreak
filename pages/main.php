<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<title>Főoldal</title>
</head>
<body class="d-flex flex-column min-vh-100">
	<?php include("modules/navbar.php"); ?>
	<div class="container flex-grow-1 mt-3 mb-3">
		<div class="row text-center">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php include("modules/mainimages.php"); ?>
			</div>
			<div class="col-sm-2"></div>
		</div>
		<div class="row text-center mt-3 bg-secondary rounded pt-3 pb-3">
			<h3>Kiemelt ajánlataink</h3>
		</div>
		<div class="row mt-3">
			<div style="overflow-x: scroll;">
				<?php include("modules/highligts_table.php"); ?>
			</div>
		</div>
		<div class="row text-center mt-3 bg-secondary rounded pt-3 pb-3">
			<h3>Újdonságok</h3>
		</div>
		<div class="row mt-3">
			<div style="overflow-x: scroll;">
				<?php include("modules/news_table.php"); ?>
			</div>
		</div>
	</div>
	<?php include("modules/footer.php"); ?>
</body>
</html>