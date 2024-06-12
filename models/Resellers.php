<?php
class Resellers extends model 
{
	public function getList($offset, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM resellers WHERE id_company = :ID_COMPANY LIMIT $offset, 10");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function getInfo($id, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM resellers WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam("ID", $id);
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}

	public function add($id_company, $name, $phone='-', $email='-')
	{
		$stmt = $this->conn->prepare("INSERT INTO resellers(name, email, phone, id_company) VALUES(:NAME, :EMAIL, :PHONE, :ID_COMPANY)");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PHONE", $phone);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		return $this->conn->lastInsertId();
	}

	public function edit($id, $id_company, $name, $phone, $email)
	{
		$stmt = $this->conn->prepare("UPDATE resellers SET name = :NAME, id_company = :ID_COMPANY, phone = :PHONE, email = :EMAIL WHERE id = :ID AND id_company = :ID_COMPANY2");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PHONE", $phone);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID_COMPANY2", $id_company);
		$stmt->execute();
	}

	public function searchResellerByName($name, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT name, id FROM resellers WHERE name LIKE :NAME AND id_company = :ID_COMPANY LIMIT 10");
		$stmt->bindValue(":NAME", '%'.$name.'%');
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function getCount($id_company)
	{
		$resellers = 0;
		$stmt=$this->conn->prepare("SELECT COUNT(*) as c FROM resellers WHERE id_company = :ID_COMPANY");
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		$stmt = $stmt->fetch();
		$clients = $stmt['c'];
		return $resellers;
	}

	public function delete($id, $id_company)
	{
		$stmt=$this->conn->prepare("DELETE FROM resellers WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}
}