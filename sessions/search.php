<?php
	session_start();
	if($_SESSION["cardEn"])
	{
		include("../src/Database.php");
		include("../src/CardGateway.php");
		$db=new Database();
		$gateway=new CardGateway($db);
		$name=$_POST["name"];
		$cards=$gateway->getParams(["name"=>$name]);
		$_SESSION["card_index"]=20;
		echo json_encode($cards);
	}
	else
	{
		echo json_encode(["message"=>"Unauthorized request"]);
	}
 ?>