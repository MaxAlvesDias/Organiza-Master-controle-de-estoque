<?php
class clientsController extends controller 
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

		if($u->hasPermission('clients.view')){
			$c = new Clients();
			$offset = 0;
			$page = 1; 

			$url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
			if($url != ''){
				$url = explode("=", $url);
				$page = intval(array_pop($url));
				if($page == 0){
					$page = 1;
				}
			}
			
			$offset = (10 * ($page-1));
			$data['clients_list'] = $c->getList($offset, $u->getCompany());
			$data['clients_count'] = $c->getCount($u->getCompany());
			$data['page_count'] = ceil(($data['clients_count'] / 10));
			$data['edit_permission'] = $u->hasPermission('clients.edit');
			$this->loadTemplate('clients', $data);
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

		if($u->hasPermission('clients.edit')){
			$c = new Clients();
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$phone = addslashes($_POST['phone']);
				$email = addslashes($_POST['email']);
				$stars = addslashes($_POST['stars']); 
				$internal_obs = addslashes($_POST['internal_obs']); 
				$address_zipCode = addslashes($_POST['address_zipCode']); 
				$address = addslashes($_POST['address']); 
				$address_number = addslashes($_POST['address_number']); 
				$address2 = addslashes($_POST['address2']); 
				$address_neighborhood = addslashes($_POST['address_neighborhood']); 
				$address_city = addslashes($_POST['address_city']);
				$address_state = addslashes($_POST['address_state']);
				$address_country = addslashes($_POST['address_country']);
				$c->add($u->getCompany(), $name, $phone, $email, $stars, $internal_obs, $address_zipCode, $address, $address_number,$address2, $address_neighborhood, $address_city, $address_state, $address_country);
				header("Location: ".BASE_URL."/clients");
			}

			$this->loadTemplate('clients_add', $data);
		} else {
			header("Location: ".BASE_URL."/clients");
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

		if($u->hasPermission('clients.view')){
			$client = new Clients();
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$phone = addslashes($_POST['phone']);
				$email = addslashes($_POST['email']);
				$stars = addslashes($_POST['stars']); 
				$internal_obs = addslashes($_POST['internal_obs']); 
				$address_zipCode = addslashes($_POST['address_zipCode']); 
				$address = addslashes($_POST['address']); 
				$address_number = addslashes($_POST['address_number']); 
				$address2 = addslashes($_POST['address2']); 
				$address_neighborhood = addslashes($_POST['address_neighborhood']); 
				$address_city = addslashes($_POST['address_city']);
				$address_state = addslashes($_POST['address_state']);
				$address_country = addslashes($_POST['address_country']);

				$client->edit($id, $u->getCompany(), $name, $phone, $email, $stars, $internal_obs, $address_zipCode, $address, $address_number,$address2, $address_neighborhood, $address_city, $address_state, $address_country);
				header("Location: ".BASE_URL."/clients");
			}
			
			$data['client_info'] = $client->getInfo($id, $u->getCompany());
			$this->loadTemplate('clients_edit', $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function delete($id)
	{
		$u = new Users();
		$c = new Clients();
		$u->setLoggedUser();

		if($u->hasPermission('clients.view')){
			$c->delete($id, $u->getCompany());
			header("Location: ".BASE_URL."/clients");
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}
}