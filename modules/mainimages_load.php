<?php
	$imageFiles=scandir("mainimages");
	$images=[];
	for ($i=2; $i < sizeof($imageFiles); $i++) { 
		$images[]=$imageFiles[$i];
	}
	for ($i=0; $i < sizeof($images); $i++) { 
		if($i%3==0)
		{
			echo '<div class="row">';
		}
		echo
		'<div class="col-sm-4 text-center images">
			<div class="rounded bg-secondary">
				<img style="height: 200px; max-width: 100%" src="mainimages/'.$images[$i].'">
				<form method="post">
					<input type="hidden" name="imageName" value="'.$images[$i].'">
					<input type="submit" value="törlés" name="imageDelete" class="btn btn-danger form-control">
				</form>
			</div>
		</div>';
		if($i%3==2 || $i==sizeof($images)-1)
		{
			echo '</div>';
		}
	}
 ?>