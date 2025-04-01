<?php
	class CardGateway
	{
		private $conn;

		public function __construct($database)
		{
			$this->conn=$database->conn;
		}

		public function getAll($offset=0,$limit=20)
		{
			$sql="SELECT cards.id, cards.name, price, unit, img, count, highlited, comment, isnew, priority, categories.name AS 'cname' FROM cards JOIN categories ON cards.categoryid=categories.id WHERE priority>0 ";
			$sql.="ORDER BY priority, cards.id DESC LIMIT $offset, $limit";
			$result=$this->conn->query($sql);
			$data=[];
			while($row=$result->fetch_assoc())
			{
				$data[]=$row;
			}
			return $data;
		}

		public function get($id)
		{
			$sql="SELECT cards.id, cards.name, price, unit, img, count, highlited, comment, isnew, priority, categories.name AS 'cname' FROM cards JOIN categories ON cards.categoryid=categories.id WHERE cards.id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("i",$cid);
			$cid=$id;
			$stmt->execute();
			$result=$stmt->get_result();
			$data=$result->fetch_assoc();
			$stmt->close();
			return $data;
		}

		public function getParams($params,$offset=0,$limit=20)
		{
			$sql="SELECT cards.id, cards.name, price, unit, img, count, highlited, comment, isnew, priority, categories.name AS 'cname' FROM cards JOIN categories ON cards.categoryid=categories.id WHERE ";
			$paramtypes="";
			$bparams=[];
			if(isset($params["name"]))
			{
				$name="%{$params["name"]}%";
			}
			else
			{
				$name=null;
			}
			$price=$params["price"]??null;
			$minprice=$params["minprice"]??null;
			$maxprice=$params["maxprice"]??null;
			$img=$params["img"]??null;
			$count=$params["count"]??null;
			$highlited=$params["highlited"]??null;
			$categoryid=$params["categoryid"]??null;
			$isnew=$params["isnew"]??null;
			if($name!=null)
			{
				$sql.="cards.name LIKE ? and ";
				$paramtypes.="s";
				$bparams[]=$name;
			}
			if($price!=null)
			{
				$sql.="price=? and ";
				$paramtypes.="i";
				$bparams[]=$price;
			}
			else if($minprice!=null || $maxprice!=null)
			{
				if($minprice!=null)
				{
					$sql.="price>=? and ";
					$paramtypes.="i";
					$bparams[]=$minprice;
				}
				if($maxprice!=null)
				{
					$sql.="price<=? and ";
					$paramtypes.="i";
					$bparams[]=$maxprice;
				}
			}
			if($img!=null)
			{
				$sql.="img=? and ";
				$paramtypes.="s";
				$bparams[]=$img;
			}
			if($count!=null)
			{
				$sql.="count=? and ";
				$paramtypes.="i";
				$bparams[]=$count;
			}
			if($highlited!=null)
			{
				$sql.="highlited=? and ";
				$paramtypes.="i";
				$bparams[]=$highlited;
			}
			if($categoryid!=null)
			{
				$sql.="categoryid=? and ";
				$paramtypes.="i";
				$bparams[]=$categoryid;
			}
			if($isnew!=null)
			{
				$sql.="isnew=? and ";
				$paramtypes.="i";
				$bparams[]=$isnew;
			}
			$sql=substr($sql,0,-4);
			$sql.="ORDER BY priority, cards.id DESC LIMIT $offset, $limit";
			$stmt=$this->conn->prepare($sql);
			switch(sizeof($bparams))
			{
				case 1:
					$stmt->bind_param($paramtypes,$p1);
					$p1=$bparams[0];
					break;
				case 2:
					$stmt->bind_param($paramtypes,$p1,$p2);
					$p1=$bparams[0];
					$p2=$bparams[1];
					break;
				case 3:
					$stmt->bind_param($paramtypes,$p1,$p2,$p3);
					$p1=$bparams[0];
					$p2=$bparams[1];
					$p3=$bparams[2];
					break;
				case 4:
					$stmt->bind_param($paramtypes,$p1,$p2,$p3,$p4);
					$p1=$bparams[0];
					$p2=$bparams[1];
					$p3=$bparams[2];
					$p4=$bparams[3];
					break;
				case 5:
					$stmt->bind_param($paramtypes,$p1,$p2,$p3,$p4,$p5);
					$p1=$bparams[0];
					$p2=$bparams[1];
					$p3=$bparams[2];
					$p4=$bparams[3];
					$p5=$bparams[4];
					break;
				case 6:
					$stmt->bind_param($paramtypes,$p1,$p2,$p3,$p4,$p5,$p6);
					$p1=$bparams[0];
					$p2=$bparams[1];
					$p3=$bparams[2];
					$p4=$bparams[3];
					$p5=$bparams[4];
					$p6=$bparams[5];
					break;
				case 7:
					$stmt->bind_param($paramtypes,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
					$p1=$bparams[0];
					$p2=$bparams[1];
					$p3=$bparams[2];
					$p4=$bparams[3];
					$p5=$bparams[4];
					$p6=$bparams[5];
					$p7=$bparams[6];
					break;
			}
			$stmt->execute();
			$result=$stmt->get_result();
			$data=[];
			while($row=$result->fetch_assoc())
			{
				$data[]=$row;
			}
			return $data;
		}

		public function create($data)
		{
			$sql="INSERT INTO cards(name,price,unit,img,count,highlited,comment,priority,isnew,categoryid) VALUES(?,?,?,?,?,?,?,?,?,?)";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("sissiisiii",$name,$price,$unit,$img,$count,$highlited,$comment,$priority,$isnew,$categoryid);
			$name=$data["name"];
			$price=$data["price"];
			$unit=$data["unit"];
			$img=$data["img"];
			$count=$data["count"];
			$highlited=$data["highlited"];
			$comment=$data["comment"];
			$priority=$data["priority"];
			$isnew=$data["isnew"];
			$categoryid=$data["categoryid"];
			$stmt->execute();
			$stmt->close();
			$id=$this->conn->insert_id;
			return $id;
		}

		public function update($current,$new)
		{
			$sql="UPDATE cards SET name=?, price=?, unit=?, img=?, count=?, highlited=?, comment=?, priority=?, isnew=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("sissiisiii",$name,$price,$unit,$img,$count,$highlited,$comment,$priority,$isnew,$id);
			$name=$new["name"]??$current["name"];
			$price=$new["price"]??$current["price"];
			$unit=$new["unit"]??$current["unit"];
			$img=$new["img"]??$current["img"];
			$count=$new["count"]??$current["count"];
			$highlited=$new["highlited"]??$current["highlited"];
			$comment=$new["comment"]??$current["comment"];
			$priority=$new["priority"]??$current["priority"];
			$isnew=$new["isnew"]??$current["isnew"];
			$id=$current["id"];
			$stmt->execute();
			$stmt->store_result();
			$numrows=$stmt->num_rows;
			$stmt->close();
			return $numrows;
		}

		public function delete($id)
		{
			$sql="DELETE FROM cards WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("i",$cid);
			$cid=$id;
			$stmt->execute();
			$stmt->store_result();
			$numrows=$stmt->num_rows;
			$stmt->close();
			return $numrows;
		}
	} 
 ?>