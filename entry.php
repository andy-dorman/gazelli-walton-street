<?php

//ini_set('display_errors',1); 
//error_reporting(E_ALL);
//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
require 'lib/db.php';
$out = array();

function getCode() {
	$charList = array(
		1 => "A",
		2 => "B",
		3 => "C",
		4 => "D",
		5 => "E",
		6 => "F",
		7 => "G",
		8 => "H",
		9 => "I",
		10 => "J",
		11 => "K",
		12 => "L",
		13 => "M",
		14 => "N",
		15 => "O",
		16 => "P",
		17 => "Q",
		18 => "R",
		19 => "S",
		20 => "T",
		21 => "U",
		22 => "V",
		23 => "W",
		24 => "X",
		25 => "Y",
		26 => "Z",
		27 => "0",
		28 => "1",
		29 => "2",
		30 => "3",
		31 => "4",
		32 => "5",
		33 => "6",
		34 => "7",
		35 => "8",
		0 => "9");

	$code = "";

	for($i = 0; $i < 4; $i++) {
		$code .= $charList[rand(0, count($charList)-1)];
	}
	$query = "SELECT * FROM customers WHERE code = '".$code."';";
	
	$result = mysql_query($query);
	if($result && mysql_num_rows($result)) {
		mysql_free_result($result);
		return getCode();
	}
	else
	{
		return $code;
	}

}

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

	$code = getCode();

	/*
	if (!$result) {
	    printf("Connect failed: %s\n", mysql_error());
	    exit();
	}*/
	
	$query = "INSERT INTO customers (name, email, goal, code) VALUES ('".$name."', '".$email."',  '".$goal."', '".$code."')";
	
	$initials = "";
	$expName = explode(" ", $name);
	if (count($expName) > 1) {
		$initals .= substr($expName[0], 0, 1);
		$initals .= substr($expName[(count($expName) - 1)], 0, 1);
	} else {
		$initials .= substr($expName[0], 0, 2);
	}

	$my_img = imagecreate( 105, 45 );
	$background = imagecolorallocate( $my_img, 142, 76, 80 );
	$text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
	//$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
	putenv('GDFONTPATH=' . realpath('.'));

	$bboxDim = imagettfbbox( 20, 0, "fonts/BodoniXT", $code );
	$textWidth = abs($bboxDim[4] - $bboxDim[0]);
	
	$scale = 103/$textWidth;
	$fontSize = 20 * $scale;

	imagettftext( $my_img, $fontSize, 0, 1, 38, $text_colour, "fonts/BodoniXT", $code);
	imagepng( $my_img , "images/email_codes/".$code.".png");
	imagecolordeallocate( $my_img, $text_colour );
	imagecolordeallocate( $my_img, $background );
	imagedestroy( $my_img );

	if($result = mysql_query($query)) {
		$out["id"] = mysql_insert_id();
		$out["goal"] = $goal;
		$out["name"] = $name;
		$out["initials"] = $initials;
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

		sendEmail($email, $code);
	} else {
		$out["result"] = mysql_error();
	}
	echo json_encode($out);
	mysql_close($mysqli);

	function sendEmail($email, $code) {
		$to = strip_tags($email);

		$subject = 'Thank you for your goal';

		$headers = "From: oliver.edge@gazelli.co.uk\r\n";
		$headers .= "Reply-To: oliver.edge@gazelli.co.uk\r\n";
		//$headers .= "CC: susan@example.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$message = '<html><body>';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="0" cellspacing="0" border="0" width="600">';
		$message .= '<tr><td width="600" colspan="3"><img src="http://walton-street.aomegasolutions.com/images/email/top.png"/></td></tr>';
		$message .= '<tr>';
		$message .= '<td width="249"><img src="http://walton-street.aomegasolutions.com/images/email/left.png"/></td>';
		$message .= '<td width="105"><img src="http://walton-street.aomegasolutions.com/images/email_codes/'.$code.'.png" alt="Your code" /></td>';
		$message .= '<td width="247"><img src="http://walton-street.aomegasolutions.com/images/email/left.png"/></td>';
		$message .= '<tr><td colspan="3"><img src="http://walton-street.aomegasolutions.com/images/email/bottom.png"/></td></tr>';
		$message .= "</table>";
		$message .= "</body></html>";

		mail($to, $subject, $message, $headers);
	}
}
?>