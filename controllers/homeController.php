<?php
class homeController extends controller 
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

		$s = new Sales();

		$data['products_sold'] = $s->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany()); 

		$data['revenue'] = $s->getTotalRevenue(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

		$data['expenses'] = $s->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

		$data['days_list'] = [];
		for($i=30; $i>0; $i--){
			$data['days_list'][] = date('d/m', strtotime('-'.$i.' days'));
		}

		$data['revenue_list'] = $s->getRevenueList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

		$data['expenses_list'] = $s->getExpensesList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

		$data['statuses'] = ['0' => 'Aguarndando Pagamento', '1' => 'Pago', '2' => 'Cancelado'];

		$data['status_list'] = $s->getStatusList(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

		if($u->hasPermission('permission.link')){
			$this->loadTemplate('home', $data);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}	
	}
}