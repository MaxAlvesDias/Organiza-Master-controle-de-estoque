
<?php
class usersController extends controller 
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

		if($u->hasPermission('users.view')){
			$data['users_list'] = $u->getList($u->getCompany());
			$this->loadTemplate('users', $data);
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

		if($u->hasPermission('users.view')){
			$p = new Permissions();
			if(isset($_POST['email']) && !empty($_POST['email'])){
				$name = addslashes($_POST['name']);
				$email = addslashes($_POST['email']);
				$password = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);
				$add_user = $u->add($name, $email, $password, $group, $u->getCompany()); 
				if($add_user == '1'){
					header("Location: ".BASE_URL."/users");
				} else {
					$data['error_msg'] = "Usuário já cadastrado.";
				}	
			}
			$data['group_list'] = $p->getGroupList($u->getCompany());
			$this->loadTemplate('users_add', $data);
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

		if($u->hasPermission('users.view')){
			$p = new Permissions();
			if(isset($_POST['group']) && !empty($_POST['group'])){
				$name = addslashes($_POST['name']);
				$password = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);
				$u->edit($name, $password, $group, $id, $u->getCompany());
				header("Location: ".BASE_URL."/users"); 
			}

			$data['user_info'] = $u->getInfo($id, $u->getCompany());
			$data['group_list'] = $p->getGroupList($u->getCompany());
			$this->loadTemplate('users_edit', $data);

		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function delete($id)
	{
		$u = new Users();
		$u->setLoggedUser();

		if($u->hasPermission('users.view')){
			$u->delete($id, $u->getCompany());
			header("Location: ".BASE_URL."/users");
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}
}