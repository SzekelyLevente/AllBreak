<?php
	$mainimages=scandir("mainimages");
	$size=sizeof($mainimages);
	if($size==2)
	{
		return;
	}
 ?>
<div id="demo" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
    	<?php
    		for ($i=2; $i < $size; $i++) {
    			if($i==2)
    			{
    				echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="'.($i-2).'" class="active"></button>';
    			}
    			else
    			{
    				echo '<button type="button" data-bs-target="#demo" data-bs-slide-to="'.($i-2).'"></button>';
    			}
    		}
    	 ?>
    </div>
  	<div class="carousel-inner">
  		<?php
  			for ($i=2; $i < $size; $i++) { 
  				$class="";
  				if($i==2)
  				{
  					$class="carousel-item active";
  				}
  				else
  				{
  					$class="carousel-item";
  				}
  			 	echo
  			 	'<div class="'.$class.'">
  			 		<div class="ratio ratio-16x9">
  			 			<img src="mainimages/'.$mainimages[$i].'" alt="'.$mainimages[$i].'" class="d-block w-100">
  			 		</div>
		    	</div>';
  			 } 
  		 ?>
  	</div>
  	<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    	<span class="carousel-control-prev-icon"></span>
  	</button>
  	<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    	<span class="carousel-control-next-icon"></span>
  	</button>
</div>