<?php
require 'environment.php';

global $db;
global $config;

$config = [];

if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/ProjetoNaka/Projeto2/Sistema-ERP-master");
	$config['dbname'] = 'system_erp';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
  	define("BASE_URL", "");
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

try {
$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOExeption $e) {
	echo "ERRO: ".$e.getMessage();
}


