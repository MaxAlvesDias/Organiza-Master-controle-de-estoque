<?php
class Sales extends model 
{
	public function getList($offset, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT sales.id, sales.date_sale, sales.total_price, sales.status, clients.name FROM sales LEFT JOIN clients ON clients.id = sales.id_client WHERE sales.id_company = :ID_COMPANY ORDER BY sales.date_sale DESC LIMIT $offset, 10");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function addSale($id_company, $id_client, $id_user, $quant, $status)
	{
		$i = new Inventory();
		$stmt = $this->conn->prepare("INSERT INTO sales(id_client, id_user, date_sale, total_price, id_company, status) VALUES(:ID_CLIENT, :ID_USER, NOW(), :TOTAL_PRICE, :ID_COMPANY, :STATUS)");
		$stmt->bindParam(":ID_CLIENT", $id_client);
		$stmt->bindParam(":ID_USER", $id_user);
		$stmt->bindValue(":TOTAL_PRICE", '0');
		$stmt->bindParam(":STATUS", $status);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();

		$id_sale = $this->conn->lastInsertId();

		$total_price = 0;
		foreach($quant as $id_prod => $quant_prod){
			$stmt = $this->conn->prepare("SELECT price FROM inventory WHERE id = :ID AND id_company = :ID_COMPANY");
			$stmt->bindParam(":ID", $id_prod);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$row = $stmt->fetch();
				$price = $row['price'];
				$stmt = $this->conn->prepare("INSERT INTO sales_products(id_company, id_sale, id_product, quantity, sale_price) VALUES(:ID_COMPANY, :ID_SALE, :ID_PRODUCT, :QUANTITY, :SALE_PRICE)");
				$stmt->bindParam(":ID_COMPANY", $id_company);
				$stmt->bindParam(":ID_SALE", $id_sale);
				$stmt->bindParam(":ID_PRODUCT", $id_prod);
				$stmt->bindParam(":QUANTITY", $quant_prod);
				$stmt->bindParam(":SALE_PRICE", $price);
				$stmt->execute();

				$total_price += $price * $quant_prod;
				$i->decrease($id_prod, $quant_prod, $id_company, $id_user);
			}
		}

		$stmt = $this->conn->prepare("UPDATE sales SET total_price = :TOTAL_PRICE WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":TOTAL_PRICE", $total_price);
		$stmt->bindParam(":ID", $id_sale);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}

	public function getInfo($id, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT *, (select clients.name from clients where clients.id = sales.id_client) as client_name FROM sales WHERE id = :ID AND id_company = :ID_COMPANY");
			$stmt->bindParam(":ID", $id);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$array['info'] = $stmt->fetch();
			}
			$stmt = $this->conn->prepare("SELECT sales_products.quantity, sales_products.sale_price, inventory.name FROM sales_products LEFT JOIN inventory ON inventory.id = sales_products.id_product WHERE sales_products.id_sale = :ID_SALE AND sales_products.id_company = :ID_COMPANY");
			$stmt->bindParam(":ID_SALE", $id);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$array['products'] = $stmt->fetchAll();
			}
			return $array;
	}

	public function changeStatus($status, $id, $id_company)
	{
		$stmt = $this->conn->prepare("UPDATE sales SET status = :STATUS WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":STATUS", $status);
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}

	public function getSalesFiltered($client_name, $period1, $period2, $status, $order, $id_company)
	{
		$array = [];
		$query = "SELECT clients.name, sales.date_sale, sales.status, sales.total_price FROM sales LEFT JOIN clients ON clients.id = sales.id_client WHERE ";

		$where[] = "sales.id_company = :ID_COMPANY";

		if(!empty($client_name)){
			$where[] = "clients.name LIKE '%".$client_name."%'";
		} 

		if(!empty($period1) && !empty($period2)){
			$where[] = "sales.date_sale BETWEEN :PERIOD1 AND :PERIOD2";
		}
		
		if($status != ''){
			$where[] = "sales.status = :STATUS";
		} 

		$query .= implode(" AND ", $where);

		switch($order){
			case 'date_desc':
			default:
				$query .= " ORDER BY sales.date_sale DESC";
				break;

			case 'date_asc':
				$query .= " ORDER BY sales.date_sale ASC";
				break;

			case 'status':
				$query .= " ORDER BY sales.status ASC";
				break;
		}
		
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(":ID_COMPANY", $id_company);

		if(!empty($period1) && !empty($period2)){
			$stmt->bindParam(":PERIOD1", $period1);
			$stmt->bindParam(":PERIOD2", $period2);
		}
		
		if($status != ''){
			$stmt->bindParam(":STATUS", $status);
		}

		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}

		return $array;
	}

	public function getTotalRevenue($period1, $period2, $id_company)
	{
		$float = 0;
		$stmt = $this->conn->prepare("SELECT SUM(total_price) as total FROM sales WHERE date_sale BETWEEN :PERIOD1 AND NOW() AND id_company = :ID_COMPANY");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();

			$n = $stmt->fetch();
			$float = $n['total'];
			
			return $float;
	}

	public function getTotalExpenses($period1, $period2, $id_company)
	{
		$float = 0;
		$stmt = $this->conn->prepare("SELECT SUM(total_price) as total FROM purchases WHERE date_purchase BETWEEN :PERIOD1 AND NOW() AND id_company = :ID_COMPANY");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();

			$n = $stmt->fetch();
			$float = $n['total'];
			
			return $float;
	}

	public function getSoldProducts($period1, $period2, $id_company)
	{
		$int = 0;
		$stmt = $this->conn->prepare("SELECT id FROM sales WHERE id_company = :ID_COMPANY AND date_sale BETWEEN :PERIOD1 AND NOW()");
		$stmt->bindParam(":PERIOD1", $period1);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	
		if ($stmt->rowCount() > 0) {
			$p = [];
			foreach ($stmt->fetchAll() as $sale_item) {
				$p[] = $sale_item['id'];
			}
			$stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (" . implode(",", $p) . ")");
			$stmt->execute();
			$n = $stmt->fetch();
			$int = $n['total'];
		}
		return $int;
	}
	

	public function getRevenueList($period1, $period2, $id_company)
	{
		$array = [];
		$currentDay = $period1;
		while($period2 != $currentDay){
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}
		
		$stmt = $this->conn->prepare("SELECT date_sale, SUM(total_price) as total FROM sales WHERE date_sale BETWEEN :PERIOD1 AND NOW() AND id_company = :ID_COMPANY GROUP BY date_sale");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$row = $stmt->fetchAll();
				foreach($row as $sale_item){
					$s = $sale_item['date_sale'];
					$date_key = date("Y-m-d", strtotime($s));
					$array[$date_key] = $sale_item['total'];
				}
			}
				
			return $array;
	}

	public function getExpensesList($period1, $period2, $id_company)
	{
		$array = [];
		$currentDay = $period1;
		while($period2 != $currentDay){
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
		}
		
		$stmt = $this->conn->prepare("SELECT date_purchase, SUM(total_price) as total FROM purchases WHERE date_purchase BETWEEN :PERIOD1 AND NOW() AND id_company = :ID_COMPANY GROUP BY date_purchase");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$row = $stmt->fetchAll();
				foreach($row as $sale_item){
					$s = $sale_item['date_purchase'];
					$date_key = date("Y-m-d", strtotime($s));
					$array[$date_key] = $sale_item['total'];
				}
			}
				
			return $array;
	}

	public function getStatusList($period1, $period2, $id_company)
	{
		$array = ['0' => 0, '1' => 0, '2' => 0];
		$stmt = $this->conn->prepare("SELECT COUNT(id) as total, status FROM sales WHERE date_sale BETWEEN :PERIOD1 AND NOW() AND id_company = :ID_COMPANY GROUP BY status ORDER BY status ASC");
			$stmt->bindParam(":PERIOD1", $period1);
			//$stmt->bindParam(":PERIOD2", $period2);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				$row = $stmt->fetchAll();
				foreach($row as $sale_item){
					$a = $sale_item['status'];
					$array[$a] = $sale_item['total'];
				}
			}
				
			return $array;
	}
}
