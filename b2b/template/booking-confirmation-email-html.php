<?php
$css_text			='font-size:11px;line-height:15px;font-family:Verdana,Arial;';
$css_white			='font-size:11px;font-weight:bold;color:#FFFFFF;font-family:Verdana,Geneva,Arial;';
$css_greytext		='font-size:11px;color:#666666;font-family:Verdana,Geneva,Arial;';
$css_yellow			='font-size:11px;font-weight:normal;color:#FDFEBC;font-family:Verdana,Geneva,Arial;';
$css_aLinkBlue		='font-size:11px;color:blue;font-weight:900;font-family:Verdana,Geneva,Arial;text-decoration:none;';
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
					THIS IS AN EMAIL CONFIRMATION FOR YOUR BOOKING
				</td>
			</tr>
			<tr>
				<td colspan='3'>
					<strong>PLEASE PRINT THIS PAGE FOR FUTURE REFERENCE</strong>
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
					<table width='400' style='width:500px;'>
						<tr>
							<td style='<?=$css_greytext?>color:#000;' colspan='3'>
								<b>HERE IS THE PRICE</b>
							</td>
						</tr>
						<tr>
							<td style='<?=$css_greytext?>color:#000;' colspan='3'>
								<b>---- Rental For Period ( Inc GST ) ----</b>
							</td>
						</tr>
						<tr>
							<td style='<?=$css_greytext?>color:#000;'>
								<b>Days&nbsp;</b>
							</td>
							<td style='<?=$css_greytext?>color:#000;'>
								<b>$<?=strip_tags($cost_obj['car']['totrate'])?></b>
							</td>
							<td style='<?=$css_greytext?>'>
								<?=strip_tags($cost_obj['car']['numofdays'])?> Days @ $<?=strip_tags($cost_obj['car']['avgrate'])?>&nbsp;
							</td>
						</tr>
						<tr>
							<td style='<?=$css_text?>' align='left'>
								<span style='font-weight:bold;color:#000;'>
									<?=strip_tags($cost_obj['insurance']['name'])?>
								</span>
							<td align=left style='<?=$css_text?>color:#000;font-weight:bold;'>
								$<?=strip_tags($cost_obj['insurance']['displaytotal'])?>
							</td>
							<td style='<?=$css_greytext?>' align='left'>
								<?=strip_tags($cost_obj['insurance']['displaytype'])?> at $<?=strip_tags($cost_obj['insurance']['displaydaily'])?>
							</td>
						</tr>
						<?=$save_mandatory_fees_email_html?>
						<?=$save_discount_email_html?>
					</table>
				</td>
			</tr>
			<tr>
				<td HEIGHT=1 colspan=3  bgcolor=#F89728>
				</td>
			</tr>
			<tr>
				<td style='<?=$css_greytext?>' colspan=3>
					<?=$bond_html?>
				</td>
			</tr>
		</table>
	</body>
</html>
<?php
return ob_get_clean();
