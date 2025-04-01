<?php
	$card=$_SESSION['card'];
	$categories=$_SESSION["categories"];
?>
<h3>Kártya módosítása</h3>
<form method="post" enctype="multipart/form-data">
	<div class="mb-3 mt-3">
		<label for="name" class="form-label">Név:</label>
		<input type="text" name="name" class="form-control" value="<?php echo $card["name"]; ?>">
	</div>
	<div class="mb-3">
		<label for="price" class="form-label">Ár:</label>
		<input type="number" name="price" class="form-control" value="<?php echo $card["price"]; ?>">
	</div>
	<div class="mb-3">
		<label for="unit" class="form-label">Egység:</label>
		<input type="text" name="unit" class="form-control" value="<?php echo $card["unit"]; ?>">
	</div>
	<div class="mb-3">
		<label for="img" class="form-label">Kép:</label>
		<input type="file" name="img" class="form-control" accept=".jpg,.jpeg,.png,.gif">
	</div>
	<div class="mb-3">
		<label for="count" class="form-label">Darab:</label>
		<input type="number" name="count" class="form-control" value="<?php echo $card["count"]; ?>">
	</div>
	<div class="mb-3">
		<label for="highlited" class="form-label">Kiemelt:</label>
		<select name="highlited" class="form-select">
			<option value="0" <?php if($card["highlited"]==0){echo "selected";} ?>>Nem</option>
			<option value="1" <?php if($card["highlited"]==1){echo "selected";} ?>>Igen</option>
		</select>
	</div>
	<div class="mb-3">
		<label for="comment" class="form-label">Megjegyzés:</label>
		<textarea name="comment" class="form-control"><?php echo $card["comment"]; ?></textarea>
	</div>
	<div class="mb-3">
		<label for="priority" class="form-label">Prioritás:</label>
		<input type="number" name="priority" class="form-control" value="<?php echo $card["priority"]; ?>">
	</div>
	<div class="mb-3">
		<label for="isnew" class="form-label">Újdonság:</label>
		<select name="isnew" class="form-select">
			<option value="0" <?php if($card["isnew"]==0){echo "selected";} ?>>Nem</option>
			<option value="1" <?php if($card["isnew"]==1){echo "selected";} ?>>Igen</option>
		</select>
	</div>
	<input type="hidden" name="cardId" value="<?php echo $card["id"]; ?>">
	<input type="submit" name="updateCard" value="Módosítás" class="btn btn-primary">
</form>
<?php
	unset($_SESSION['card']);
	unset($_SESSION["categories"]);
?>