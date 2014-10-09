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
		
	$fname = $_POST['name'];
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
		$out["goal"] = $wish;
		$out["name"] = $name;
		$out["result"] = "success";
		$out["thanks"] = '<div class="thankyou"><h2>Thank You</h2><h3>FOR YOUR ENTRY</h3><p>Winners will be drawn on March 28th and notified via email or telephone.</p><div><a href="#" class="closefancybox">RETURN TO THE WISH TREE</a><a href="http://gazellicosmetics.com" class="last-child">VISIT gazellicosmetics.com</a></div></div>';
	} else {
		$out["result"] = mysql_error();
	}
	echo json_encode($out);
	mysql_close($mysqli);
}
?>