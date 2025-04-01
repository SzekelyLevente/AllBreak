<?php
	session_start();
	if(isset($_SESSION["cardEn"]))
	{
		if(!empty($_POST["name"])&&!empty($_POST["price"])&&$_POST["count"]>=0&&$_POST["priority"]>=0)
		{
			include("../src/Database.php");
			include("../src/CardGateway.php");
			$db=new Database();
			$gateway=new CardGateway($db);
			$current=$gateway->get($_POST["id"]);
			$gateway->update($current,["name"=>$_POST["name"],"price"=>$_POST["price"],"unit"=>$_POST["unit"],"count"=>$_POST["count"],"highlited"=>$_POST["highlited"],"comment"=>$_POST["comment"],"priority"=>$_POST["priority"],"isnew"=>$_POST["isnew"]]);
			$db->close();
			echo json_encode(["success"=>true]);
		}
		else
		{
			echo json_encode(["success"=>false]);
		}
	}
	else
	{
		echo json_encode(["message"=>"Unauthorized request"]);
	}
 ?>