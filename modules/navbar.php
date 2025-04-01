<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href=".">
			<img src="logo.jpg" alt="Logo" style="width:40px;" class="rounded-pill">AllBreak
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
  			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
  			<ul class="navbar-nav">
    			<li class="nav-item">
      				<a class="nav-link <?php if(!isset($_GET['page'])){echo "active";} ?>" href=".">Főoldal</a>
    			</li>
    			<li class="nav-item dropdown">
      				<a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=="set"){echo "active";} ?> dropdown-toggle" href=".?page=set" role="button" data-bs-toggle="dropdown">Készlet</a>
      				<ul class="dropdown-menu">
      					<li><a class="dropdown-item" href=".?page=set">Összes</a></li>
      					<?php
      						$categories=$_SESSION["categories"];
      						for ($i=0; $i < sizeof($categories); $i++) { 
      							echo '<li><a class="dropdown-item" href=".?page=set&category='.$categories[$i]["id"].'&search=keresés">'.$categories[$i]["name"].'</a></li>';
      						}
      					 ?>
      				</ul>
    			</li>
    			<li class="nav-item">
      				<a class="nav-link <?php if(isset($_GET['page'])&&$_GET['page']=="connection"){echo "active";} ?> " href=".?page=connection">Kapcsolat</a>
    			</li>
    			<?php
    				if(isset($_SESSION['usr']))
    				{
    					$admin="";
    					if(isset($_GET["page"])&&($_GET["page"]=="mainimages" || $_GET["page"]=="users" || $_GET["page"]=="categories" || $_GET["page"]=="cards"))
    					{
    						$admin="active";
    					}
    					$logout="";
    					if(isset($_GET["page"])&&$_GET["page"]=="logout")
    					{
    						$logout="active";
    					}
    					echo
    					'<li class="nav-item">
		      				<a class="nav-link '.$admin.'" href=".?page=mainimages">Admin</a>
		    			</li>
    					<li class="nav-item">
		      				<a class="nav-link '.$logout.'" href=".?page=logout">Kijelentkezés</a>
		    			</li>';
    				} 
    				else
    				{
    					$login="";
    					if(isset($_GET["page"])&&$_GET["page"]=="login")
    					{
    						$login="active";
    					}
    					echo
    					'<li class="nav-item">
		      				<a class="nav-link '.$login.'" href=".?page=login">Belépés</a>
		    			</li>';
    				}
    			 ?>
  			</ul>
		</div>
	</div>
</nav>