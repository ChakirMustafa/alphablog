<?php
	require_once('../App/Models/Session.php');

function view($view, array $data = []){
	extract($data);
	ob_start();
	require("../app/views/$view.tml.php");
	$data = ob_get_contents();
	ob_end_clean();
	return $data;
}

function redirect($url = '/'){
	header("Location:$url");
}

function getUserName(){
	return $_SESSION['user']['username']?? '';
}

function getEmailUser(){
	return $_SESSION['user']['email']?? '';
}

function getUserRole(){
	return $_SESSION['user']['role']?? '';
}

function getAdminRole(){
	return $_SESSION['user']['role'] === 'admin';
}

function loggedIn(){
	return $_SESSION['logged']?? false;
}

function getUseId(){
	return $_SESSION['user']['id']?? '';
}
