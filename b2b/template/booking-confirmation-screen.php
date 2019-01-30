<?php
$CDV=new ControllerDefaultValues();
ob_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
		<script language="javascript">
					function launcher(b, c){

					window.location.href = "booking-confirmation-email.php?va11=" + b + "&val22=" + c + "";
					}
			function launcher2(b, c){

			window.location.href = "booking-confirmation-cancel.php?va11=" + b + "&val22=" + c + "";
			}
		</script>
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
					<td colspan='3' style='background-color:rgb(248, 151, 40); color:#fff; font-size:15px; text-transform:uppercase; font-weight:bold;'><?=$CDV->thanks()?></td>
				</tr>
				<tr>
					<td colspan='3'>
						<strong>PLEASE PRINT THIS PAGE FOR FUTURE REFERENCE</strong>
					</td>
				</tr>
				<tr bgcolor='#eef1f4' class='HighlightRow'>
					<td class=OpeningTD colspan='3'>
						<strong>Agent Information</strong>
					</td>
				</tr>
				<tr>
					<td colspan='3'>
						<table style='font-size:11px;'>
							<tr>
								<td width='90'style='color:#666;'>Booking Agency:</td>
								<td colspan='2'><?=strip_tags($agent_obj[0]['agency'])?>&nbsp;&nbsp;&nbsp;<?=strip_tags($agent_obj[0]['agentbranch'])?></td>
							</tr>
							<tr>
								<td width='90'style='color:#666;'>Voucher/Folder Number:</td>
								<td colspan='2'><?=strip_tags($cookie['ReferenceNo'])?></td>
							</tr>
							<tr>
								<td width='90'style='color:#666;'>Agent Email: </td>
								<td colspan='2'><?=strip_tags($cookie['AgentEmail'])?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor='#eef1f4' class='HighlightRow'>
					<td class=OpeningTD colspan='3'>
						<strong>Customer information</strong>
					</td>
				</tr>
				<tr>
					<td colspan='3'>
						<table style='font-size:11px;'>
							<tr>
								<td width='90'style='color:#666;'>Name: </td>
								<td colspan='2'><?=strip_tags($cookie['firstname'])?> <?=strip_tags($cookie['lastname'])?></td>
							</tr>
							<tr>
								<td width='90'style='color:#666;'>Email: </td>
								<td colspan='2'><?=strip_tags($cookie['CustomerEmail'])?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor='#eef1f4' class='HighlightRow'>
					<td class=OpeningTD colspan='3'>
						<strong>Confirmation Number:U-<?=strip_tags($cookie['ReservationNo'])?></strong>
					</td>
				</tr>
				<tr>
					<td width='350px'>
						<table style='font-size:11px;'>
							<tr>
								<td width='110' style='color:#666;'>Vehicle Category:</td>
								<td><?=strip_tags($cost_obj['car']['vehiclecategory'])?></td>
							</tr>
							<tr>
								<td colspan='2' style='color:#666; font-weight:bold;'>PICK-UP DETAILS</td>
							</tr>
							<tr>
								<td width='110' style='color:#666;'>Pick Location:</td>
								<td><?=strip_tags($cookie['PickupLocationName'])?><br/><?=strip_tags($pickup_address)?></td>
							</tr>
							<tr>
								<td width='110' style='color:#666;'>Phone:</td>
								<td>1800 674 374</td>
							</tr>
							<tr>
								<td width='110' style='color:#666;'>Pick date :</td>
								<td><?=strip_tags($cookie['PickupDay'])?>/<?=strip_tags($cookie['PickupMonth'])?>/<?=strip_tags($cookie['PickupYear'])?></td>
							</tr>
							<tr>
								<td colspan='2' style='color:#666; font-weight:bold;'>DROP-OFF DETAILS</td>
							</tr>
							<tr>
								<td width='110' style='color:#666;'>Drop Location:</td>
								<td><?=strip_tags($cookie['DropoffLocationName'])?><br/><?=strip_tags($dropoff_address)?></td>
							</tr>
					</td>
				</tr>
				<tr>
					<td width='110' style='color:#666;'>Phone:</td>
					<td>1800 674 374</td>
				</tr>
				<tr>
					<td width='110' style='color:#666;'>Drop date :</td>
					<td><?=strip_tags($cookie['DropoffDay'])?>/<?=strip_tags($cookie['DropoffMonth'])?>/<?=strip_tags($cookie['DropoffYear'])?></td>
				</tr>
			</table>
			</td>
			<td colspan='2'>
				<img src='<?=strip_tags($cost_obj['car']['imagename'])?>'/>
			</td>
			</tr>
			<tr bgcolor='#eef1f4' class='HighlightRow'>
				<td class=OpeningTD colspan='3'>
					<strong>
					</strong>
				</td>
			</tr>
			<tr>
				<td colspan=3 >
					<table width=400 style='width:500px;'>
						<tr>
							<td class=greytext style='color:#000;' colspan=3 >
								<b>HERE IS THE PRICE</b>
							</td>
						</tr>
						<tr>
							<td class=greytext style='color:#000;' colspan=3 >
								<b>---- Rental For Period ( Inc GST ) ---- </td>
						</tr>
						<tr>
							<td class=greytext style='color:#000;' >
								<b>Days&nbsp;</td>
							<td class=greytext style='color:#000;' >
								<b>$<?=strip_tags($cost_obj['car']['totrate'])?></b>
							</td>
							<td class=greytext style='color:#666;' ><?=strip_tags($cost_obj['car']['numofdays'])?> Days @ $<?=strip_tags($cost_obj['car']['avgrate'])?>&nbsp;</td>
						</tr>
						<tr>
							<td class=text  align=left>
								<span style='font-weight:bold;color:#000;'><?=strip_tags($cost_obj['insurance']['name'])?></span>
								<td  align=left class=text style='color:#000;font-weight:bold;'>$<?=strip_tags($cost_obj['insurance']['displaytotal'])?></td>
								<td class=greytext align=left style='color:#666666;'>  <?=strip_tags($cost_obj['insurance']['displaytype'])?> at $<?=strip_tags($cost_obj['insurance']['displaydaily'])?> </td>
						</tr>
<?=$save_mandatory_fees_screen_html?>
<?=$save_discount_screen_html?>
						<tr>
							<td class=greytext style='color:#000;' >
								<b>Total (Inc. GST)</b>
							</td>
							<td class=greytext colspan=2 style='color:#000;' >
								<b>$<?=strip_tags($cost_obj['total'])?></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td HEIGHT=1 colspan=3  bgcolor=#F89728>
				</td>
			</tr>
			<tr>
				<td class=greytext colspan=2>
					<?=$bond_html?>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td colspan='3' align='center'   >       &nbsp;&nbsp;      
					<input  onClick="javascript:launcher('U-<?=htmlentities(strip_tags($cookie['ReservationNo']))?>', '<?=strip_tags($cookie['AgentEmail'])?>');" name='submit1' type='submit'  value='Email Reservation Confirmation'  />
					<input  onClick="javascript:launcher2('U-<?=htmlentities(strip_tags($cookie['ReservationNo']))?>', '<?=strip_tags($cookie['AgentEmail'])?>');" name='submit1' type='submit'  value='Cancel Reservation'  /> <br/>
				</td>
			</tr>
		</table>
	</body>
</html>
<?php
return ob_get_clean();
