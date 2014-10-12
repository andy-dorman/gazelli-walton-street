<?php

//ini_set('display_errors',1); 
//error_reporting(E_ALL);
//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
require 'lib/db.php';
$out = array();

if(!$_SERVER['REQUEST_METHOD'] == "POST") {
	$out["invalid"] = "You can't access this page directly!!";
	echo json_encode($out);
} else {
	foreach ($_POST as $key => $value) { 
    	$_POST[$key] = mysql_real_escape_string($value); 
  	}
		
	$name = $_POST['name'];
	$email = $_POST['email'];
	$goal = $_POST['goal'];

	$code = "0123";
	
	if (mysql_errno($mysqli)) {
	    printf("Connect failed: %s\n", mysql_error());
	    exit();
	}
	
	$query = "INSERT INTO customers (name, email, goal, code) VALUES ('".$name."', '".$email."',  '".$goal."', '".$code."')";
	
	//if($result = $mysqli->query($query)) {
	if($result = mysql_query($query)) {
		$out["id"] = mysql_insert_id();
		$out["goal"] = $goal;
		$out["name"] = $name;
		$out["result"] = "success";
		$out["thanks"] = '<div class="thankyou"><h3>Congratulations for locking in your goal</h3>
		<div class="social-icons">
			<ul class="list-inline text-center">
				<li class="social-icon twitter dark"><a href="www.twitter.com"></a></li>
				<li class="social-icon facebook dark"><a href="www.facebook.com"></a></li>
				<li class="social-icon email dark"><a href="www.email.com"></a></li>
			</ul>
		</div>
		<p class="text-center">Share the Walton Secret with your friends and let them find their key</p>
		<a href="#ok" id="oklink">OK</a>
		</div>';
	} else {
		$out["result"] = mysql_error();
	}
	echo json_encode($out);
	mysql_close($mysqli);
}
?>