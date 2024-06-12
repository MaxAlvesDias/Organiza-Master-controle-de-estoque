<?php
class permissionsController extends controller 
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
		$data['permission_link'] = true;

		if($u->hasPermission('permission.link')){
			$p = new Permissions();
			$data['permissions_list'] = $p->getList($u->getCompany());
			$data['permissions_group_list'] = $p->getGroupList($u->getCompany());
			$this->loadTemplate('permissions', $data);
		} else {
			header("Location: ".BASE_URL);
		}
	}

	public function add()
	{
		$u = new Users();
		$u->setLoggedUser();
		if(!$u->hasPermission('permission.link')){
			header("Location: ".BASE_URL);
			exit;
		}

		$data = [];
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['permission_link'] = true;

		$p = new Permissions();
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$permission_name = addslashes($_POST['name']);
			$p->add($permission_name, $u->getCompany());
			header("Location: ".BASE_URL."/permissions");
			exit;
		}
			
		$this->loadTemplate('permissions_add', $data);
		
	}

	public function add_group()
	{
		$u = new Users();
		$u->setLoggedUser();
		if(!$u->hasPermission('permission.link')){
			header("Location: ".BASE_URL);
			exit;
		}

		$data = []; 
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['permission_link'] = true;

		$p = new Permissions();
		$data['permissions_group_list'] = $p->getList($u->getCompany());

		
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$p_name = addslashes($_POST['name']);
			$p_list = $_POST['permissions'];
			$p->addGroup($p_name, $p_list, $u->getCompany());
			header("Location: ".BASE_URL."/permissions");
		}

		$this->loadTemplate('permissions_add_group', $data);
	}

	public function edit_group($id)
	{
		$u = new Users();
		$u->setLoggedUser();
		if(!$u->hasPermission('permission.link')){
			header("Location: ".BASE_URL);
			exit;
		}

		$data = []; 
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['permission_link'] = true;

		$p = new Permissions();
		$data['permissions_group_list'] = $p->getList($u->getCompany());
		$data['group_info'] = $p->getGroup($id, $u->getCompany());
		
		if(isset($_POST['name']) && !empty($_POST['name'])){
			$p_name = addslashes($_POST['name']);
			$p_list = $_POST['permissions'];
			$p->editGroup($p_name, $p_list, $id, $u->getCompany());
			header("Location: ".BASE_URL."/permissions");
		}

		$this->loadTemplate('permissions_edit_group', $data);
	}

	public function delete($id)
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['permission_link'] = true;

		if($u->hasPermission('permission.link')){
			$p = new Permissions();
			$p->delete($id);
			header("Location: ".BASE_URL."/permissions");
			exit;
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function delete_group($id)
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();
		$data['permission_link'] = true;

		if($u->hasPermission('permission.link')){
			$p = new Permissions();
			$p->deleteGroup($id);
			header("Location: ".BASE_URL."/permissions");
			exit;
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}
}