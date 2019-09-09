<?php
require 'environment.php';

global $db;

$config = array();
if(ENVIRONMENT == 'development'){
	define("BASE_URL", "https://localhost/sales_register/");
	$config['dbname'] = 'sales_register';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}else{
	//--PARA PRODUÇÃO--//
	define("BASE_URL", "https://localhost/sales_register/");
	$config['dbname'] = 'sales_register';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

ini_set('default_charset', 'UTF-8');
$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->query("SET NAMES utf8");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
