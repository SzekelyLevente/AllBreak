<?php
	class ConnectionGateway{
		private $conn;

		public function __construct($database)
		{
			$this->conn=$database->conn;
		}

		public function getAll()
		{
			$sql="SELECT * FROM connections";
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
			$sql="SELECT * FROM connections WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("i",$cid);
			$cid=$id;
			$stmt->execute();
			$result=$stmt->get_result();
			$data=$result->fetch_assoc();
			$stmt->close();
			return $data;
		}

		public function getParams($params)
		{
			$sql="SELECT * FROM connections WHERE ";
			$paramtypes="";
			$bparams=[];
			$name=$params["name"]??null;
			$text=$params["text"]??null;
			$link=$params["link"]??null;
			if($name!=null)
			{
				$sql.="name=? and ";
				$paramtypes.="s";
				$bparams[]=$name;
			}
			if($text!=null)
			{
				$sql.="text=? and ";
				$paramtypes.="s";
				$bparams[]=$text;
			}
			if($link!=null)
			{
				$sql.="link=? and ";
				$paramtypes.="s";
				$bparams[]=$link;
			}
			$sql=substr($sql,0,-4);
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
			$sql="INSERT INTO connections(name,text,link) VALUES(?,?,?)";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("sss",$name,$text,$link);
			$name=$data["name"];
			$text=$data["text"];
			$link=$data["link"];
			$stmt->execute();
			$stmt->close();
			$id=$this->conn->insert_id;
			return $id;
		}

		public function update($current,$new)
		{
			$sql="UPDATE connections SET name=?, text=?, link=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("sssi",$name,$text,$link,$id);
			$name=$new["name"]??$current["name"];
			$text=$new["text"]??$current["text"];
			$link=$new["link"]??$current["link"];
			$id=$current["id"];
			$stmt->execute();
			$stmt->store_result();
			$numrows=$stmt->num_rows;
			$stmt->close();
			return $numrows;
		}

		public function delete($id)
		{
			$sql="DELETE FROM connections WHERE id=?";
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