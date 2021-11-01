<?php 
session_start();
require_once("vendor/autoload.php");//trazer as dependencias do composer sempre usa

use \Slim\Slim;	
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();///cria uma nova aplicação do slim

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();
	$page->setTpl("index");

});



$app->get('/admin', function() {
	User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");

});

$app->get('/admin/login', function() {
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");
});

$app->post('/admin/login', function() {
	User::login($_POST["login"], $_POST["password"]);

	header("Location: /ecommerce/admin");
	exit;
});

$app->get('/admin/logout',function(){
	User::logout();

	header("Location: /ecommerceadmin/login");
	exit;
});

$app->get('/admin/users',function(){
	User::verifyLogin();//verifica se o usuario esta logado
	$users = User::listAll();

	$page=new PageAdmin();
	$page->setTpl("users",array(
		"users"=>$users
	));
});

$app->get('/admin/users/create',function(){
	User::verifyLogin();//verifica se o usuario esta logado
	
	$page=new PageAdmin();
	$page->setTpl("users-create");
});

//deve ser colocado antes dos endereços menores
$app->get('/admin/users/:iduser/delete',function($iduser){
	User::verifyLogin();//verifica se o usuario esta logado
	
	$user=new User();

	$user->get((int)$iduser);
	$user->delete();

	header("Location: /ecommerce/admin/users");
	exit;
});

//Consulta o usuario
$app->get('/admin/users/:iduser',function($iduser){
	User::verifyLogin();//verifica se o usuario esta logado
	
$user=new User();
$user->get((int)$iduser);

	$page=new PageAdmin();
	$page->setTpl("users-update",array(
		"user"=>$user->getValues($user)
	));
});

//Salvar Post
$app->post('/admin/users/create',function(){
	User::verifyLogin();//verifica se o usuario esta logado

	$user = new User();
	$_POST["inadmin"]=isset($_POST["inadmin"])?1:0;
	$user->setData($_POST);
	$user->save();//executa o insert no banco

	header("Location: /ecommerce/admin/users");
	exit;
});

    //Atualizar Post
    $app->post('/admin/users/:iduser',function($iduser){
	User::verifyLogin();//verifica se o usuario esta logado
	$user = new User();
	$_POST["inadmin"]=isset($_POST["inadmin"])?1:0;
	$user->get((int)$iduser);
	$user->setData($_POST);
	$user->update();

	header("Location: /ecommerce/admin/users");
	exit;
});


$app->run();

 ?>