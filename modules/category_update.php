<?php $category=$_SESSION['category']; ?>
<h3>Kategória módosítása</h3>
<form method="post">
	<div class="mb-3 mt-3">
		<label for="name" class="form-label">Név:</label>
		<input type="text" name="name" class="form-control" value="<?php echo $category["name"] ?>">
	</div>
	<input type="hidden" name="categoryId" value="<?php echo $category["id"]; ?>">
	<input type="submit" name="updateCategory" value="Módosítás" class="btn btn-primary">
</form>
<?php unset($_SESSION['category']); ?>