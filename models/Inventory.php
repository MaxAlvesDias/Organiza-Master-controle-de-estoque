<?php
class Inventory extends model 
{
	public function getList($id_company, $offset)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM inventory WHERE id_company = :ID_COMPANY LIMIT $offset, 10");
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
		$stmt = $this->conn->prepare("SELECT * FROM inventory WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}

	public function setLog($id_product, $id_company, $id_user, $action)
	{
		// inventory history
		$stmt = $this->conn->prepare("INSERT INTO inventory_history(id_company, id_product, id_user, action, date_action) VALUES(:ID_COMPANY, :ID_PRODUCT, :ID_USER, :ACTION, NOW())");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID_PRODUCT", $id_product);
		$stmt->bindParam(":ID_USER", $id_user);
		$stmt->bindParam(":ACTION", $action);
		$stmt->execute();
	}

	public function add($name, $price, $quantity, $min_quantity, $id_company, $id_user)
	{
		$stmt = $this->conn->prepare("INSERT INTO inventory(name, price, quantity, min_quantity, id_company) VALUES(:NAME, :PRICE, :QUANTITY, :MIN_QUANTITY, :ID_COMPANY)");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":PRICE", $price);
		$stmt->bindParam(":QUANTITY", $quantity);
		$stmt->bindParam(":MIN_QUANTITY", $min_quantity);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();

		$id_product = $this->conn->lastInsertId();

		// inventory history
		$this->setLog($id_product, $id_company, $id_user, 'add');
		
		
	}

	public function edit($id, $name, $price, $quantity, $min_quantity, $id_company, $id_user)
	{
		$stmt = $this->conn->prepare("UPDATE inventory SET name = :NAME, price = :PRICE, quantity = :QUANTITY, min_quantity = :MIN_QUANTITY WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":PRICE", $price);
		$stmt->bindParam(":QUANTITY", $quantity);
		$stmt->bindParam(":MIN_QUANTITY", $min_quantity);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		
		// inventory history
		$this->setLog($id, $id_company, $id_user, 'edit');
	}

	public function delete($id, $id_company, $id_user)
	{
		$stmt=$this->conn->prepare("DELETE FROM inventory WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		
		// inventory history
		$this->setLog($id, $id_company, $id_user, 'delete');
	}

	public function searchProductsByName($name, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT id, name, price FROM inventory WHERE name LIKE :NAME AND id_company = :ID_COMPANY LIMIT 10");
		$stmt->bindValue(":NAME", '%'.$name.'%');
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}

	public function decrease($id_prod, $quant_prod, $id_company, $id_user)
	{
		$stmt = $this->conn->prepare("UPDATE inventory SET quantity = quantity - $quant_prod WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID", $id_prod);
		$stmt->execute();

		// inventory history
		$this->setLog($id_prod, $id_company, $id_user, 'decrease');
	}

	public function increase($id_prod, $quant_prod, $id_company, $id_user) 
	{
		$stmt = $this->conn->prepare("UPDATE inventory SET quantity = quantity + $quant_prod WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":ID", $id_prod);
		$stmt->execute();

		// inventory history
		$this->setLog($id_prod, $id_company, $id_user, 'increase');
	}

	public function getInventoryFiltered($id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT *, (min_quantity-quantity) as dif FROM inventory WHERE quantity < min_quantity AND id_company = :ID_COMPANY ORDER BY name ASC");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}
}
