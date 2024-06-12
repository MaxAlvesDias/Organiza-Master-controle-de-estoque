<?php
class purchasesController extends controller 
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

		if($u->hasPermission('purchases.view')){
			$p = new Purchases();
			$offset = 0;
			$data['purchases_list'] = $p->getList($offset, $u->getCompany());
			$this->loadTemplate('purchases', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function add()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('purchases.view')){  
			$p = new Purchases();
			if(isset($_POST['reseller_id']) && !empty($_POST['reseller_id'])){ 
				$reseller_id = addslashes($_POST['reseller_id']);
				$name = addslashes($_POST['name']);
				$price = addslashes($_POST['price']);
				$quant = $_POST['quant'];

				$p->addPurchase($u->getCompany(), $reseller_id, $u->getId(), $quant, $price);
				header("Location: ".BASE_URL."/purchases");
			} else {
			 
			}
			$this->loadTemplate('purchases_add', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function edit($id)
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('purchases.view')){
			$p = new Purchases();
			$data['permission_edit'] = $u->hasPermission('purchases.edit');
			if(isset($_POST['price']) && $data['permission_edit']){
				header("Location: ".BASE_URL."/purchases");
			}
			$data['purchases_info'] = $p->getInfo($id, $u->getCompany());
			$this->loadTemplate('purchases_edit', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}
}