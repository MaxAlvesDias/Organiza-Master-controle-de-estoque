<?php
class loginController extends controller 
{
	public function index() 
	{
		$data = [];

		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);
			$password = addslashes($_POST['password']);
			$u = new Users();
			if($u->doLogin($email, $password) == true){
				header("Location: ".BASE_URL);
				exit;
			} else {
				$data['error'] = 'E-mail e/ou senha inválidos.';
			}
		}

		$this->loadView('login', $data);
	}

	public function logout()
	{
		$u = new Users();
		$u->logout();
		header("Location: ".BASE_URL);
	}
}