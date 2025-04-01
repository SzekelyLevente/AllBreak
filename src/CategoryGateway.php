<?php
	class CategoryGateway
	{
		private $conn;

		public function __construct($database)
		{
			$this->conn=$database->conn;
		}

		public function getAll()
		{
			$sql="SELECT * FROM categories";
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
			$sql="SELECT * FROM categories WHERE id=?";
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
			$sql="SELECT * FROM categories WHERE ";
			$paramtypes="";
			$bparams=[];
			$name=$params["name"]??null;
			if($name!=null)
			{
				$sql.="name=? and ";
				$paramtypes.="s";
				$bparams[]=$name;
			}
			$sql=substr($sql,0,-4);
			$stmt=$this->conn->prepare($sql);
			switch(sizeof($bparams))
			{
				case 1:
					$stmt->bind_param($paramtypes,$p1);
					$p1=$bparams[0];
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
			$sql="INSERT INTO categories(name) VALUES(?)";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("s",$name);
			$name=$data["name"];
			$stmt->execute();
			$stmt->close();
			$id=$this->conn->insert_id;
			return $id;
		}

		public function update($current,$new)
		{
			$sql="UPDATE categories SET name=? WHERE id=?";
			$stmt=$this->conn->prepare($sql);
			$stmt->bind_param("si",$name,$id);
			$name=$new["name"]??$current["name"];
			$id=$current["id"];
			$stmt->execute();
			$stmt->store_result();
			$numrows=$stmt->num_rows;
			$stmt->close();
			return $numrows;
		}

		public function delete($id)
		{
			$sql="DELETE FROM categories WHERE id=?";
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