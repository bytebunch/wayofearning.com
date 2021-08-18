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
		header("Location: dashboard.php");exit();
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

/******************************************/
/***** generate random integre value **********/
/******************************************/
if(!function_exists('generate_random_int')){
  function generate_random_int($number_values)
  {
  	$number_values = $number_values-2;
  	$lastid = rand(0,9);
  	for($i=0; $i <= $number_values; $i++)
  	{
  		$lastid .= rand(0,9);
  	}
  	return $lastid;
  }
}

function get_site_url(){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    return $url;  
}

function get_user_id_by_code($code){
	$query = 'SELECT ID from users where referral_code = "'.$code.'" LIMIT 1';
	global $conn;
	$results = $conn->query($query);
	if($results->num_rows){
		return $results->fetch_assoc()['ID'];
	}
	else{
		return null;
	}
}