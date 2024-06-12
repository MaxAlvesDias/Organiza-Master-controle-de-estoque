<?php
class reportController extends controller 
{
	public function __construct()
	{
		$u = new Users();
		if($u->isLogged() == false){
			header("Location: ".BASE_URL."/login");
			exit;
		}
	}

	public function index() 
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('report.view')){
			$this->loadTemplate('report', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}

	public function sales()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['statuses'] = ['0' => 'Aguarndando pagamento', '1' => 'Pago', '2' => 'Cancelado'];

		if($u->hasPermission('report.view')){
			$this->loadTemplate('report_sales', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}

	public function purchases()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('report.view')){
			$this->loadTemplate('report_purchases', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}

	public function salesPdf()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$data['statuses'] = ['0' => 'Aguarndando pagamento', '1' => 'Pago', '2' => 'Cancelado'];

		if($u->hasPermission('report.view')){
			$url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
			$url = explode("?", $url);
			$url = array_pop($url);
			$url = explode("&", $url);

			$a = explode("=", $url[0]);
			$client_name = array_pop($a);

			$a = explode("=", $url[1]);
			$period1 = array_pop($a); 

			$a = explode("=", $url[2]);
			$period2 = array_pop($a); 

			$a = explode("=", $url[3]);
			$status = array_pop($a); 

			$a = explode("=", $url[4]);
			$order = array_pop($a); 

			$s = new Sales();
			$data['sales_list'] = $s->getSalesFiltered($client_name, $period1, $period2, $status, $order, $u->getCompany());
			$f = [];
			if(!empty($client_name)){
				$f['client_name'] = $client_name;
			}
			if(!empty($period1) && !empty($period2)){
				$f['period1'] = $period1;
				$f['period2'] = $period2;
			}
			if(!empty($status)){
				$f['status'] = $status;
			}
			if(!empty($order)){
				$f['order'] = $order;
			}

			$data['filters'] = $f;  
			$this->loadView("report_sales_pdf", $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}

	public function purchasesPdf()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();

		if($u->hasPermission('report.view')){
			$url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
			$url = explode("?", $url);
			$url = array_pop($url);
			$url = explode("&", $url);

			$a = explode("=", $url[0]);
			$reseller_name = array_pop($a);

			$a = explode("=", $url[1]);
			$period1 = array_pop($a); 

			$a = explode("=", $url[2]);
			$period2 = array_pop($a); 

			$a = explode("=", $url[3]);
			$order = array_pop($a); 

			$p = new Purchases();
			$data['purchases_list'] = $p->getPurchasesFiltered($reseller_name, $period1, $period2, $order, $u->getCompany());

			$f = [];
			if(!empty($reseller_name)){
				$f['reseller_name'] = $reseller_name;
			}
			if(!empty($period1) && !empty($period2)){
				$f['period1'] = $period1;
				$f['period2'] = $period2;
			}
			if(!empty($order)){
				$f['order'] = $order;
			}

			$data['filters'] = $f;  
			$this->loadView("report_purchases_pdf", $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}

	public function inventory()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('report.view')){
			$this->loadTemplate('report_inventory', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function inventoryPdf()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();

		if($u->hasPermission('report.view')){
			$i = new Inventory();
			$data['inventory_list'] = $i->getInventoryFiltered($u->getCompany());
			$this->loadView("report_inventory_pdf", $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		} 
	}
}