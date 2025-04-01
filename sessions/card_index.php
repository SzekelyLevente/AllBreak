<?php
	session_start();
	if(isset($_SESSION["cardEn"]))
	{
		include("../src/Database.php");
		include("../src/CardGateway.php");
		$db=new Database();
		$gateway=new CardGateway($db);
		if(isset($_POST["search"])&&(!empty($_POST["name"])||!empty($_POST["minprice"])||!empty($_POST["maxprice"])||$_POST["category"]!="0"))
		{
			$name=null;
			$minprice=null;
			$maxprice=null;
			$category=null;
			if(!empty($_POST["name"]))
			{
				$name=$_POST["name"];
			}
			if(!empty($_POST["minprice"]))
			{
				$minprice=$_POST["minprice"];
			}
			if(!empty($_POST["maxprice"]))
			{
				$maxprice=$_POST["maxprice"];
			}
			if($_POST["category"]!="0")
			{
				$category=$_POST["category"];
			}
			$cards=$gateway->getParams(["name"=>$name,"minprice"=>$minprice,"maxprice"=>$maxprice,"categoryid"=>$category],$_SESSION["card_index"]);
		}
		else
		{
			$cards=$gateway->getAll($_SESSION["card_index"]);
		}
		if(sizeof($cards)!=0)
		{
			$_SESSION["card_index"]=$_SESSION["card_index"]+20;
		}
		echo json_encode($cards);
		$db->close();
	}
	else
	{
		echo json_encode(["message"=>"Unauthorized request"]);
	}
 ?>