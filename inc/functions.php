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

