<!DOCTYPE html>
<html>
<head>
	<?php include("modules/head.php"); ?>
	<title>Felhasználók</title>
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
							<h1 class="bg-secondary rounded pt-3 pb-3">Felhasználók</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8 text-center">
							<?php if(isset($_SESSION['user'])){include("modules/user_update.php");} ?>
							<h3>Felhasználó hozzáadása</h3>
							<form method="post">
								<div class="mb-3 mt-3">
									<label for="name" class="form-label">Név:</label>
									<input type="text" name="name" class="form-control">
								</div>
								<div class="mb-3">
									<label for="pwd" class="form-label">Jogosultság:</label>
									<select name="permission" class="form-select">
										<option value="2">2</option>
										<option value="3" selected>3</option>
									</select>
								</div>
								<div class="mb-3">
									<label for="pwd" class="form-label">Jelszó:</label>
									<input type="password" name="password" class="form-control">
								</div>
								<div class="mb-3">
									<label for="pwd" class="form-label">Jelszó megerősítése:</label>
									<input type="password" name="passwordVerify" class="form-control">
								</div>
								<input type="submit" name="addUser" value="Hozzáadás" class="btn btn-primary">
							</form>
						</div>
						<div class="col-sm-2"></div>
						<table class="table table-striped text-center">
						    <thead>
						     	<tr>
						        	<th>Név</th>
						        	<th>Jogosultság</th>
						        	<th>Törlés</th>
						        	<th>Módosítás</th>
						      	</tr>
						    </thead>
						    <tbody>
						    	<?php include("modules/users_table.php"); ?>
						    </tbody>
					  	</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>