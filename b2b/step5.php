<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();
if(!$CDV->validate($_COOKIE)){
	die('There was an error (1). Please <a href="index.php">try again</a>.');
}

if($_COOKIE['ReservationNo']==''){
	die('There was an error (1). Please <a href="index.php">try again</a>.');
}

$cost_obj=$CDV->extract_cost_obj($_COOKIE['Cost_Object']);
if(!$cost_obj){
	die('There was an error in calculating the costs: '.$CDV->error().'. Please <a href="index.php">try again</a>.');
}

$css_text			='font-size:11px;line-height:15px;font-family:Verdana,Arial;';
$css_white			='font-size:11px;font-weight:bold;color:#FFFFFF;font-family:Verdana,Geneva,Arial;';
$css_greytext		='font-size:11px;color:#666666;font-family:Verdana,Geneva,Arial;';
$css_yellow			='font-size:11px;font-weight:normal;color:#FDFEBC;font-family:Verdana,Geneva,Arial;';
$css_aLinkBlue		='font-size:11px;color:blue;font-weight:900;font-family:Verdana,Geneva,Arial;text-decoration:none;';
$css_highlightRow	='background-color:#EEF1F4;';
$css_titleRow		='background-color:#376293;';
$css_openingTD		='border:solid windowtext 1.0pt;border-color:#F89728;';
$mandatory_fees_html=$save_mandatory_fees_screen_html=$save_mandatory_fees_email_txt=$save_mandatory_fees_email_html=array();
/*
 * {$mandatory['displaytype']} at \${$mandatory['displaydaily']}
 */
foreach($cost_obj['mandatory'] as $mandatory){
	$save_mandatory_fees_screen_html[]=<<<EOT
<tr>
	<td class=text align=left >
		<span style='font-weight:bold;color:#000;'>{$mandatory['name']}</span>
	</td>
	<td align=left class=text style='color:#000; font-weight:bold;'>
		\${$mandatory['displaytotal']}
	</td>
	<td class=greytext align=left style='color:#666666;'>
		{$mandatory['displaytype']} at \${$mandatory['displaydaily']}
	</td>
</tr>
EOT;
	$save_mandatory_fees_email_txt[]="{$mandatory['name']}	\${$mandatory['displaytotal']}	{$mandatory['displaytype']} at \${$mandatory['displaydaily']} ";
	$save_mandatory_fees_email_html[]=<<<EOT
<tr>
	<td style='{$css_text}color:#000;'>
		<b>{$mandatory['name']}</b>
	</td>
	<td style='{$css_text}color:#000;'>
		<b>\${$mandatory['displaytotal']}</b>
	</td>
	<td style='{$css_greytext}'>
		{$mandatory['displaytype']} at \${$mandatory['displaydaily']}
	</td>
</tr>
EOT;
	$mandatory_fees_html[]=<<<EOT
<tr>
	<td class=text style='color:#000;'>
		<b>{$mandatory['name']}</td>
	<td class=text style='color:#000;'>
		<b>\${$mandatory['displaytotal']}</td>
	<td class=greytext>&nbsp;</td>
</tr>
EOT;
}
$mandatory_fees_html=implode("\n",$mandatory_fees_html);
$save_mandatory_fees_screen_html=implode("\n",$save_mandatory_fees_screen_html);
$save_mandatory_fees_email_txt=implode("\n",$save_mandatory_fees_email_txt);
$save_mandatory_fees_email_html=implode("\n",$save_mandatory_fees_email_html);

$discount_html=$save_discount_screen_html=$save_discount_email_txt=$save_discount_email_html=array();
foreach($cost_obj['discount_summary'] as $name=> $rate){
	$rate=number_format($rate,2);
	$save_discount_screen_html[]=<<<EOT
<tr>
	<td class=greytext style='color:#000;' >
		<b>Discount&nbsp;</td>
	<td class=greytext style='color:#000;' >
		<b>\${$rate}-</b>
	</td>
	<td class=greytext style='color:#666;' >{$name}</td>
</tr>
EOT;
	$save_discount_email_txt[]="Discount	\${$rate}-	{$name}";
	$save_discount_email_html[]=<<<EOT
<tr>
	<td style='{$css_text}color:#000;'>
		<b>Discount</b>
	</td>
	<td style='{$css_text}color:#000;'>
		<b>\${$rate}</b>
	</td>
	<td style='{$css_greytext}'>
		{$name}
	</td>
</tr>
EOT;
	$discount_html[]=<<<EOT
<tr>
	<td class=text style='color:#000;'>
		<b>Discount</td>
	<td class=text style='color:#000;'>
		<b>\${$rate}-</td>
	<td class=greytext>{$name}</td>
</tr>
EOT;
}
if(empty($discount_html)){
	$save_discount_email_html=<<<EOT
<tr>
	<td class=greytext style='color:#000;' >
		<b>Discount&nbsp;</td>
	<td class=greytext style='color:#000;' >
		<b>\$0.00</b>
	</td>
	<td class=greytext style='color:#666;' >&nbsp;</td>
</tr>
EOT;
	$save_discount_screen_html=<<<EOT
<tr>
	<td class=greytext style='color:#000;' >
		<b>Discount&nbsp;</td>
	<td class=greytext style='color:#000;' >
		<b>\$0.00</b>
	</td>
	<td class=greytext style='color:#666;' >&nbsp;</td>
</tr>
EOT;
	$save_discount_email_txt='';
	$save_discount_email_html='';
	$discount_html=<<<EOT
<tr>
	<td class=text style='color:#000;'>
		<b>Discount</td>
	<td class=text style='color:#000;'>
		<b>\$0.00</td>
	<td align=right class=greytext></td>
</tr>
EOT;
}else{
	$save_discount_email_html=implode("\n",$save_discount_email_html);
	$save_discount_screen_html=implode("\n",$save_discount_screen_html);
	$save_discount_email_txt=implode("\n",$save_discount_email_txt);
	$discount_html=implode("\n",$discount_html);
}

$agent_obj=$CDV->extract_agent_obj($_COOKIE['Agent_Object']);
if(!$agent_obj){
	die('There was an error in calculating the costs: '.$CDV->error().'. Please <a href="index.php">try again</a>.');
}
$agency_name="{$agent_obj[0]['agency']}&nbsp;&nbsp;&nbsp;{$agent_obj[0]['agentbranch']}";
if($agent_obj[0]['agency']==$agent_obj[0]['agentbranch']){
	$agency_name=$agent_obj[0]['agency'];
}

$DL=new DataLocation();
$pickup_address=$DL->address($_COOKIE['PickupLocationName']);
if(!$pickup_address){
	$pickup_address=$DL->address('Sydney');
}
$dropoff_address=$DL->address($_COOKIE['DropoffLocationName']);
if(!$dropoff_address){
	$dropoff_address=$DL->address('Sydney');
}

$pickup_day=date('l\,\ d/M/Y',strtotime("{$_COOKIE['PickupYear']}-{$_COOKIE['PickupMonth']}-{$_COOKIE['PickupDay']}"));
$dropoff_day=date('l\,\ d/M/Y',strtotime("{$_COOKIE['DropoffYear']}-{$_COOKIE['DropoffMonth']}-{$_COOKIE['DropoffDay']}"));

$bond_html=DataConfirmation::get_by_location_id($_COOKIE['PickupLocationID']);

$VBC=new ViewBookingConfirmation();

$DBC=new DataBookingConfirmation();
if($DBC->insert(
	$_COOKIE['ReservationNo'],
	$_COOKIE['AgentEmail'],
	$VBC->email_cancelled_html(
		$agent_obj,$_COOKIE,$cost_obj,
		$dropoff_address,$pickup_address
	),
	$VBC->email_cancelled_txt(
		$agent_obj,$_COOKIE,$cost_obj,
		$dropoff_address,$pickup_address
	),
	$VBC->email_html(
		$agent_obj,$_COOKIE,$cost_obj,
		$save_discount_email_html,$save_mandatory_fees_email_html,
		$dropoff_address,$pickup_address,
		$bond_html
	),
	$VBC->email_txt(
		$agent_obj,$_COOKIE,$cost_obj,
		$save_discount_email_txt,$save_mandatory_fees_email_txt,
		$dropoff_address,$pickup_address,$bond_html
	),
	$VBC->screen_cancelled(
		$agent_obj,$_COOKIE,$cost_obj,
		$dropoff_address,$pickup_address
	),
	$VBC->screen_email_sent(
		$agent_obj,$_COOKIE,$cost_obj,
		$save_discount_screen_html,$save_mandatory_fees_screen_html,
		$dropoff_address,$pickup_address,
		$bond_html
	),
	$VBC->screen(
		$agent_obj,$_COOKIE,$cost_obj,
		$save_discount_screen_html,$save_mandatory_fees_screen_html,
		$dropoff_address,$pickup_address,
		$bond_html
	)
)===false){
	if(EMDebug::$to_email===false){
		EMDebug::dd($DBC->error);
	}
	die("Error adding your booking. Please contact <a target='_blank' href='http://www.travellers-autobarn.com.au/contact-us'>Travellers Autobarn</a> and quote confirmation number U-{$_COOKIE['ReservationNo']}");
}

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
			INPUT {font-family: Arial, Helvetica, Times New Roman; font-size:8pt;color:#000000}
			.text{  font-size: 11px; line-height: 15px; font-size: 11px;  font-family: Arial;}
			.white{  font-size: 11px;  font-weight: bold;color: #FFFFFF;  font-family: Arial;}
			.greytext{  font-size: 11px;  color:#666666;  font-family: Arial;}
			.Yellow{  font-weight: normal;  font-size: 11px;  color: #FDFEBC;  font-family: Arial;}
			A.linkBlue{  font-size: 11px;  color: blue;  font-weight: 900; font-family: Arial;  text-decoration: none;}
			.HighlightRow {background-color:#EEF1F4;}
			.TitleRow  {background-color:#376293;}
			.OpeningTD {   border:solid windowtext 1.0pt; border-color:#FF7533; }
			.TEXTupper {font-family: Arial, Helvetica, Times New Roman; font-size:13px;color:#000000; font-weight:bold;}

		</style>
	</head>
	<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">


		<META content='MSHTML 6.00.2900.2722' name=GENERATOR>
			</HEAD>
			<title> </title> <style>.OpeningTD { border:solid 1pt; border-color:#F89728; padding:4px 2px} </style>
			</head>
			<body bgcolor=FFFFFF>
				<centear>
					<TABLE align=center width="680" cellSpacing=0 cellPadding=0  border=0>
						<tr>
							<td >   



								<!------------------RCM Code  start here----------------------------------->


								<center>
									<IMG  src=https://secure20.rentalcarmanager.com.au/ssl/AuAutoBarn191/AU_agent/images/travellerslogo-nz.gif >
								</center>
								<p>
									<table style='border-collapse:collapse;  border:solid windowtext 1.0pt; border-color:#F89728; mso-border-alt:solid windowtext 1.0pt;' cellspacing=0 cellpadding=2 width=630 align=center bgcolor=#ffffff border=0>
										<tr style='border:solid windowtext 1.0px;  border-color:#F89728'>
											<td style='border:solid windowtext 1.0px; font-size:15px; font-weight:bold; text-transform:uppercase;  border-color:#F89728' bgcolor=#F89728 colspan=2  class=white>Thanks for booking with TRAVELLERS AUTOBARN</td>
										</tr>
										<tr>
											<td colspan=2 class=TEXTupper>
												<b>PLEASE PRINT THIS PAGE FOR FUTURE REFERENCE<TR class='HighlightRow' bgcolor=#EEF1F4>
														<TD class='OpeningTD' colspan=2>
															<FONT class=TEXTupper>Agent Information </FONT>
														</TD>
													</tr>
													<tr>
														<td class=greytext width=120>Booking Agency:&nbsp;</td>
														<td class=text align=left width=520><?=$agency_name?></td>
													</tr>
											</td>
										</tr>
										<tr>
											<td class=greytext width=120>Voucher/Folder Number:&nbsp;</td>
											<td class=text align=left width=520><?=$_COOKIE['ReferenceNo']?></td>
										</tr>
										</td>
										</tr>
										<tr>
											<td class=greytext width=120>Agent Email:&nbsp;</td>
											<td class=text align=left width=520><?=$_COOKIE['AgentEmail']?></td>
										</tr>
										<TR class='HighlightRow' bgcolor=#EEF1F4>
											<TD class='OpeningTD' colspan=2>
												<FONT class=TEXTupper>Customer Information </FONT>
											</TD>
										</tr>
										<tr>
											<td class=greytext>Name:</td>
											<td class=text align=left><?=$_COOKIE['firstname']?> <?=$_COOKIE['lastname']?></td>
										</tr>
										<tr>
											<td class=greytext>Email Address:</td>
											<td class=text align=left><?=$_COOKIE['CustomerEmail']?></td>
										</tr>
										<TR class='HighlightRow' bgcolor=#EEF1F4>
											<TD class='OpeningTD' colspan=2>
												<FONT class=TEXTupper>Confirmation Number: <b>U-<?=$_COOKIE['ReservationNo']?></FONT>
											</TD>
										</tr>
										<tr>
											<td COLSPAN=2>
												<TABLE>
													<TR>
														<TD>
															<TABLE>
																<tr>
																	<td class=greytext>
																		<b>Vehicle Category:</td>
																	<td class=text align=left>
																		<b><?=$cost_obj['car']['vehiclecategory']?></td>
																</tr>
																<tr>
																	<td HEIGHT=5>
																	</td>
																</tr>
																<tr valign=top>
																	<td class=greytext>
																		<b>PICK-UP DETAILS</td>
																</tr>
																<tr valign=top>
																	<td class=greytext>Pickup Location:</td>
																	<td class=text align=left><?=$_COOKIE['PickupLocationName']?>&nbsp;&nbsp;<?=$pickup_address?></td>
																</tr>
																<tr>
																	<td class=greytext>Phone Number: </td>
																	<td align=left class=text>1800 674 374</td>
																</tr>
																<tr>
																	<td class=greytext>Pickup Date: </td>
																	<td class=text align=left><?=$pickup_day?></td>
																</tr>
																<tr>
																	<td class=greytext>Pick-Up From: </td>
																	<td class=text align=left>&nbsp;10:00</td>
																</tr>
																<tr>
																	<td HEIGHT=5>
																	</td>
																</tr>
																<tr valign=top>
																	<td class=greytext>
																		<b>DROP-OFF DETAILS</td>
																</tr> <tr valign=top>
																	<td class=greytext>Dropoff Location: </td>
																	<td align=left class=text><?=$_COOKIE['DropoffLocationName']?>&nbsp;&nbsp;<?=$dropoff_address?></td>
																</tr>
																<tr>
																	<td class=greytext>Phone Number: </td>
																	<td align=left class=text>1800 674 374</td>
																</tr>
																<tr>
																	<td class=greytext>Dropoff Date: </td>
																	<td align=left class=text><?=$dropoff_day?></td>
																</tr>
																<tr>
																	<td class=greytext>Drop-Off By: </td>
																	<td align=left class=text>&nbsp;12:00</td>
																</tr>
															</TABLE>
														</td>
														<TD ALIGN=CENTER>
															<center>
																<img src='<?=$cost_obj['car']['imagename']?>'/>
															</center>
														</TD>
													</TR>
												</TABLE>
											</td>
										</tr>
										<TR class='HighlightRow' bgcolor=#EEF1F4>
											<TD class='OpeningTD' colspan=2>
												<FONT class=TEXTupper>Voucher/Folder Number: <?=$_COOKIE['ReferenceNo']?></FONT>
											</TD>
										</tr>
										<tr>
											<td COLSPAN=2>
												<TABLE>
													<TR>
														<TD>
															<table>
																<tr>
																	<td class=greytext  style='color:#000;'>
																		<b>HERE IS THE PRICE</b>
																	</td>
																</tr>
																<tr>
																	<td class=greytext  style='color:#000;'>
																		<b>---- Rental For Period ( Inc GST ) ---- </td>
																</tr>
																<tr>
																	<td class=text style='color:#000;'>
																		<b>Days&nbsp;</td>
																	<td class=text style='color:#000;'>
																		<b>$<?=$cost_obj['car']['totrate']?></td>
																	<td align=right class=greytext>&nbsp;<?=$cost_obj['car']['numofdays']?>&nbsp; Days @ $<?=$cost_obj['car']['avgrate']?></td>
																</tr>
																<?=$mandatory_fees_html?>
																<?=$discount_html?>
																<tr>
																	<td class=text  align=left>
																		<span style='font-weight:bold;'><?=$cost_obj['insurance']['name']?></span>
																		<td  align=right class=text style='color:#000;font-weight:bold;'>$<?=$cost_obj['insurance']['displaytotal']?></td>
																		<td class=greytext align=right>  <?=$cost_obj['insurance']['displaytype']?> at $<?=$cost_obj['insurance']['displaydaily']?> </td>
																</tr>
																<tr>
																	<td class=text  style='color:#000;'>
																		<b>Total (Inc. GST)</td>
																	<td class=text>
																		<b>$<?=$cost_obj['total']?></td>
																</tr>
																<tr>
																	<td class=text  style='color:#000;'>
																		<b>Agent to collect (<?=$cost_obj['agent_to_collect']['type']?>) </td>
																	<td class=text>
																		<b>$<?=$cost_obj['agent_to_collect']['value']?></td>
																</tr>
															</table>
														</td>
													</tr>
													<tr>
														<td HEIGHT=5 colspan=2  bgcolor=#F89728>
														</td>
													</tr>
													<tr>
														<td class=text colspan=2>
															<div align=justify style='color:#575757;'> 
																<?=$bond_html?>

</pre></td></tr><tr><td class=text colspan=2><br><p><B><?=$CDV->title()?></td></tr></table></TD></TR></TABLE>
<?php

