<?php
$css_text			='font-size:11px;line-height:15px;font-size:11px;font-family:Verdana,Arial;';
$css_white			='font-size:11px;font-weight:bold;color:#FFFFFF;font-family:Verdana,Geneva;';
$css_greytext		='font-size:11px;color:#666666;font-family:Verdana,Geneva;';
$css_yellow			='font-size:11px;font-weight:normal;color:#FDFEBC;font-family:Verdana,Geneva;';
$css_aLinkBlue		='font-size:11px;color: blue;font-weight:900;font-family:Verdana,Geneva;text-decoration: none;';
$css_highlightRow	='background-color:#EEF1F4;';
$css_titleRow		='background-color:#376293;';
$css_openingTD		='border:solid windowtext 1.0pt;border-color:#F89728;';

ob_start();
?>
<html>
	<head>
		<META http-equiv=Content-Type content='text/html; charset=windows-1252'>
	</HEAD>
	<body style='background-color:#FFFFFF;scrollbar-3dlight-color:#000000;scrollbar-arrow-color:#4D6185;scrollbar-base-color:#BDD1FB;scrollbar-darkshadow-color:#000000; scrollbar-face-color:#B4BDC5;   scrollbar-highlight-color:#ffffff;scrollbar-track-color:#BDD1FB; scrollbar-shadow-color:#BDD1FB;'>
		<center>
			<img src='http://secure.rentalcarmanager.com.au/DB/NZAutobarn68//logo.gif' alt="">
		</center>
		<table
			align='center' bgcolor='#ffffff' cellpadding='2' cellspacing='0' width='600'
			style='border:solid windowtext 1.0pt; border-color:rgb(248, 151, 40);border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; color:#000; font-size:13px;'>
			<tr>
				<td colspan='3'
					style='background-color:rgb(248,151,40);color:#fff;font-size:15px;font-weight:bold;'>
					THIS RESERVATION WAS CANCELLED
				</td>
			</tr>
			<tr>
				<td colspan='3'>
					This is a BOOKING CANCELLATION notification to inform you that the following booking details are now cancelled.
				</td>
			</tr>
			<tr bgcolor='#eef1f4' style='<?=$css_highlightRow?>'>
				<td colspan='3' style='<?=$css_openingTD?>'>
					<strong>Agent Information</strong>
				</td>
			</tr>
			<tr>
				<td width='110' style='color:#666;'>Booking Agency:</td>
				<td colspan='2'>
					<?=strip_tags($agent_obj[0]['agency'])?>&nbsp;&nbsp;&nbsp;<?=strip_tags($agent_obj[0]['agentbranch'])?>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Voucher/Folder Number:</td>
				<td colspan='2'>
					<?=strip_tags($cookie['ReferenceNo'])?>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Agent Email: </td>
				<td colspan='2'>
					<?=strip_tags($cookie['AgentEmail'])?>
				</td>
			</tr>
			<tr bgcolor='#eef1f4' style='<?=$css_highlightRow?>'>
				<td colspan='3' style='<?=$css_openingTD?>'>
					<strong>Customer information</strong>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Name: </td>
				<td colspan='2'>
					<?=strip_tags($cookie['firstname'])?> <?=strip_tags($cookie['lastname'])?>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Email: </td>
				<td colspan='2'>
					<?=strip_tags($cookie['CustomerEmail'])?>
				</td>
			</tr>
			<tr bgcolor='#eef1f4' style='<?=$css_highlightRow?>'>
				<td colspan='3' style='<?=$css_openingTD?>'>
					<strong>Confirmation Number:U-<?=strip_tags($cookie['ReservationNo'])?></strong>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Vehicle Category:</td>
				<td width='300'>
					<?=strip_tags($cost_obj['car']['vehiclecategory'])?>
				</td>
				<td width='290' rowspan='9'>
					<img src='<?=strip_tags($cost_obj['car']['imagename'])?>'/>
				</td>
			</tr>
			<tr>
				<td colspan='2' style='color:#666; font-weight:bold;'>PICK-UP DETAILS</td>
			</tr>
			<tr>
				<td style='color:#666;'>Pick Location:</td>
				<td>
					<?=strip_tags($cookie['PickupLocationName'])?>
					<br/>
					<?=strip_tags($pickup_address)?>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Phone:</td>
				<td>1800 674 374</td>
			</tr>
			<tr>
				<td style='color:#666;'>Pick date :</td>
				<td>
					<?=strip_tags($cookie['PickupDay'])?>/<?=strip_tags($cookie['PickupMonth'])?>/<?=strip_tags($cookie['PickupYear'])?>
				</td>
			</tr>
			<tr>
				<td colspan='2' style='color:#666;font-weight:bold;'>DROP-OFF DETAILS</td>
			</tr>
			<tr>
				<td style='color:#666;'>Drop Location:</td>
				<td>
					<?=strip_tags($cookie['DropoffLocationName'])?>
					<br/>
					<?=strip_tags($dropoff_address)?>
				</td>
			</tr>
			<tr>
				<td style='color:#666;'>Phone:</td>
				<td>1800 674 374</td>
			</tr>
			<tr>
				<td style='color:#666;'>Drop date :</td>
				<td>
					<?=strip_tags($cookie['DropoffDay'])?>/<?=strip_tags($cookie['DropoffMonth'])?>/<?=strip_tags($cookie['DropoffYear'])?>
				</td>
			</tr>
			<tr bgcolor='#eef1f4' style='<?=$css_highlightRow?>'>
				<td colspan='3' style='<?=$css_openingTD?>'>
					<strong></strong>
				</td>
			</tr>
			<tr>
				<td colspan='3'>
					<br/>Kind regards<br/>Travellers Autobarn<br/>
					<br/>
				</td>
			</tr>
		</table>
	</body>
</html>
<?php
return ob_get_clean();
