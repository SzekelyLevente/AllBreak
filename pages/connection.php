<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<title>Liveok</title>
</head>
<body class="d-flex flex-column min-vh-100">
	<?php include("modules/navbar.php"); ?>
	<div class="container mt-2">
		<div class="row text-center">
			<h2>Itt is elérsz minket</h2>
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php include("modules/get_connections.php"); ?>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<?php include("modules/footer.php"); ?>
</body>
</html>