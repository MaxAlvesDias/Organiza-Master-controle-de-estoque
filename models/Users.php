<?php
class Users extends model 
{
	private $userInfo;
	private $permissions;

	public function getList($id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT users.id, users.name, users.email, permission_groups.name as p_name FROM users LEFT JOIN permission_groups ON permission_groups.id = users.id_group WHERE users.id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function doLogin($email, $password)
	{
		//$password = md5($password);
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :EMAIL AND password = :PASSWORD");
		$stmt->bindParam(":EMAIL", $email);
		$stmt->bindParam(":PASSWORD", $password);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$dataUser = $stmt->fetch();
			$_SESSION['loggedUser'] = $dataUser['id'];
			return true;
		} else {
			return false;
		}
	}

	public function isLogged()
	{
		if(isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser'])){
			return true;
		} else {
			return false;
		}
	}

	public function add($name, $email, $password, $group, $id_company)
	{
		$stmt = $this->conn->prepare("SELECT COUNT(*) as c FROM users WHERE email = :EMAIL");
		$stmt->bindParam(":EMAIL", $email);
		$stmt->execute();
		$row = $stmt->fetch();
		if($row['c'] == '0'){
			$stmt = $this->conn->prepare("INSERT INTO users(name, email, password, id_group, id_company) VALUES(:NAME, :EMAIL, :PASSWORD, :ID_GROUP, :ID_COMPANY)");
			$stmt->bindParam(":NAME", $name);
			$stmt->bindParam(":EMAIL", $email);
			$stmt->bindParam(":PASSWORD", md5($password));
			$stmt->bindParam(":ID_GROUP", $group);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			return '1';
		} else {
			return '0';
		}
	}

	public function edit($name, $password, $id_group, $id, $id_company)
	{
		$stmt = $this->conn->prepare("UPDATE users SET name = :NAME, id_group = :ID_GROUP WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_GROUP", $id_group);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if(!empty($password)){
			$stmt = $this->conn->prepare("UPDATE users SET password = :PASSWORD WHERE id = :ID AND id_company = :ID_COMPANY");
			$stmt->bindParam(":PASSWORD", md5($password));
			$stmt->bindParam(":ID", $id);
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
		}
	}

	public function delete($id, $id_company)
	{
		$stmt = $this->conn->prepare("DELETE FROM users WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}

	public function getInfo($id, $id_company)
	{
		$array = []; 
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
		}
		return $array;
	}

	public function logout()
	{
		unset($_SESSION['loggedUser']);
	}

	public function hasPermission($name)
	{
		return $this->permissions->hasPermission($name);
	}

	public function setLoggedUser()
	{
		if(isset($_SESSION['loggedUser']) && !empty($_SESSION['loggedUser'])){
			$id = $_SESSION['loggedUser'];
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :ID");
			$stmt->bindParam(":ID", $id);
			$stmt->execute();
			if($stmt->rowCount() > 0){
			  $this->userInfo = $stmt->fetch();
			  $this->permissions = new Permissions();
			  $this->permissions->setGroup($this->userInfo['id_group'], $this->userInfo['id_company']);
			}
		}
	}

	public function getCompany()
	{
		if(isset($this->userInfo['id_company'])){
			return $this->userInfo['id_company'];
		} else {
			return 0;
		}
	}

	public function getEmail()
	{
		if(isset($this->userInfo['email'])){
			return $this->userInfo['email'];
		} else {
			return '';
		}
	}

	public function getId()
	{
		if(isset($this->userInfo['id'])){
			return $this->userInfo['id'];
		} else {
			return '';
		}
	}

	public function findUsersInGroup($id)
	{
		$stmt = $this->conn->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :GROUP");
		$stmt->bindParam(":GROUP", $id);
		$stmt->execute();
		$row = $stmt->fetch();
		if($row['c'] == '0'){
			return false;
		} else {
			return true;
		}
	}
}
