<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
require 'lib/db.php';
if(!array_key_exists('user', $_GET) || !array_key_exists('code', $_GET)) {
	die();
}
$query = "SELECT * FROM customers WHERE ID = ".$_GET['user']." AND CODE = '".$_GET['user'].";
mysql_query($query);

if($result = mysql_query($query)) {
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
?>
<html>
<body style="margin: 0; padding: 0;">
	<div style="margin: 0; padding: 0;">
		<table cellpadding="0" cellspacing="0" border="0" width="800">
			<tr>
				<td width="800" height="210" colspan="3" style="color: #ffffff; font-size: 8px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; background: transparent url(images/email/top.png) left top no-repeat; text-align: center;" valign="top">
					<table cellpadding="0" cellspacing="0" border="0" width="800">
						<tr>
							<td width="220"></td>
							<td align="center" width="360">
								<p style="color: #ffffff; font-size: 8px; padding-top: 10px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
								</p>
							<td width="220"></td>
						</tr>
						<tr>
							<td height="60" colspan="3"></td>
						</tr>
						<tr>
							<td width="260"></td>
							<td align="center">
								<p style="width:240px; line-height: 1.8em; color: #AAAAAA; font-size: 12px; padding-top: 10px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
								Keep your key safe to receive your special gift at our exclusive launch party</p>
							</td>
							<td width="260"></td>
						</tr>
						<tr>
							<td height="65" colspan="3"></td>
						</tr>
						<tr>
							<td width="360"></td>
							<td align="center" width="80">
								<p style="margin-left: 2px;width:100px; color: #ffffff; letter-spacing: 1px;text-transform: uppercase; font-size: 12px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;">
								Your code</p>
							</td>
							<td width="360"></td>
						</tr>
					</table>

				</td>
			</tr>
			<tr>
				<td width="348"><img src="images/email/left.png"/></td>
				<td width="104"><img src="images/email_codes/<?php echo $row['code']?>.png" alt="Your code" /></td>
				<td width="348"><img src="images/email/right.png"/></td>
			</tr>
			<tr>
				<td colspan="3" width="800" height="620" valign="top" style="background: transparent url(images/email/bottom.png) left top no-repeat">
					<table cellpadding="0" cellspacing="0" border="0" width="800">
						<tr>
							<td style="padding-top: 50px;">
								<table cellpadding="0" cellspacing="0" border="0" width="800">
									<tr>
										<td width="215"></td>
										<td width="370" align="center">
											<table cellpadding="0" cellspacing="0" border="0" width="370">
												<tr>
													<td style="letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif; color: #8F4D51;">DREAM</td>
													<td width="1" height="20" bgcolor="#8F4D51"></td>
													<td style="letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif; color: #8F4D51;">LIVE</td>
													<td width="1" height="20" bgcolor="#8F4D51"></td>
													<td style="letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 26px;font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif; color: #8F4D51;">LEARN</td>
												</tr>
												<tr>
												<td colspan="5" style="padding-top:10px; text-transform: uppercase; letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 16px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA;">
													Thank you & congratulations<br/> for locking in your goal
												</td>
												</tr>
											</table>	
										</td>
										<td width="215"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table cellpadding="0" cellspacing="0" border="0" width="800">
									<tr>
										<td width="270"></td>
										<td width="260" style="padding-top: 50px; ">
											<table cellpadding="0" cellspacing="0" border="0" width="260" style="border-top: 1px solid #AAAAAA; border-bottom: 1px solid #AAAAAA; height: 240px;">
												<tr>
													<td width="10"></td>
													<td style="letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1.4em; font-size: 26px;font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif; color: #8F4D51;"><?php echo $row['goal']?></td>
													<td width="10"></td>
												</tr>
												<tr>
													<td width="10"></td>
													<td style="letter-spacing: 1px; text-align: center; vertical-align: middle; line-height: 1em; font-size: 16px;font-family: 'Bodoni MT', Didot, 'Didot LT STD', 'Hoefler Text', Garamond, 'Times New Roman', serif; color: #8F4D51;"><?php echo $row['name'].' '.date('d.m.y', strtotime($row['created_at'])); ?></td>
													<td width="10"></td>
												</tr>
											</table>
										</td>
										<td width="280"></td>
									</tr>
									<tr>
										<td width="280"></td>
										<td width="260" style="padding-top: 20px;">
											<table cellpadding="0" cellspacing="0" border="0" width="260">
												<tr>
													<td style="text-align: center; vertical-align: middle; line-height: 1.6em; font-size: 12px; font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif; color: #AAAAAA;">Share the Walton Secret with your friends and help them find their key</td>
												</tr>
												<tr>
													<td style="text-align: center; padding-top: 10px;">
														<a href="http://www.twitter.com" style="margin-left: 4px; margin-right: 4px;"><img src="images/email/icon-twitter.png" alt="Twitter" title="Twitter"/></a>
														<a href="http://www.facebook.com" style="margin-left: 4px; margin-right: 4px;"><img src="images/email/icon-facebook.png" alt="Facebook" title="Facebook"/></a>
														<a href="http://www.instagram.com" style="margin-left: 4px; margin-right: 4px;"><img src="images/email/icon-instagram.png" alt="Instagram" title="Instagram"/></a>
													</td>
												</tr>
											</table>
										</td>
										<td width="280"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</body></html>
<?php
}
}
?>