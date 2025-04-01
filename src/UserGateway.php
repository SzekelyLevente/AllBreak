<?php
	class UserGateway{
		private $conn;

		public function __construct($database)
		{
			$this->conn=$database->conn;
		}

		public function getAll()
		{
			$sql="SELECT * FROM users";
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
			$sql="SELECT * FROM users WHERE id=?";
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
			$sql="SELECT * FROM users WHERE ";
			$paramtypes="";
			$bparams=[];
			$name=$params["name"]??null;
			$permission=$params["permission"]??null;
			$password=$params["password"]??null;
			if($name!=null)
			{
				$sql.="name=? and ";
				$paramtypes.="s";
				$bparams[]=$name;
			}
			if($permission!=null)
			{
				$sql.="permission=? and ";
				$paramtypes.="i";
				$bparams[]=$permission;
			}
			if($password!=null)
			{
				$sql.="password=? and ";
				$paramtypes.="s";
				$bparams[]=$password;
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
			$sql="INSERT INTO users(name,password,permission) VALUES(?,?,?)";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("ssi",$name,$password,$permission);
			$name=$data["name"];
			$password=password_hash($data["password"], PASSWORD_DEFAULT);
			$permission=$data["permission"];
			$stmt->execute();
			$stmt->close();
			$id=$this->conn->insert_id;
			return $id;
		}

		public function update($current,$new)
		{
			$sql="UPDATE users SET name=?, password=?, permission=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("sssi",$name,$password,$permission,$id);
			$name=$new["name"]??$current["name"];
			if(isset($new["password"]))
			{
				$password=password_hash($new["password"], PASSWORD_DEFAULT);
			}
			else
			{
				$password=$current["password"];
			}
			$permission=$new["permission"]??$current["permission"];
			$id=$current["id"];
			$stmt->execute();
			$stmt->store_result();
			$numrows=$stmt->num_rows;
			$stmt->close();
			return $numrows;
		}

		public function delete($id)
		{
			$sql="DELETE FROM users WHERE id=?";
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