<?php
class Clients extends model 
{
	public function getList($offset, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM clients WHERE id_company = :ID_COMPANY LIMIT $offset, 10");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function add($id_company, $name, $phone='-', $email='-', $stars = '3', $internal_obs='-', $address_zipCode='-', $address='-', $address_number='-', $address2='-', $address_neighborhood='-', $address_city='-', $address_state='-', $address_country='-')
	{
		$stmt = $this->conn->prepare("INSERT INTO clients(name, email, phone, address, address_neighborhood, address_city, address_state, address_country, address_zipCode, address_number, address2, stars, internal_obs, id_company) VALUES(:NAME, :EMAIL, :PHONE, :ADDRESS, :ADDRESS_NEIGHBORHOOD, :ADDRESS_CITY, :ADDRESS_STATE, :ADDRESS_COUNTRY, :ADDRESS_ZIPCODE, :ADDRESS_NUMBER, :ADDRESS2, :STARS, :INTENAL_OBS, :ID_COMPANY)");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PHONE", $phone);
		$stmt->bindParam(":ADDRESS", $address);
		$stmt->bindParam(":ADDRESS_NEIGHBORHOOD", $address_neighborhood);
		$stmt->bindParam(":ADDRESS_CITY", $address_city);
		$stmt->bindParam(":ADDRESS_STATE", $address_state);
		$stmt->bindParam(":ADDRESS_COUNTRY", $address_country);
		$stmt->bindParam(":ADDRESS_ZIPCODE", $address_zipCode);
		$stmt->bindParam(":ADDRESS_NUMBER", $address_number);
		$stmt->bindParam(":ADDRESS2", $address2);
		$stmt->bindParam(":STARS", $stars);
		$stmt->bindParam(":INTENAL_OBS", $internal_obs);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		return $this->conn->lastInsertId();
	}

	public function edit($id, $id_company, $name, $phone, $email, $stars, $internal_obs, $address_zipCode, $address, $address_number,$address2, $address_neighborhood, $address_city, $address_state, $address_country)
	{
		$stmt = $this->conn->prepare("UPDATE clients SET name = :NAME, id_company = :ID_COMPANY, phone = :PHONE, email = :EMAIL, stars = :STARS, internal_obs = :INTENAL_OBS, address_zipcode = :ADDRESS_ZIPCODE, address = :ADDRESS, address_number = :ADDRESS_NUMBER, address2 = :ADDRESS2, address_neighborhood = :ADDRESS_NEIGHBORHOOD, address_city = :ADDRESS_CITY, address_state = :ADDRESS_STATE, address_country = :ADDRESS_COUNTRY WHERE id = :ID AND id_company = :ID_COMPANY2");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PHONE", $phone);
		$stmt->bindParam(":ADDRESS", $address);
		$stmt->bindParam(":ADDRESS_NEIGHBORHOOD", $address_neighborhood);
		$stmt->bindParam(":ADDRESS_CITY", $address_city);
		$stmt->bindParam(":ADDRESS_STATE", $address_state);
		$stmt->bindParam(":ADDRESS_COUNTRY", $address_country);
		$stmt->bindParam(":ADDRESS_ZIPCODE", $address_zipCode);
		$stmt->bindParam(":ADDRESS_NUMBER", $address_number);
		$stmt->bindParam(":ADDRESS2", $address2);
		$stmt->bindParam(":STARS", $stars);
		$stmt->bindParam(":INTENAL_OBS", $internal_obs);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID_COMPANY2", $id_company);
		$stmt->execute();
	}

	public function getInfo($id, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM clients WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam("ID", $id);
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}

	public function getCount($id_company)
	{
		$clients = 0;
		$stmt=$this->conn->prepare("SELECT COUNT(*) as c FROM clients WHERE id_company = :ID_COMPANY");
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		$stmt = $stmt->fetch();
		$clients = $stmt['c'];
		return $clients;
	}

	public function searchClientByName($name, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT name, id FROM clients WHERE name LIKE :NAME AND id_company = :ID_COMPANY LIMIT 10");
		$stmt->bindValue(":NAME", '%'.$name.'%');
		$stmt->bindParam("ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function delete($id, $id_company)
	{
		$stmt=$this->conn->prepare("DELETE FROM clients WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}
}