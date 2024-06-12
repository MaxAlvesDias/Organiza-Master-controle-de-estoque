<?php
class inventoryController extends controller 
{
	public function index() 
	{
		$data = [];
		$u = new Users();
		$u->setLoggedUser();
		
		$c = new Companies($u->getCompany());
		$data['company_name'] = $c->getName();
		$data['user_email'] = $u->getEmail();

		if($u->hasPermission('inventory.view')){
			$i = new Inventory();
			$offset = 0;
			$data['inventory_list'] = $i->getList($u->getCompany(), $offset);
			$data['add_permission'] = $u->hasPermission('inventory.add');
			$data['edit_permission'] = $u->hasPermission('inventory.edit');
			$this->loadTemplate('inventory', $data);
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

		if($u->hasPermission('inventory.add')){
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$price = addslashes($_POST['price']);
				$quantity = addslashes($_POST['quantity']);
				$min_quantity = addslashes($_POST['min_quantity']);

				$price = str_replace('.', '', $price);
				$price = str_replace(",", ".", $price);

				$i = new Inventory();
				$i->add($name, $price, $quantity, $min_quantity, $u->getCompany(), $u->getId());
				header("Location: ".BASE_URL."/inventory");
			}
			
			$this->loadTemplate('inventory_add', $data);
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

		if($u->hasPermission('inventory.edit')){
			$i = new Inventory();
			if(isset($_POST['name']) && !empty($_POST['name'])){
				$name = addslashes($_POST['name']);
				$price = addslashes($_POST['price']);
				$quantity = addslashes($_POST['quantity']);
				$min_quantity = addslashes($_POST['min_quantity']);

				$price = str_replace('.', '', $price);
				$price = str_replace(",", ".", $price);

				$i->edit($id, $name, $price, $quantity, $min_quantity, $u->getCompany(), $u->getId());
				header("Location: ".BASE_URL."/inventory");
			}
			
			$data['inventory_info'] = $i->getInfo($id, $u->getCompany());
			$this->loadTemplate('inventory_edit', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function delete($id)
	{
		$u = new Users();
		$u->setLoggedUser();

		if($u->hasPermission('inventory.edit')){
			$i = new Inventory();
			$i->delete($id, $u->getCompany(), $u->getId());
			header("Location: ".BASE_URL."/inventory");
		}
	}
}