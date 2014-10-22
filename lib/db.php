<?php
//ini_set('display_errors',1); 
error_reporting(E_ALL);
//$mysqli = new mysqli("127.0.0.1", "root", "", "gazelli", 3306);
$mysqli = mysql_connect("localhost", "walton", "w4lt0ns3cr3t");
if (!$mysqli) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("walton-secret", $mysqli);
?>