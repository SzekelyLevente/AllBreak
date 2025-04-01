<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<title>Login</title>
</head>
<body class="d-flex flex-column min-vh-100">
	<?php include("modules/navbar.php"); ?>
	<div class="container flex-grow-1">
		<div class="row text-center">
			<h1>Bejelentkezés</h1>
			<form method="post">
				<div class="mb-3 mt-3">
					<label for="name" class="form-label">Név:</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="mb-3">
					<label for="pwd" class="form-label">Jelszó:</label>
					<input type="password" name="password" class="form-control">
				</div>
				<input type="submit" name="login" value="Bejelentkezés" class="btn btn-primary">
			</form>
		</div>
	</div>
	<?php include("modules/footer.php"); ?>
</body>
</html>