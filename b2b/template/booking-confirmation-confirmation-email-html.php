<?php
ob_start();
?>
<html><head><META http-equiv=3DContent-Type content=3D'text/html; =
charset=3Dwindows-1252'><STYLE>.text{  font-size: 11px; line-height: =
15px; font-size: 11px;  font-family: Verdana,Arial;}   .white{  =
font-size: 20px;  font-weight: bold;color: #FFFFFF;  font-family: =
Verdana,Arial;}    .greytext{  font-size: 11px;  color:#666666;  =
font-family: Verdana,Geneva;}    .Yellow{  font-weight: normal;  =
font-size: 11px;  color: #FDFEBC;  font-family: Verdana,Arial;}    =
A.linkBlue{  font-size: 11px;  color: blue;  font-weight: 900; =
font-family: Verdana,Arial;  text-decoration: none;}  .HighlightRow =
{background-color:#EEF1F4;} .TitleRow  =
{background-color:#376293;}.OpeningTD {     border:solid windowtext =
1.0pt;   border-color:#F89728; }  BODY   {      =
background-color:#FFFFFF;  scrollbar-3dlight-color:#000000; =
scrollbar-arrow-color:#4D6185;   =
scrollbar-base-color:#BDD1FB;scrollbar-darkshadow-color:#000000; =
scrollbar-face-color:#B4BDC5;   =
scrollbar-highlight-color:#ffffff;scrollbar-track-color:#BDD1FB; =
scrollbar-shadow-color:#BDD1FB;}</STYLE><META content=3D'MSHTML =
6.00.2900.2722' name=3DGENERATOR></HEAD><title>Thanks for booking with =
Travellers Autobarn </title></head><body bgcolor=3DFFFFFF><center><IMG  =
src=3D'https://secure.rentalcarmanager.com.au/ssl/NzAutobarn68/AU_agent/i=
mages/travellerslogo-nz.gif' ></center><table =
style=3D'border-collapse:collapse;  border:solid windowtext 1.0pt; =
border-color:#F89728; ' cellspacing=3D0 cellpadding=3D2 width=3D600 =
align=3Dcenter bgcolor=3D#ffffff ><tr height=3D25 style=3D'border:solid =
windowtext 1.0px;  border-color:#F89728'><td style=3D'border:solid =
windowtext 1.0px; font-size:15px;text-transform:uppercase; color:#fff; =
font-weight:bold;  border-color:#F89728' bgcolor=3D#F89728 colspan=3D2  =
class=3DYellow>Thanks for booking with Travellers =
Autobarn</td></tr><tr><td colspan=3D2 class=3D'TEXT'><b>PLEASE PRINT =
THIS PAGE FOR FUTURE REFERENCE</td></tr><TR class=3DHighlightRow =
bgcolor=3D#EEF1F4><TD class=3DOpeningTD colspan=3D2><FONT class=3D'TEXT' =
style=3D'font-weight:bold;'>Agent Information </FONT></TD></tr><tr><td =
class=3Dtext width=3D120 style=3D'color:#666;'>Booking Agency:<td =
class=3Dtext> =
<?=quoted_printable_encode("{$agent_obj[0]['agency']}&nbsp;&nbsp;&nbsp;{$agent_obj[0]['agentbranch']}")?> =
</TD></tr><tr><td =
class=3Dtext  style=3D'color:#666;'>Corporate Rate ID:<td =
class=3Dtext> =
<?=quoted_printable_encode($agent_obj[0]['agentcode'])?> =
</TD></tr><tr><td class=3Dtext  =
style=3D'color:#666;'>Agent Email:<td =
class=3Dtext> =
<?=quoted_printable_encode($cookie['AgentEmail'])?> =
</TD></tr><TR class=3DHighlightRow =
bgcolor=3D#EEF1F4><TD class=3DOpeningTD colspan=3D2><FONT class=3D'TEXT' =
style=3D'font-weight:bold;'>Customer Information </FONT></TD></tr><TR =
><TD class=3DGREYTEXT width=3D120>Name: <td class=3Dtext align=3Dleft =
> =
<?=quoted_printable_encode("{$cookie['firstname']}&nbsp;{$cookie['lastname']}");?> =
</TD><TR ><TD class=3DGREYTEXT >Email Address: <td =
class=3Dtext align=3Dleft> =
<?=quoted_printable_encode($cookie['CustomerEmail'])?> =
</TD></tr><TR =
class=3DHighlightRow bgcolor=3D#EEF1F4><TD class=3DOpeningTD =
colspan=3D2><FONT class=3D'TEXT' =
style=3D'font-weight:bold;'>Confirmation =
Number:<b>U-<?=$cookie['ReservationNo']?> =
</FONT></TD></tr><tr><td colspan=3D2 ><table =
width=3D100% ><tr><td><table><TR ><TD class=3DGREYTEXT =
width=3D120><b>Vehicle Category:<td class=3Dtext align=3Dleft> =
<?=quoted_printable_encode($cost_obj['car']['vehiclecategory'])?> =
</TD></tr><tr><td class=3Dgreytext><b>PICK-UP =
DETAILS</td></tr><TR ><TD class=3DGREYTEXT >Pickup Location: <td =
class=3Dtext align=3Dleft> =
<?=quoted_printable_encode($cookie['PickupLocationName'])?> =
<br> =
<?=quoted_printable_encode($pickup_address)?> =
</td></tr><tr><td class=3Dgreytext>Pickup Date:</td><td =
class=3Dtext align=3Dleft> =
<?=quoted_printable_encode("{$cookie['PickupDay']}/{$cookie['PickupMonth']}/{$cookie['PickupYear']}")?> =
</td></tr><tr><td =
class=3Dgreytext  nowrap>Pickup Time:</td><td class=3Dtext =
align=3Dleft>10:00</td></tr><tr><td class=3Dgreytext><b>DROP-OFF =
DETAILS</td></tr><TR ><TD class=3DGREYTEXT >Dropoff Location: <td =
class=3Dtext align=3Dleft> =
<?=quoted_printable_encode($cookie['DropoffLocationName'])?> =
</td></tr><tr><td class=3Dgreytext>Dropoff =
Date:</td><td class=3Dtext =
align=3Dleft> =
<?=quoted_printable_encode("{$cookie['DropoffDay']}/{$cookie['DropoffMonth']}/{$cookie['DropoffYear']}")?> =
</td></tr><tr><td class=3Dgreytext  =
nowrap>Dropoff Time:</td><td class=3Dtext =
align=3Dleft>15:00</td></tr></table></td><td align=3Dcenter> =
<?=quoted_printable_encode("<IMG  src='{$cost_obj['car']['imagename']}' >")?> =
</td></tr></table></td></tr><TR class=3DHighlightRow><TD =
class=3DOpeningTD colspan=3D2><FONT class=3D'TEXT' =
style=3D'font-weight:bold;'>Voucher/Folder Number:&nbsp; <b> =
<?=quoted_printable_encode($cookie['ReferenceNo'])?></font></td></tr>
<tr><td colspan=3D2 ><table><tr><td class=3Dgreytext =
style=3D'color:#000;'><b>HERE IS THE PRICE</b></td></tr><tr><td =
class=3Dgreytext style=3D'color:#000;'><b>---- Rental For Period ( Inc =
GST ) ---- </td></tr> =
<tr> =
	<td class=3Dtext ><b>Rate</b></td> =
	<td class=3Dtext align=3Dright><b>$<?=strip_tags($cost_obj['car']['totrate'])?></b></td> =
	<td class=3Dgreytext align=3Dright> =
		<?=strip_tags($cost_obj['car']['numofdays'])?> Days @ $<?=strip_tags($cost_obj['car']['avgrate'])?> =
	</td> =
</tr><tr> =
<td class=3Dtext><b><?=strip_tags($cost_obj['insurance']['name'])?></b></td> =
<td align=3Dright class=3Dtext><b>$<?=strip_tags($cost_obj['insurance']['displaytotal'])?></b></td> =
<td class=3Dgreytext align=3Dright> =
	<?=strip_tags($cost_obj['insurance']['displaytype'])?> at $<?=strip_tags($cost_obj['insurance']['displaydaily'])?> =
</td> =
</tr> =
<?=$save_mandatory_fees_email_html?>
<?=$save_discount_email_html?>
<tr> =
	<td class=3Dgreytext style=3D'color:#000;'><b>Total (Inc. GST)</td> =
	<td class=3Dtext align=3Dright><b>$<?=strip_tags($cost_obj['total'])?></td> =
	<td></td> =
</tr><tr><td class=3Dgreytext =
style=3D'color:#000;'><b> =
Agent to collect  (<?=$cost_obj['agent_to_collect']['type']?>) </td><td =
class=3Dtext =
align=3Dright><b>$<?=$cost_obj['agent_to_collect']['value']?></td> =
<td></td></tr></table></td></tr><tr><td =
HEIGHT=3D1 colspan=3D2  bgcolor=3D#F89728></td></tr><tr><td HEIGHT=3D1 =
colspan=3D2  bgcolor=3D#F89728></td></tr><tr><td class=3Dgreytext =
colspan=3D2> =
<?=quoted_printable_encode($bond_html)?>
</td></tr><tr><td class=3Dtext colspan=3D2><br><p><B>Travellers =
Autobarn</td></tr><tr><td style=3D'border:solid windowtext 1.0px;  =
border-color:#F89728' bgcolor=3D#F89728 align=3Dcenter colspan=3D2  =
class=3DYellow>&nbsp;<br>&nbsp;</br></td></tr></table><center><a =
href=3Dhttp://<?=$CDV->domain()?>> =
<?=$CDV->domain()?>=
</a></body></html>
<?php
return ob_get_clean();
