<?php
class resellersController extends controller 
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

		if($u->hasPermission('resellers.view')){
			$r = new Resellers();
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
			$data['resellers_list'] = $r->getList($offset, $u->getCompany());
			$data['resellers_count'] = $r->getCount($u->getCompany());
			$data['page_count'] = ceil(($data['resellers_count'] / 10));
			$data['edit_permission'] = $u->hasPermission('resellers.edit');
			$this->loadTemplate('resellers', $data);
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
			$r = new Resellers();
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$phone = addslashes($_POST['phone']);
				$email = addslashes($_POST['email']);
				
				$r->add($u->getCompany(), $name, $phone, $email);
				header("Location: ".BASE_URL."/resellers");
			}

			$this->loadTemplate('resellers_add', $data);
		} else {
			header("Location: ".BASE_URL."/resellers");
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
			$r = new Resellers();
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$phone = addslashes($_POST['phone']);
				$email = addslashes($_POST['email']);

				$r->edit($id, $u->getCompany(), $name, $phone, $email);
				header("Location: ".BASE_URL."/resellers");
			}
			
			$data['reseller_info'] = $r->getInfo($id, $u->getCompany());
			$this->loadTemplate('resellers_edit', $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function delete($id)
	{
		$u = new Users();
		$r = new Resellers();
		$u->setLoggedUser();

		if($u->hasPermission('resellers.view')){
			$r->delete($id, $u->getCompany());
			header("Location: ".BASE_URL."/resellers");
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}
}