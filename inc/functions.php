<?php
session_start();
/******************************************/
/***** Debug functions start from here **********/
/******************************************/


if(!function_exists('db')){
	function db($array1)
	{
		echo "<pre>";
		var_dump($array1);
		echo "</pre>";
	}
}

include_once("db_connect.php");

global $plans;
$plans = array(
	'1' => array(
		'price' => 100,
		'name' => 'Silver',
		'desc' => 'You will get 3% of your total deposit price.',
		'plan_percent' => 3,
	),
	'2' => array(
		'price' => 200,
		'name' => 'Gold',
		'desc' => 'You will get 13% of your total deposit price.',
		'plan_percent' => 13,
	),
	'3' => array(
		'price' => 300,
		'name' => 'Diamond',
		'desc' => 'You will get 23% of your total deposit price.',
		'plan_percent' => 23,
	),
);

function is_user_logged_in(){
	if(isset($_SESSION['user'])){
		return true;
	}
	else{
		return false;
	}
}


function redirect_user_not_loggedin(){
	if(!isset($_SESSION['user'])){
		header("Location: login.php");exit();
	}
}

function redirect_user_loggedin(){
	if(isset($_SESSION['user'])){
		header("Location: ../dashboard.php");exit();
	}
}

function is_plan_selected(){
	if(isset($_SESSION['user']) && isset($_SESSION['user']['plan']) && $_SESSION['user']['plan'])
		return true;
	else
		return false;
}

function is_account_verified(){
	if(isset($_SESSION['user']) && isset($_SESSION['user']['verify']) && $_SESSION['user']['verify'])
		return true;
	else
		return false;
}

