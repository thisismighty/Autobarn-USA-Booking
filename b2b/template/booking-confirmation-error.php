<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<!-- Copyright 2003-2009 GMH SYSTEMS LTD  -->
		<!-- Product Development - Rental Car Manager  ( www.rentalcarmanager.com )  -->
		<!--  All Rights Reserved  -->
		<!--  This product and related documentation is protected by copyright and   -->
		<!--  distributed under license restricting its use, copying, distribution and    -->
		<!--  and decompilation. No part of this product or related documentation may  -->
		<!--  reproduced in any form by any means without prior written consent of -->
		<!--  GMH Systems LTD  -->
		<!--  For more information contact info@rentalcarmanager.com -->
		<style>
			.OpeningTD { border:solid 1pt; border-color:#F89728; padding:4px 2px} 
			.text {font-family: Arial, Helvetica, Times New Roman; font-size:8pt;color:#666666}
			.text2 {font-family: Arial, Helvetica, Times New Roman; font-size:8pt;color:#333}
			.greytext {font-family: Arial, Helvetica, Times New Roman;  font-size:8pt;color:#999999}
			.white {FONT-FAMILY: Arial, Helvetica, Sans-serif; font-weight:bold; FONT-SIZE: 8pt; COLOR:#FFFFFF; TEXT-DECORATION:none;   }
			.title {FONT-FAMILY: Arial, verdana,Helvetica, Sans-serif; font-weight:bold; FONT-SIZE:  13px; COLOR:#454545;  TEXT-DECORATION:none;   }
			SELECT {   font-family: Arial;font-size: 8pt;color: #666666; }
			.button {   font-family: Arial;font-size: 8pt;color: #666666; }
			input  {   font-family: Arial;font-size: 8pt;color: #666666; }
		</style>
	</head>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<META content='MSHTML 6.00.2900.2722' name=GENERATOR>
		</HEAD>
		<title> </title> <style>.OpeningTD { border:solid 1pt; border-color:#F89728; padding:4px 2px} </style>
		</head>
	<body bgcolor=FFFFFF>
		<table align='center' bgcolor='#ffffff' cellpadding='2' cellspacing='0' width='600' style='border:solid windowtext 1.0pt; border-color:rgb(248, 151, 40);border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:13px;'>
			<center>
				<IMG  src='https://secure20.rentalcarmanager.com.au/ssl/AuAutoBarn191/AU_agent/images/travellerslogo-nz.gif' >
			</center>
			<tr>
				<td colspan='3'><?=$message?></td>
			</tr>
			<tr>
				<td colspan='3'>
					<INPUT TYPE=button NAME=Back  VALUE=Back  class=button onClick='javascript:history.back( - 1)'>
				</td>
			</tr>
		</table>
	</body>

</html>
<?php
return ob_get_clean();