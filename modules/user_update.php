<?php $user=$_SESSION['user']; ?>
<h3>Felhasználó módosítása</h3>
<form method="post">
	<div class="mb-3 mt-3">
		<label for="name" class="form-label">Név:</label>
		<input type="text" name="name" class="form-control" value="<?php echo $user["name"] ?>">
	</div>
	<div class="mb-3">
		<label for="perm" class="form-label">Jogosultság:</label>
		<select name="permission" class="form-select">
			<option value="1" <?php if($user["permission"]==1){echo "selected";} ?>>1</option>
			<option value="2" <?php if($user["permission"]==2){echo "selected";} ?>>2</option>
			<option value="3" <?php if($user["permission"]==3){echo "selected";} ?>>3</option>
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
	<input type="hidden" name="userId" value="<?php echo $user["id"]; ?>">
	<input type="submit" name="updateUser" value="Módosítás" class="btn btn-primary">
</form>
<?php unset($_SESSION['user']); ?>