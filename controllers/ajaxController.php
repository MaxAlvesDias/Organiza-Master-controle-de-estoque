<?php
class ajaxController extends controller 
{
	public function __construct()
	{
		$u = new Users();
		if($u->isLogged() == false){
			header("Location: ".BASE_URL."/login");
			exit;
		}
	}

	public function index(){}

	public function searchClients()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$client = new Clients();

		if(isset($_POST['q']) && !empty($_POST['q'])){
			$q = addslashes($_POST['q']);
			$clients = $client->searchClientByName($q, $u->getCompany());
			foreach($clients as $client){
				$data[] = [
					"name" => $client['name'], 
					"link" => BASE_URL."/clients/edit/".$client['id'],
					"id" => $client['id']
				];		
			}
		}

		echo json_encode($data);
	}

	public function searchResellers()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$r = new Resellers();

		if(isset($_POST['q']) && !empty($_POST['q'])){
			$q = addslashes($_POST['q']);
			$resellers = $r->searchResellerByName($q, $u->getCompany());
			foreach($resellers as $r){
				$data[] = [
					"name" => $r['name'], 
					"link" => BASE_URL."/resellers/edit/".$r['id'],
					"id" => $r['id']
				];		
			}
		}

		echo json_encode($data);
	}

	public function addClient()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$c = new Clients();

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$name = addslashes($_POST['name']);
			$data['id'] = $c->add($u->getCompany(), $name);
			echo $data['id']; exit;
		}

		echo json_encode($data);
	}

	public function addReseller()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$r = new Resellers();

		if(isset($_POST['name']) && !empty($_POST['name'])){
			$name = addslashes($_POST['name']);
			$data['id'] = $r->add($u->getCompany(), $name);
			echo $data['id']; exit;
		}

		echo json_encode($data);
	}

	public function searchProducts()
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		$i = new Inventory();

		if(isset($_POST['q']) && !empty($_POST['q'])){
			$q = addslashes($_POST['q']);
			$products = $i->searchProductsByName($q, $u->getCompany());
			$data = $products;
		}

		echo json_encode($data);
	}
}