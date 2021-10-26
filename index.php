<?php 

require_once("vendor/autoload.php");//trazer as dependencias do composer sempre usa

use \Slim\Slim;	
use \Hcode\Page;
use \Hcode\PageAdmin;

$app = new Slim();///cria uma nova aplicação do slim

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();
	$page->setTpl("index");

});

$app->get('/admin', function() {
	$page = new PageAdmin();
	$page->setTpl("index");

});

$app->run();

 ?>