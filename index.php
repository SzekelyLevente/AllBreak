<?php
	session_start();
	spl_autoload_register(function($class){
		require __DIR__."/src/$class.php";
	});
	$db=new Database();
	$userGateway=new UserGateway($db);
	$categoryGateway=new CategoryGateway($db);
	$connectionGateway=new ConnectionGateway($db);
	$cardGateway=new CardGateway($db);
	$page=$_GET['page']??null;
	//unset($_SESSION['next_attempt_time']);
	$_SESSION["categories"]=$categoryGateway->getAll();
	if(isset($_GET['page']))
	{
		switch ($page) {
			case 'set':
				set($cardGateway,$categoryGateway);
				break;
			case 'livepage':
				livepage($liveGateway);
				break;
			case 'login':
				login($userGateway);
				break;
			case "mainimages":
				mainimages();
				break;
			case "users":
				users($userGateway);
				break;
			case "categories":
				categories($categoryGateway);
				break;
			case "connections":
				connections($connectionGateway);
				break;
			case "connection":
				connection($connectionGateway);
				break;
			case "cards":
				cards($cardGateway,$categoryGateway);
				break;
			case "logout":
				logout($cardGateway);
				break;
			default:
				main($cardGateway);
				break;
		}
	}
	else
	{
		main($cardGateway);
	}
	$db->close();

	function connections($connectionGateway)
	{
		if (isset($_POST["addConnection"]))
		{
			if(!empty($_POST["name"])&&!empty($_POST["text"])&&!empty($_POST["link"]))
			{
				$connectionGateway->create(["name"=>$_POST["name"],"text"=>$_POST["text"],"link"=>$_POST["link"]]);
				$message=new Message("Létrehozás","Kapcsolat sikeresen létrehozva!");
			}
			else
			{
				$message=new Message("Létrehozás","Töltsd ki az összes mezőt!");
			}
		}
		if(isset($_POST["connectionUpdate"]))
		{
			$_SESSION["connection"]=$connectionGateway->get($_POST["connectionId"]);
		}
		if(isset($_POST["updateConnection"]))
		{
			if(!empty($_POST["name"])&&!empty($_POST["text"])&&!empty($_POST["link"]))
			{
				$current=$connectionGateway->get($_POST["connectionId"]);
				$connectionGateway->update($current,["name"=>$_POST["name"],"text"=>$_POST["text"],"link"=>$_POST["link"]]);
				$message=new Message("Módosítás","Kapcsolat sikeresen módosítva!");
			}
			else
			{
				$message=new Message("Módosítás","Töltsd ki az összes mezőt!");
			}
		}
		if(isset($_POST["connectionDelete"]))
		{
			$id=$_POST["connectionId"];
			$numRows=$connectionGateway->delete($id);
			$message=new Message("Törlés","Kapcsolat sikeresen törölve!");
		}
		$_SESSION["connections"]=$connectionGateway->getAll();
		sessionCheck("connections");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function set($cardGateway,$categoryGateway)
	{
		if(isset($_GET["search"])&&(!empty($_GET["name"])||!empty($_GET["minprice"])||!empty($_GET["maxprice"])||$_GET["category"]!="0"))
		{
			$name=null;
			$minprice=null;
			$maxprice=null;
			$category=null;
			if(!empty($_GET["name"]))
			{
				$name=$_GET["name"];
			}
			if(!empty($_GET["minprice"]))
			{
				$minprice=$_GET["minprice"];
			}
			if(!empty($_GET["maxprice"]))
			{
				$maxprice=$_GET["maxprice"];
			}
			if($_GET["category"]!="0")
			{
				$category=$_GET["category"];
			}
			$_SESSION["cards"]=$cardGateway->getParams(["name"=>$name,"minprice"=>$minprice,"maxprice"=>$maxprice,"categoryid"=>$category]);
		}
		else
		{
			$_SESSION["cards"]=$cardGateway->getAll();
		}
		if(sizeof($_SESSION["cards"])!=0)
		{
			$_SESSION["card_index"]=20;
		}
		else
		{
			$message=new Message("Keresés","Nincs a keresésnek megfelelő találat!");
		}
		$_SESSION["categories"]=$categoryGateway->getAll();
		include("pages/set.php");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function login($userGateway)
	{
		if(isset($_POST['login']))
		{
			checkAttemptTime();
			if(!isset($_SESSION["next_attempt_time"]))
			{
				$user=$userGateway->getParams(["name"=>$_POST['name']]);
				$error=false;
				if(sizeof($user)==0)
				{
					$error=true;
				}
				else if(!password_verify($_POST['password'], $user[0]["password"]))
				{
					$error=true;
				}
				if(!$error)
				{
					$_SESSION['usr']=$user[0];
					header("Location: .?page=mainimages");
				}
				else
				{
					attemptCountIncrease();
					include("pages/login.php");
					$message=new Message("Hiba","Hibás felhasználó név vagy jelszó!");
					$message->getMessage();
				}
			}
			else
			{
				include("pages/login.php");
				$message=new Message("Hiba","Elérted a maximális próbálkozási lehetőségek számát! Legközelebb ekkor próbálkozhatsz: ".$_SESSION["next_attempt_time"]);
				$message->getMessage();
			}
		}
		else
		{
			include("pages/login.php");
		}
	}

	function main($cardGateway)
	{
		$_SESSION["cards"]=$cardGateway->getParams(["highlited"=>1]);
		$_SESSION["newcards"]=$cardGateway->getParams(["isnew"=>1]);
		unsetSession("cardEn");
		include("pages/main.php");
	}

	function logout($cardGateway)
	{
		unsetSession("usr");
		unsetSession("cardEn");
		main($cardGateway);
	}

	function connection($connectionGateway)
	{
		$_SESSION["connections"]=$connectionGateway->getAll();
		unsetSession("cardEn");
		include("pages/connection.php");
	}

	function cards($cardGateway,$categoryGateway)
	{
		if(isset($_POST["cardDelete"]))
		{
			$id=$_POST["cardId"];
			$card=$cardGateway->get($id);
			$image=$card["img"];
			$numRows=$cardGateway->delete($id);
			unlink("cardimages/".$id."-".$image);
			$message=new Message("Törlés","Kártya sikeresen törölve!");
		}
		if(isset($_POST["addCard"]))
		{
			if(!empty($_POST["name"])&&!empty($_POST["price"])&&is_uploaded_file($_FILES['img']['tmp_name'])&&!empty($_POST["count"])&&!empty($_POST["categoryid"])&&!empty($_POST["unit"]))
			{
				$id=$cardGateway->create(["name"=>$_POST["name"],"price"=>$_POST["price"],"unit"=>$_POST["unit"],"img"=>basename($_FILES["img"]["name"]),"count"=>$_POST["count"],"highlited"=>$_POST["highlited"],"comment"=>$_POST["comment"],"categoryid"=>$_POST["categoryid"],"priority"=>$_POST["priority"],"isnew"=>$_POST["isnew"]]);
				imageUpload("cardimages/$id-","img");
				$message=new Message("Létrehozás","Kártya sikeresen létrehozva!");
			}
			else
			{
				$message=new Message("Létrehozás","Töltsd ki az összes mezőt!");
			}
		}
		if(isset($_POST["updateCard"]))
		{
			if(!empty($_POST["name"])&&!empty($_POST["price"])&&$_POST["count"]>=0&&$_POST["priority"]>=0)
			{
				$current=$cardGateway->get($_POST["cardId"]);
				if(is_uploaded_file($_FILES["img"]["tmp_name"]))
				{
					unlink("cardimages/".$current["id"]."-".$current["img"]);
					imageUpload("cardimages/".$current["id"]."-","img");
					$cardGateway->update($current,["name"=>$_POST["name"],"price"=>$_POST["price"],"unit"=>$_POST["unit"],"img"=>basename($_FILES["img"]["name"]),"count"=>$_POST["count"],"highlited"=>$_POST["highlited"],"comment"=>$_POST["comment"],"priority"=>$_POST["priority"],"isnew"=>$_POST["isnew"]]);
				}
				else
				{
					$cardGateway->update($current,["name"=>$_POST["name"],"price"=>$_POST["price"],"unit"=>$_POST["unit"],"count"=>$_POST["count"],"highlited"=>$_POST["highlited"],"comment"=>$_POST["comment"],"priority"=>$_POST["priority"],"isnew"=>$_POST["isnew"]]);
				}
				$message=new Message("Módosítás","Kártya sikeresen módosítva!");
			}
			else
			{
				$message=new Message("Módosítás","Töltsd ki a képen kívül az összes mezőt!");
			}
		}
		$_SESSION["categories"]=$categoryGateway->getAll();
		$_SESSION["cards"]=$cardGateway->getAll();
		$_SESSION["card_index"]=20;
		$_SESSION["cardEn"]=true;
		sessionCheck("cards");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function categories($categoryGateway)
	{
		if(isset($_POST["categoryUpdate"]))
		{
			$id=$_POST["categoryId"];
			$_SESSION["category"]=$categoryGateway->get($id);
		}
		if(isset($_POST["categoryDelete"]))
		{
			$id=$_POST["categoryId"];
			$numRows=$categoryGateway->delete($id);
			$message=new Message("Törlés","Kategória sikeresen törölve!");
		}
		if(isset($_POST["addCategory"]))
		{
			if(!empty($_POST["name"]))
			{
				$categoryGateway->create(["name"=>$_POST["name"]]);
				$message=new Message("Létrehozás","Kategória sikeresen létrehozva!");
			}
			else
			{
				$message=new Message("Létrehozás","Töltsd ki az összes mezőt!");
			}
		}
		if(isset($_POST["updateCategory"]))
		{
			if(!empty($_POST["name"]))
			{
				$current=$categoryGateway->get($_POST["categoryId"]);
				$categoryGateway->update($current,["name"=>$_POST["name"]]);
				$message=new Message("Módosítás","Kategória sikeresen módosítva!");
			}
			else
			{
				$message=new Message("Módosítás","Töltsd ki az összes mezőt!");
			}
		}
		$_SESSION["categories"]=$categoryGateway->getAll();
		unsetSession("cardEn");
		sessionCheck("categories");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function users($userGateway)
	{
		if(isset($_POST["userUpdate"]))
		{
			$id=$_POST['userId'];
			$_SESSION["user"]=$userGateway->get($id);
		}
		if(isset($_POST["userDelete"]))
		{
			$id=$_POST['userId'];
			$numRows=$userGateway->delete($id);
			$message=new Message("Törlés","Felhasználó sikeresen törölve!");
		}
		if(isset($_POST["addUser"]))
		{
			if(!empty($_POST["name"])&&!empty($_POST["password"])&&!empty($_POST["passwordVerify"]))
			{
				if($_POST['password']==$_POST['passwordVerify'])
				{
					$userGateway->create(["name"=>$_POST["name"],"password"=>$_POST["password"],"permission"=>$_POST["permission"]]);
					$message=new Message("Létrehozás","Felhasználó sikeresen létrehozva!");
				}
				else
				{
					$message=new Message("Létrehozás","A jelszó megerősítése nem egyezik!");
				}
			}
			else
			{
				$message=new Message("Létrehozás","Töltsd ki az összes mezőt!");
			}
		}
		if(isset($_POST["updateUser"]))
		{
			if(!empty($_POST["name"]))
			{
				if(!empty($_POST["password"])&&!empty($_POST["passwordVerify"]))
				{
					if($_POST['password']==$_POST['passwordVerify'])
					{
						$current=$userGateway->get($_POST["userId"]);
						$userGateway->update($current,["name"=>$_POST["name"],"password"=>$_POST["password"],"permission"=>$_POST["permission"]]);
						$message=new Message("Módosítás","Felhasználó sikeresen módosítva!");
					}
					else
					{
						$message=new Message("Módosítás","A jelszó megerősítése nem egyezik!");
					}
				}
				else
				{
					$current=$userGateway->get($_POST["userId"]);
					$userGateway->update($current,["name"=>$_POST["name"],"permission"=>$_POST["permission"]]);
					$message=new Message("Módosítás","Felhasználó sikeresen módosítva!");
				}
			}
			else
			{
				$message=new Message("Módosítás","Töltsd ki az összes mezőt!");
			}
		}
		$_SESSION['users']=$userGateway->getAll();
		unsetSession("cardEn");
		sessionCheck("users");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function mainimages()
	{
		if(isset($_POST['imageDelete']))
		{
			$imageName=$_POST['imageName'];
			unlink("mainimages/$imageName");
			$message=new Message("Törlés","A kép sikeresen törlésre került!");
		}
		if(isset($_POST['upload']))
		{
			$message=imageUpload("mainimages/","image");
		}
		unsetSession("cardEn");
		sessionCheck("mainimages");
		if(isset($message))
		{
			$message->getMessage();
		}
	}

	function sessionCheck($page)
	{
		if(isset($_SESSION['usr']))
		{
			include("pages/$page.php");
		}
		else
		{
			include("pages/main.php");
		}
	}

	function imageUpload($target_dir,$name)
	{
		$target_file = $target_dir . basename($_FILES[$name]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$fileName=pathinfo($target_file,PATHINFO_FILENAME);
		$msg="";
		$message=null;
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") 
		{
			$msg="Csak JPG, JPEG, PNG és GIF fájlok engedélyezettek.";
			$uploadOk = 0;
		}
		if($uploadOk==0)
		{
			$message=new Message("Feltöltés",$msg);
		}
		else
		{
			if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file))
			{
				$message=new Message("Feltöltés","A kép sikeresen feltöltve!");
			}
			else
			{
				$message=new Message("Feltöltés","Nem sikerült feltölteni a képet!");
			}
		}
		return $message;
	}

	function attemptCountIncrease()
	{
		$maxCount=5;
		$lock=false;
		if(isset($_SESSION["attempt_count"]))
		{
			$_SESSION["attempt_count"]=$_SESSION['attempt_count']+1;
		}
		else
		{
			$_SESSION["attempt_count"]=1;
		}

		if($_SESSION['attempt_count']==$maxCount)
		{
			$d=strtotime("+1 Hours");
			$_SESSION["next_attempt_time"]=date("Y-m-d h:i:sa", $d);
			$lock=true;
		}
		return $lock;
	}

	function checkAttemptTime()
	{
		if(isset($_SESSION["next_attempt_time"]) && date("Y-m-d h:i:sa")>=$_SESSION["next_attempt_time"])
		{
			unset($_SESSION["next_attempt_time"]);
			unset($_SESSION["attempt_count"]);
		}
	}

	function unsetSession($name)
	{
		if(isset($_SESSION[$name]))
		{
			unset($_SESSION[$name]);
		}
	}
?>