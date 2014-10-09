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
		
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	//$address1 = $_POST['address1'];
	//$address2 = $_POST['address2'];
	//$city = $_POST['city'];
	//$postcode = $_POST['postcode'];
	$tel = $_POST['telephone'];
	$country = $_POST['country'];
	$wish = $_POST['wish'];
	$left = $_POST['left'];
	$top = $_POST['top'];
	
	if (mysql_errno($mysqli)) {
	    printf("Connect failed: %s\n", mysql_error());
	    exit();
	}
	
	$query = "INSERT INTO customers (first_name, last_name, email, telephone, country, wish, left_pos, top_pos) VALUES ('".$fname."', '".$lname."', '".$email."',  '".$tel."', '".$country."', '".$wish."', ". $left.", ". $top.")";
	
	//if($result = $mysqli->query($query)) {
	if($result = mysql_query($query)) {
		$out["id"] = mysql_insert_id();
		$out["wish"] = $wish;
		$out["name"] = $fname;
		$out["result"] = "success";
		$out["thanks"] = '<div class="thankyou"><h2>Thank You</h2><h3>FOR YOUR ENTRY</h3><p>Winners will be drawn on March 28th and notified via email or telephone.</p><div><a href="#" class="closefancybox">RETURN TO THE WISH TREE</a><a href="http://gazellicosmetics.com" class="last-child">VISIT gazellicosmetics.com</a></div></div>';
	} else {
		$out["result"] = mysql_error();
	}
	echo json_encode($out);
	mysql_close($mysqli);
}
?>