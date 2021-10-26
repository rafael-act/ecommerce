<?php 

require_once("vendor/autoload.php");//trazer as dependencias do composer sempre usa

use \Slim\Slim;	
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new \Slim\Slim();///cria uma nova aplicação do slim

$app->config('debug', true);

$app->get('/', function() {
    
	/*$sql = new Hcode\DB\Sql();
	$results=$sql->select("SELECT * FROM tb_users");
	echo json_encode($results);*/

	$page = new Page();
	$page->setTpl("index");

});

$app->get('/admin', function() {
    
	//echo "OK";
	/*$sql = new Hcode\DB\Sql();
	$results=$sql->select("SELECT * FROM tb_users");
	echo json_encode($results);*/

	$page = new PageAdmin();
	$page->setTpl("Index");

});

$app->run();

 ?>