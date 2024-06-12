<?php
class Permissions extends model
{
	private $group;
	private $permissions;

	public function setGroup($id, $id_company)
	{
		$this->permissions = [];
		$this->group = $id;
		$stmt = $this->conn->prepare("SELECT params FROM permission_groups WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$row = $stmt->fetch();
			if(empty($row['params'])){
				$row['params'] = '0';
			}

			$params = $row['params'];
			$stmt = $this->conn->prepare("SELECT name FROM permission_params WHERE id IN ($params) AND id_company = :ID_COMPANY");
			$stmt->bindParam(":ID_COMPANY", $id_company);
			$stmt->execute();
			if($stmt->rowCount() > 0){
				foreach($stmt->fetchAll() as $item){
					$this->permissions[] = $item['name'];
				}
			}
		}
	}

	public function addGroup($permission_name, $permissions_list, $id_company)
	{
		$params = implode(",", $permissions_list);
		$stmt = $this->conn->prepare("INSERT INTO permission_groups SET name = :PNAME, id_company = :ID_COMPANY, params = :PARAMS");
		$stmt->bindParam(":PNAME", $permission_name);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":PARAMS", $params);
		$stmt->execute();
	}

	public function editGroup($permission_name, $permissions_list, $id, $id_company)
	{
		$params = implode(",", $permissions_list);
		$stmt = $this->conn->prepare("UPDATE permission_groups SET name = :PNAME, id_company = :ID_COMPANY, params = :PARAMS WHERE id = :ID");
		$stmt->bindParam(":PNAME", $permission_name);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->bindParam(":PARAMS", $params);
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
	}

	public function hasPermission($name)
	{
		if(in_array($name, $this->permissions)){
			return true;
		} else {
			return false;
		}
	}

	public function getList($id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM permission_params WHERE id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;
	}

	public function getGroupList($id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM permission_groups WHERE id_company = :ID_COMPANY");
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetchAll();
		}
		return $array;

	}

	public function getGroup($id, $id_company)
	{
		$array = [];
		$stmt = $this->conn->prepare("SELECT * FROM permission_groups WHERE id = :ID AND id_company = :ID_COMPANY");
		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			$array = $stmt->fetch();
			$array['params'] = explode(",", $array['params']);
		}
		return $array;

	}

	public function add($name, $id_company)
	{
		$stmt = $this->conn->prepare("INSERT INTO permission_params SET name = :NAME, id_company = :ID_COMPANY");
		$stmt->bindParam(":NAME", $name);
		$stmt->bindParam(":ID_COMPANY", $id_company);
		$stmt->execute();
	}

	public function delete($id)
	{
		$stmt = $this->conn->prepare("DELETE FROM permission_params WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
	}

	public function deleteGroup($id)
	{
		$u = new Users();
		if($u->findUsersInGroup($id) == false){
			$stmt = $this->conn->prepare("DELETE FROM permission_groups WHERE id = :ID");
			$stmt->bindParam(":ID", $id);
			$stmt->execute();
		}
	}
}