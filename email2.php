<?php
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
	$message .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n";
	$message .= "<html xmlns:v='urn:schemas-microsoft-com:vml'><head>\n";
	$message .= "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>\n";
	$message .= "<style>\n";
	$message .= "td a {\n";
	$message .= "color: #bbbbbb;\n";
	$message .= "}\n";
	$message .= "tabel td {\n";
	$message .= "border-collapse: collapse;\n";
	$message .= "vertcal-align: top;\n";
	$message .= "}\n";
	$message .= "</style>\n";
	$message .= "</head>\n";
	$message .= "<body style='margin: 0; padding: 0;'>\n";
	$message .= "<div style='margin: 0; padding: 0; width: 100%; max-width: 800px'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='800' height='20' style='width:800px;' valign='top'>\n";
	$message .= "<table cellpadding='0' cellspacing='0' border='0' width='800' style='width:800px;' height='20'>\n";
	$message .= "<tr>\n";
	$message .= "<td width='57' height='20' style='width:57px;'><img style='display: block; min-width: 57px; width:57px; height: 20px;' width='57' height='20' src='http://www.waltonsecret.com/images/email/top-left.png'/></td>\n";
	$message .= "<td align='center' width='690' height='20' style='width: 690px; min-width: 690px; background: #8F4D51; color: #bbbbbb; font-size: 10px; margin: 2px 0 0 0; padding: 0px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;'>if this email does not display properly <a style='color: #bbbbbb !important; padding-top: 10px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;' href='http://waltonsecret.com/email.php?user='>click here</a> to view it in your browser</td>\n";
	$message .= "<td width='53' height='20' style='width:53px;'><img style='display: block; min-width: 53px; width:53px; height: 20px;' width='53' height='20' src='http://www.waltonsecret.com/images/email/top-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td height='80' width='800' colspan='3'><img style='display: block; width:800px; min-width: 800px; height: 80px;' width='800' height='80' src='http://www.waltonsecret.com/images/email/top-row-2.png'/></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td height='65'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0'>\n";
	$message .="<tr>\n";
	$message .="<td width='250' height='65'><img style='display: block; min-width: 250px; width:250px; height: 65px;' width='250' height='65' src='http://www.waltonsecret.com/images/email/top-row-3-left.png'/></td>\n";
	$message .="<td align='center' height='65' width='305' style='width: 305px; padding-top: 10px; height: 55px; line-height: 1.2em; color: #AAAAAA; font-size: 12px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; margin: 0;'>Keep your key safe to receive your special gift after out launch in 2015. You will be contacted with further details on claiming you gift at a later date.</td>\n";
	$message .="<td width='245' height='65'><img style='display: block; min-width: 245px; width:245px; height: 65px;' width='245' height='65' src='http://www.waltonsecret.com/images/email/top-row-3-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td height='20' width='800' style='width:800px;' colspan='3'><img width='800' height='20' style='width: 800px; min-width: 800px; height: 20px; display: block;' src='http://www.waltonsecret.com/images/email/middle-full-width.png'/></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='800' style='width:800px'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' style='width: 800px;' width='800'>\n";
	$message .="<tr>\n";
	$message .="<td width='360'><img style='display: block; width:360px; height: 25px;' width='360' height='25' src='http://www.waltonsecret.com/images/email/middle-row-2-left.png'/></td>\n";
	$message .="<td align='center' width='80' bgcolor='#8F4D51' style='width:80px; min-width:80px; -webkit-text-size-adjust: none; margin: 0; padding: 0;width:80px; color: #ffffff; letter-spacing: 0px;text-transform: uppercase; font-size: 12px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif;'>Your code</td>\n";
	$message .="<td width='360'><img style='display: block; width:360px; height: 25px;' width='360' height='25' src='http://www.waltonsecret.com/images/email/middle-row-2-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='800' style='width:800px'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .="<tr>\n";
	$message .="<td width='348' height='45'><img width='348' height='45' style='display: block' src='http://waltonsecret.com/images/email/ws-left.png'/></td>\n";
	$message .= "<td width='104' height='45' style='width: 104px;'><img width='104' style='display: block; width: 104px;' src='";
	$message .= "http://waltonsecret.com/images/email_codes/CUYN.png";
	$message .= "' alt='Your code' /></td>\n";
	$message .="<td width='348' height='45'><img width='348' height='45' style='display: block' src='http://waltonsecret.com/images/email/ws-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td height='40' width='800' style='font-size:1px; line-height:1px;'><img style='display: block; width: 800px; min-width: 800px; height: 40px;' width='800' height='40' src='http://www.waltonsecret.com/images/email/bottom-row-1.png'/></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='800' style='width: 800px;'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .="<tr>\n";
	$message .="<td width='237' height='159'><img style='margin: 0; display: block; width:237px; height: 159px;' width='237' height='159' src='http://www.waltonsecret.com/images/email/bottom-row-2-left.png'/></td>\n";
	$message .="<td width='331' height='159' align='center'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='331'>\n";
	$message .="<tr>\n";
	$message .="<td height='10' style='height: 10px;' colspan='5'></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td height='43' style='height:43px; vertical-align:middle; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>DREAM</td>\n";
	$message .="<td width='1' height='20' bgcolor='#8F4D51'></td>\n";
	$message .="<td height='43' style='height: 43px; vertical-align:middle; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>LIVE</td>\n";
	$message .="<td width='1' height='20' bgcolor='#8F4D51'></td>\n";
	$message .="<td height='43' style='height: 43px; vertical-align:middle; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>LEARN</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td colspan='5' height='106' style='height:106px; padding:0; text-transform: uppercase; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 16px; font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA;'>\n";
	$message .="Thank you &amp; congratulations<br/> for locking in your goal\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="<td width='232' height='159'><img style='margin: 0; display: block; width: 232px; height: 159px;' width='232' height='159' src='http://www.waltonsecret.com/images/email/bottom-row-2-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="<tr style='height:270px;'>\n";
	$message .="<td height='270'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='800'>\n";
	$message .="<tr>\n";
	$message .="<td width='270'><img style='display: block; width: 270px; height: 276px;' width='270' height='276' src='http://www.waltonsecret.com/images/email/bottom-row-3-left.png'/></td>\n";
	$message .="<td width='260'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='260' style='height: 269px;'>\n";
	$message .="<tr>\n";
	$message .="<td colspan='3' height='1' style='height: 1px; line-height: 1px; font-size: 0;' bgcolor='#aaaaaa'></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='10'></td>\n";
	$message .="<td height='229' style='height: 229px; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 22px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>A Goal</td>\n";
	$message .="<td width='10'></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='10'></td>\n";
	$message .="<td height='38' style='height: 38px; padding: 5px 0px 0; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1em; font-size: 16px;font-family: \"Bodoni MT\", Didot, \"Didot LT STD\", \"Hoefler Text\", Garamond, \"Times New Roman\", serif; color: #8F4D51;'>Andy Dorman 22.10.14</td>\n";
	$message .="<td width='10'></td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td colspan='3' height='1' style='line-height: 1px; font-size: 0; height: 1px' bgcolor='#aaaaaa'></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="<td width='270' height='99'><img style='display: block; width:270px; height:276px;' width='270' height='276' src='http://www.waltonsecret.com/images/email/bottom-row-3-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .= "</tr>\n";

	$message .= "<tr>\n";
	$message .= "<td style='width: 800px;' width='800'>\n";
	$message .= "<table style='width: 800px;' width='800' cellspacing='0' cellpadding='0' border='0'>\n";
	$message .="<tr>\n";
	$message .="<td width='270' height='99'><img width='270' height='99' style='width: 270px; height: 99px; display: block;' src='http://www.waltonsecret.com/images/email/bottom-row-4-left.png'/></td>\n";
	$message .="<td width='260' valign='top'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='260'>\n";
	$message .="<tr>\n";
	$message .="<td  style='height: 10px;' height='10'>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td width='260' style='vertical-align: middle; line-height: 1.2em; font-size: 12px;margin: 0; padding: 0;font-family: \"Century Gothic\", CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA; text-align:center'>Share the Walton Secret with your friends and help them find their key</td>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td style='height: 10px;' height='10'>\n";
	$message .="</tr>\n";
	$message .="<tr>\n";
	$message .="<td align='center' style='text-align: center; width: 260px;' width='260'>\n";
	$message .="<table cellpadding='0' cellspacing='0' border='0' width='100' style='margin: 0 auto;' align='center'>\n";
	$message .="<tr>\n";
	$message .="<td>\n";
	$message .="<a href='https://www.twitter.com/WaltonSecret'><img src='http://waltonsecret.com/images/email/icon-twitter.png' alt='Twitter' title='Twitter'/></a>\n";
	$message .="</td>\n";
	$message .="<td style='width: 8px;' width='8'></td>\n";
	$message .="<td style='text-align: center;'>\n";
	$message .="<a href='https://www.facebook.com/WaltonSecret'><img src='http://waltonsecret.com/images/email/icon-facebook.png' alt='Facebook' title='Facebook'/></a>\n";
	$message .="</td>\n";
	$message .="<td style='width: 8px;' width='8'></td>\n";
	$message .="<td style='text-align: center;'>\n";
	$message .="<a href='https://www.instagram.com/walton_secret'><img src='http://waltonsecret.com/images/email/icon-instagram.png' alt='Instagram' title='Instagram'/></a>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="<td width='270' height='99'><img width='270' height='99' style='width: 270px; height: 99px; display: block;' src='http://www.waltonsecret.com/images/email/bottom-row-4-right.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .= "</tr>\n";



	$message .="<tr>\n";
	$message .="<td height='46' style='width: 800px;' width='800'><img style='display: block; width: 800px; min-width: 800px; height: 46px;' width='800' height='46' src='http://www.waltonsecret.com/images/email/bottom-full-width.png'/></td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</td>\n";
	$message .="</tr>\n";
	$message .="</table>\n";
	$message .="</div>\n";
	$message .="</body>\n";
	$message .="</html>\n";
	$headers .= "Content-Length: ".strlen($message)."\r\n\r\n";

	mail($to, $subject, $message, $headers);
}
//$email, $code, $goal, $name, $id
sendEmail("andydorman@gmail.com", "1234", "A goal", "Andy Dorman", 12);
echo "done...";
?>