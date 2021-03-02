<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page; 

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	//echo "OK";
	/*$sql = new Hcode\DB\Sql();
	$results=$sql->select("SELECT * FROM tb_users");
	echo json_encode($results);*/

	$page = new Page();
	$page->setTpl("Index");

});

$app->run();

 ?>