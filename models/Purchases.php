<?php
class Purchases extends model 
{
	public function getList($offset, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT purchases.id, purchases.date_purchase, purchases.total_price, resellers.name FROM purchases LEFT JOIN resellers ON resellers.id = purchases.id_reseller WHERE purchases.id_company = :ID_COMPANY ORDER BY purchases.date_purchase DESC LIMIT $offset, 10");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function addPurchase($id_company, $purchase_id, $id_user, $quant, $price)
	{
		$i = new Inventory();
		$stmt = $this->conn->prepare("INSERT INTO purchases(id_reseller, id_user, date_purchase, total_price, id_company) VALUES(:ID_RESELLER, :ID_USER, NOW(), :TOTAL_PRICE, :ID_COMPANY)");
		$stmt->bindParam(":ID_RESELLER", $purchase_id);
		$stmt->bindParam(":ID_USER", $id_user);
		$stmt->bindValue(":TOTAL_PRICE", '0');
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();

		$id_purchase = $this->conn->lastInsertId();

		$total_price = 0;
		foreach($quant as $id_prod => $quant_prod){
			$stmt = $this->conn->prepare("SELECT price FROM inventory WHERE id = :ID AND id_company = :ID_COMPANY");
			$stmt->bindParam(":ID", $id_prod);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$row = $stmt->fetch();
				$price = $row['price'];
				$stmt = $this->conn->prepare("INSERT INTO purchases_products(id_company, id_purchase, id_product, quantity, purchase_price) VALUES(:ID_COMPANY, :ID_PURCHASE, :ID_PRODUCT, :QUANTITY, :PURCHASE_PRICE)");
				$stmt->bindParam(":ID_COMPANY", $id_company);
				$stmt->bindParam(":ID_PURCHASE", $id_purchase);
				$stmt->bindParam(":ID_PRODUCT", $id_prod);
				$stmt->bindParam(":QUANTITY", $quant_prod);
				$stmt->bindParam(":PURCHASE_PRICE", $price);
				$stmt->execute();

				$total_price += $price * $quant_prod;
				$i->increase($id_prod, $quant_prod, $id_company, $id_user);
			}
		}

		$stmt = $this->conn->prepare("UPDATE purchases SET total_price = :TOTAL_PRICE WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":TOTAL_PRICE", $total_price);
		$stmt->bindParam(":ID", $id_purchase);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}

	public function getInfo($id, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT *, (select resellers.name from resellers where resellers.id = purchases.id_reseller) as reseller_name FROM purchases WHERE id = :ID AND id_company = :ID_COMPANY");
			$stmt->bindParam(":ID", $id);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$array['info'] = $stmt->fetch();
			}
			$stmt = $this->conn->prepare("SELECT purchases_products.quantity, purchases_products.purchase_price, inventory.name FROM purchases_products LEFT JOIN inventory ON inventory.id = purchases_products.id_product WHERE purchases_products.id_purchase = :ID_PURCHASE AND purchases_products.id_company = :ID_COMPANY");
			$stmt->bindParam(":ID_PURCHASE", $id);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$array['products'] = $stmt->fetchAll();
			}
			return $array;
	}

	public function getPurchasesFiltered($reseller_name, $period1, $period2, $order, $id_company)
	{
		$array = [];
		$query = "SELECT resellers.name, purchases.date_purchase, purchases.total_price FROM purchases LEFT JOIN resellers ON resellers.id = purchases.id_reseller WHERE ";

		$where[] = "purchases.id_company = :ID_COMPANY";

		if(!empty($client_name)){
			$where[] = "resellers.name LIKE '%".$reseller_name."%'";
		} 

		if(!empty($period1) && !empty($period2)){
			$where[] = "purchases.date_purchase BETWEEN :PERIOD1 AND :PERIOD2";
		}
		
		$query .= implode(" AND ", $where);

		switch($order){
			case 'date_desc':
			default:
				$query .= " ORDER BY purchases.date_purchase DESC";
				break;

			case 'date_asc':
				$query .= " ORDER BY purchases.date_purchase ASC";
				break;

		}
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":ID_COMPANY", $id_company);

		if(!empty($period1) && !empty($period2)){
			$stmt->bindParam(":PERIOD1", $period1);
			$stmt->bindParam(":PERIOD2", $period2);
		}

		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}

		return $array;
	}

	public function getPurchasedProducts($period1, $period2, $id_company)
	{
		$int = 0;
		$stmt = $this->conn->prepare("SELECT id FROM purchases WHERE id_company = $id_company AND date_purchase BETWEEN $period1 AND NOW()");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();

			if($stmt->rowCount() > 0) {
				$p = [];
				foreach($stmt->fetchAll() as $sale_item){
					$p[] = $sale_item['id'];
				} 
				$stmt = $this->conn->query("SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (".implode(",", $p).")");
				$n = $stmt->fetch();
				$int = $n['total'];
			}
			return $int;
	}
}
