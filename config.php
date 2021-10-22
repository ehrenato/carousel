<?php
require 'environment.php';
setlocale(LC_TIME, "portuguese");
date_default_timezone_set('America/Recife');

define('VERSION', '1.6.2');

$config = array();

if (ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/portifolio/");
	$config['dbname'] = 'portfolio';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	/**Onde esta escrito coloar ipdamaquina colocar o ip da maquina */
	define("BASE_URL", "http://redeeps.saude.rn.gov.br/");
	$config['dbname'] = "db_redeeps";
	$config['host'] = "10.19.0.27";
	$config['dbuser'] = "redeeps";
	$config['dbpass'] = "joDld1pDKqeF";
}

global $db;

try {
	$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
	echo "ERRO NA CONEXAO: " . $e->getMessage();
	exit;
}
