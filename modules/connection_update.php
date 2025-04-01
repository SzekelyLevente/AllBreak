<?php $connection=$_SESSION['connection']; ?>
<h3>Kapcsolat módosítása</h3>
<form method="post">
	<div class="mb-3 mt-3">
		<label for="name" class="form-label">Név:</label>
		<input type="text" name="name" class="form-control" value="<?php echo $connection["name"] ?>">
	</div>
	<div class="mb-3 mt-3">
		<label for="text" class="form-label">Szöveg:</label>
		<textarea type="text" name="text" class="form-control"><?php echo $connection["text"] ?></textarea>
	</div>
	<div class="mb-3 mt-3">
		<label for="link" class="form-label">Link:</label>
		<input type="text" name="link" class="form-control" value="<?php echo $connection["link"] ?>">
	</div>
	<input type="hidden" name="connectionId" value="<?php echo $connection["id"]; ?>">
	<input type="submit" name="updateConnection" value="Módosítás" class="btn btn-primary">
</form>
<?php unset($_SESSION['connection']); ?>