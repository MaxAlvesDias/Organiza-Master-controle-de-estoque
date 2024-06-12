<?php
class Companies extends model 
{
	private $companyInfo;

	public function __construct($id)
	{
		parent::__construct();
		$stmt = $this->conn->prepare("SELECT * FROM companies WHERE id = :ID");
		$stmt->bindParam(":ID", $id);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			$this->companyInfo = $stmt->fetch();
		}
	}
	

	public function getName()
	{
		if(isset($this->companyInfo['name'])){
			return $this->companyInfo['name'];
		} else {
			return '';
		}	
	}
}
