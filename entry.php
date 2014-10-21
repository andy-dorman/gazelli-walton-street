<?php

//ini_set('display_errors',1); 
//error_reporting(E_ALL);
//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
//header('Content-type: application/json');
require "lib/db.php";
$out = array();

function sendEmail($email, $code, $goal, $name, $id) {
	$to = strip_tags($email);

	$subject = "Thank you for your goal";

	$headers = "From: info@waltonsecret.com\r\n";
	$headers .= "Reply-To: info@waltonsecret.com\r\n";
	//$headers .= "CC: susan@example.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "X-Mailer: MIME-Mail v0.03, 20070419\r\n";
	$message = "";
	$message .= "<html>\n";
	$message .= "<head>\n";
	$message .= "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n";
	$message .= "<style>\n";
	$message .= "p a {\n";
	$message .= "color: #FFFFFF;\n";
	$message .= "}\n";
	$message .= "</style>\n";
	$message .= "</head>\n";
	$message .= "<body style='width: 100%; max-width: 800px; margin: 0; padding: 0; background: transparent url(http://www.waltonsecret.com/images/email/email_bg.png'>\n";
	$message .= "<div style='margin: 0; padding: 0; width: 800px; max-width: 800px'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='800' background='http://waltonsecret.com/images/email/top.png' colspan='3' style='color: #eeeeee; font-size: 8px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; background: transparent url(http://waltonsecret.com/images/email/top.png) left top no-repeat; text-align: center; height: 210px;' valign='top'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n\n";
	$message .= "<tr>\n";
	$message .= "<td align='center' width='800' height='20' colspan='3'>\n";
	$message .= "<p style='color: #bbbbbb; font-size: 10px; margin: 0; margin-top: 2px; padding-top: 0px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;'>\n";
	$message .= "if it does not display properly <a style='color: #bbbbbb !important; font-size: 10px; padding-top: 10px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;' href='http://waltonsecret.com/email.php?user=".$id."&code=".$code."' >click here</a> to view it in your browser</p>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td height='40' colspan='3'></td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td width='240'></td>\n";
	$message .= "<td align='center' height='115' width='320'>\n";
	$message .= "<p style='width:320px; line-height: 1.4em; color: #AAAAAA; font-size: 11px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;'>Keep your key safe to receive your special gift after out launch in 2015. You will be contacted with further details on claiming you gift at a later date.</p>\n";
	$message .= "</td>\n";
	$message .= "<td width='240'></td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td width='240'></td>\n";
	$message .= "<td align='center' width='320' height='25'>\n";
	$message .= "<p style='margin: 0; padding: 0; width:320px; color: #ffffff; letter-spacing: 1px;text-transform: uppercase; font-size: 12px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;'>\n";
	$message .= "Your code\n";
	$message .= "</p>\n";
	$message .= "</td>\n";
	$message .= "<td width='240'></td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td width='348' height='45'><img width='348' style='width: 348px; display: block' src='http://waltonsecret.com/images/email/left.png'/></td>\n";
	$message .= "<td width='104' height='45'><img width='104' style='display: block; width: 104px;' src='";
	$message .= "http://waltonsecret.com/images/email_codes/".$code.".png";
	$message .= "' alt='Your code' /></td>\n";
	$message .= "<td width='348' height='45'><img width='348' style='width: 348px; display: block' src='http://waltonsecret.com/images/email/right.png'/></td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td colspan='3' background='http://waltonsecret.com/images/email/bottom.png' width='800' height='620' valign='top' style='background: transparent url(http://waltonsecret.com/images/email/bottom.png) left top no-repeat'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .= "<tr>\n";
	$message .= "<td style='padding-top: 50px;'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='215'></td>\n";
	$message .= "<td width='370' align='center'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='370'>\n";
	$message .= "<tr>\n";
	$message .= "<td style='letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>DREAM</td>\n";
	$message .= "<td width='1' height='20' bgcolor='#8F4D51'></td>\n";
	$message .= "<td style='letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>LIVE</td>\n";
	$message .= "<td width='1' height='20' bgcolor='#8F4D51'></td>\n";
	$message .= "<td style='letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>LEARN</td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td colspan='5' style='padding-top:10px; text-transform: uppercase; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 16px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA;'>\n";
	$message .= "Thank you & congratulations<br/> for locking in your goal\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "<td width='215'></td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='270' style='width:270px;'></td>\n";
	$message .= "<td width='260' style='padding-top: 50px;'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='260' style='border-top: 1px solid #AAAAAA; border-bottom: 1px solid #AAAAAA; height: 240px;'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='10'></td>\n";
	$message .= "<td style='letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 20px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>".$goal."</td>\n";
	$message .= "<td width='10'></td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td width='10'></td>\n";
	$message .= "<td style='padding: 10px 0; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1em; font-size: 16px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>".$name." ".date_format(date_create(), 'd.m.y')."</td>\n";
	$message .= "<td width='10'></td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "<td width='270'style='width:270px;'></td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td width='270' style='width:270px;'></td>\n";
	$message .= "<td width='260' style='width: 260px; padding-top: 20px;'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='260'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='260' style='width: 260px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 12px;'>\n";
	$message .= "<p style='font-size: 12px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA; text-align:center'>Share the Walton Secret with your friends and help them find their key</p>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "<tr>\n";
	$message .= "<td style='width: 260px; text-align: center; padding-top: 10px;'>\n";
	$message .= "<a href='https://www.twitter.com/WaltonSecret' style='margin-left: 4px; margin-right: 4px;'><img src='http://waltonsecret.com/images/email/icon-twitter.png' alt='Twitter' title='Twitter'/></a>\n";
	$message .= "<a href='https://www.facebook.com/WaltonSecret' style='margin-left: 4px; margin-right: 4px;'><img src='http://waltonsecret.com/images/email/icon-facebook.png' alt='Facebook' title='Facebook'/></a>\n";
	$message .= "<a href='https://www.instagram.com/walton_secret' style='margin-left: 4px; margin-right: 4px;'><img src='http://waltonsecret.com/images/email/icon-instagram.png' alt='Instagram' title='Instagram'/></a>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "<td width='270' style='width:270px;'></td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</td>\n";
	$message .= "</tr>\n";
	$message .= "</table>\n";
	$message .= "</div>\n";
	$message .= "</body></html>\n";
	$headers .= "Content-Length: ".strlen($message)."\r\n\r\n";

	mail($to, $subject, $message, $headers);
}

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
	/*
	foreach ($_POST as $key => $value) { 
    	$_POST[$key] = mysql_real_escape_string($value); 
  	}*/
		
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$goal = mysql_real_escape_string($_POST['goal']);

	$code = getCode();

	/*
	if (!$result) {
	    printf("Connect failed: %s\n", mysql_error());
	    exit();
	}*/
	if($email !== "info@gazelli.co.uk" && $email !== "o.edge@gazelli.co.uk" && $email !== "oliver.edge@gazelli.co.uk") {
		$query = "SELECT * FROM customers WHERE email = '".$email."'";
		if($result = mysql_query($query)) {
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				mysql_close($mysqli);
				$out['duplicate_email'] = "You can only submit one goal per email address.";
				die(json_encode($out));
			}
		}
	}

	$query = "INSERT INTO customers (name, email, goal, code) VALUES ('".$name."', '".$email."',  '".$goal."', '".$code."')";
	
	$initials = "";
	$expName = explode(" ", $name);
	if (count($expName) > 1) {
		$initials .= substr($expName[0], 0, 1);
		$initials .= substr($expName[(count($expName) - 1)], 0, 1);
	} else {
		$initials .= substr($expName[0], 0, 2);
	}

	$my_img = imagecreate( 104, 45 );
	$background = imagecolorallocate( $my_img, 142, 76, 80 );
	$text_colour = imagecolorallocate( $my_img, 255, 255, 255 );
	//$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
	putenv('GDFONTPATH=' . realpath('.'));

	$bboxDim = imagettfbbox( 20, 0, "fonts/BodoniXT", $code );
	$textWidth = abs($bboxDim[4] - $bboxDim[0]);
	
	$scale = 95/$textWidth;
	$fontSize = 20 * $scale;

	imagettftext( $my_img, $fontSize, 0, 5, 38, $text_colour, "fonts/BodoniXT", $code);
	imagepng( $my_img , "images/email_codes/".$code.".png");
	imagecolordeallocate( $my_img, $text_colour );
	imagecolordeallocate( $my_img, $background );
	imagedestroy( $my_img );

	if($result = mysql_query($query)) {
		$out["id"] = mysql_insert_id();
		$out["goal"] = stripslashes($_POST['goal']);
		$out["name"] = $name;
		$out["initials"] = $initials;
		$out["result"] = "success";
		$out["thanks"] = '<div class="thankyou"><h3>Congratulations for locking in your goal</h3>
		<div class="social-icons">
			<ul class="list-inline text-center">
				<li class="social-icon twitter dark"><a href="https://www.twitter.com/WaltonSecret" target="_blank"></a></li>
				<li class="social-icon facebook dark"><a href="https://www.facebook.com/WaltonSecret" target="_blank"></a></li>
				<li class="social-icon email dark"><a href="https://www.instagram.com/walton_secret" target="_blank"></a></li>
			</ul>
		</div>
		<p class="text-center">Share the Walton Secret with your friends and let them find their key</p>
		<a href="#ok" id="oklink">OK</a>
		</div>';

		sendEmail($email, $code, stripslashes($_POST['goal']), $name, mysql_insert_id());
	} else {
		$out["result"] = mysql_error();
	}
	echo json_encode($out);
	mysql_close($mysqli);
}
?>