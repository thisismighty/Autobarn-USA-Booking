<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/tr/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<title></title>

<!-- Copyright 2003-2010 GMH SYSTEMS LTD  -->
<!-- Product Development - Rental Car Manager  ( www.rentalcarmanager.com )  -->
<!--  All Rights Reserved  -->
<!--  This product and related documentation is protected by copyright and   -->
<!--  distributed under license restricting its use, copying, distribution  -->
<!--  and decompilation. No part of this product or related documentation may  -->
<!--  reproduced in any form by any means without prior written consent of -->
<!--  GMH Systems LTD  -->
<!--  For more information contact support@rentalcarmanager.com -->

 <style type="text/css">
.white {  font-family: Arial;font-size: 10pt;color: #000; font-weight: bold; }
.text  {  font-family: Arial;font-size: 9pt;color: #000; padding:0px 0px 6px 3px; }  
.formtext {  font-family: Arial;font-size: 8pt;color: #000; font-weight: bold; }
.header {  font-family: Arial;font-size: 10pt;color: #000; font-weight: bold; }
SELECT {   font-family: Arial;font-size: 8pt;color: #00000; }
.button {   font-family: Arial;font-size: 8pt;color: #000; }
input  {   font-family: Arial;font-size: 8pt;color: #000; vertical-align:bottom; }

</style>

<script language="javascript" type="text/javascript">
//<![CDATA[


function checkNumeric(objName)
{        var numberfield = objName;
   if (chkNumeric(objName) == false)
   {  numberfield.select();
      numberfield.focus();
      return false;
   }
   else
   {        return true;
   }
}
function chkNumeric(objName)
{   // only allow 0-9 be entered, plus any values passed
var checkOK = "0123456789";
var checkStr = objName;
var allValid = true;
var decPoints = 0;
var allNum = "";

   if  ((checkStr.value.length) != 0)
   {        for (i = 0;  i < checkStr.value.length;  i++)
            {        ch = checkStr.value.charAt(i);
               for (j = 0;  j < checkOK.length;  j++)
         if (ch == checkOK.charAt(j))
         break;
         if (j == checkOK.length)
         {     allValid = false;
            break;
               }
               if (ch != ",")
                  allNum += ch;
      }
            if (!allValid)
      {  alert("Please enter Numeric value");
            return (false);
      }
   }

}
//-->
//]]>
</script>
<script src="<?=ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
<?=ViewJS::draw('bin/js/jquery-2.1.3.min.js')?>
<?=ViewJS::draw('bin/js/Log.js')?>
<?=ViewJS::draw('bin/js/Template.js')?>
<?=ViewJS::draw('bin/js/General.js')?>
<?=ViewJS::draw('bin/js/Data.js')?>
<?=ViewJS::draw('bin/js/Step3.js')?>
<script type="text/javascript">
	Log.display=<?=ControllerSourceSite::log_get()?>;
	Data.data=<?=$CDV->get_js()?>;
	General.data.timestamp=<?=round(microtime(true)*1000)?>;
</script>
</head>
<body id="wow">

<form method='post' action='44.asp?dir=Rate'  name='Rating'  id='Rating' onsubmit="Step3.controller.form_submit(); return false;" ><input type='hidden' name='CarSizeID' size='5' value='16' />
<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface==
'== File Name :  webbookingstep3.asp==
'== Method Name : HTML Page Starts here - Allows entry and selection of extra fees, kms, and insurance options==
'== Tables Used : CarRateHourly, QSeason, Location==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->


<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface ==
'== File Name :  webbookingstep3.asp==
'== Method Name : FindTheRate2==
== Method Description :  Selects Required Rates based on Rate Structure==
'== Tables Used : WebLocationCategory, CarSize, WebRelocationFees, QCarRateDetails, Discount==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->

<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface==
'== File Name :  webbookingstep3.asp==
'== Method Name : ExtraForm==
'== Method Description :  Selects Required Extra fees based Location selection and displays to screen==
'== Tables Used : ExtraFees==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->


<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface==
'== File Name :  webbookingstep3.asp==
'== Method Name : InsuranceExtra==
'== Method Description :  Selects Required Insurance fees based Location selection and displays to screen==
'== Tables Used : ExtraFees==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->

<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface==
'== File Name :  webbookingstep3.asp==
'== Method Name : KmFeesSelection==
'== Method Description :  Selects valid KM fees based on Location and Web Available flags and displays to screen==
'== Tables Used : ExtraFees==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->





<!-- +++++++++++++++++++++++++++++++++++++++++++++++==
'== Module Name : Web Site Interface==
'== File Name :  webbookingstep3.asp==
'== Method Name : HTML Page Starts here - Allows entry and selection of extra fees, kms, and insurance options==
'== Tables Used : CarRateHourly, QSeason, Location==
'== +++++++++++++++++++++++++++++++++++++++++++++++   -->

  <input type='hidden' name='HourRate' value='0' /><input type='hidden' name='RateStructureID1' size='5' value='3' /><input type='hidden' name='RateName1' size='5' value='1 - 14 Days' /><input type='hidden' name='actureNoOfDaysEachSeason1' size='5' value='10.17' /><input type='hidden' name='NoOfDaysEachSeason1' size='5' value='11' /><input type='hidden' name='Season1' size='5' value='May 2016' /><input type='hidden' name='SeasonID1' size='5' value='663' /><input type='hidden' name='SeasonCount' value='1' /><input  type='hidden'  name='StandardRate1'  value='45' /><input  type='hidden'  name='Rate1'  value='45' /><input  type='hidden'  name='NoFreeDays'  value='0' /><input  type='hidden'  name='FreeDayRate'  value='45' /><input  type='hidden'  name='FreeDayExtraFeeID'  value='0' />

<table width="500px" align="left" border="0" cellpadding="0" cellspacing="10">

<tr><td align="center" valign="top">
	<table   align="center" width="512px"  bgcolor="#F89728" cellspacing="1" cellpadding="0" border="0">
		<tr>
			<td>
<table id="insurance-options" width="100%" align="center" bgcolor="#FFFFFF"  cellspacing="0" cellpadding="2"  border="0">
	<tr>
		<td style="padding-left:5px; font-size:9pt;" align="left"  bgcolor="#F89728" class="header" colspan="5" >BOND LIABILITY OPTIONS</td>
	</tr>
	<tr>
		<td style="font-size:9pt;" align="left"  colspan="5" >
			<table width="100%" align="center" bgcolor="#FFFFFF"  cellspacing="0" cellpadding="0"  border="0">
				<tr style="background-color: rgb(238, 238, 238); height: 10px; font-family:Arial, Helvetica, sans-serif; font-size:9pt;">
					<td colspan="3" style="font-weight: bold; text-align: center; border-right: solid 2px #fff; width:110px;">Description</td>
					<td style="font-weight: bold; text-align: center; border-right: solid 2px #fff;width:110px;120px;">Price</td>
					<td style="font-weight: bold; text-align: center; width:95px;">Excess</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="5">loading...</td></tr>
</table>
			</td>
		</tr>
</table>
    </td>
    </tr>
    </table>
  </form>
<!-- END RCM HTML CODE-->
<script type="text/html" id="html-insurance-options-head">
	<tr>
		<td style="padding-left:5px; font-size:9pt;" align="left"  bgcolor="#F89728" class="header" colspan="5" >BOND LIABILITY OPTIONS</td>
	</tr>
	<tr>
		<td style="font-size:9pt;" align="left"  colspan="5" >
			<table width="100%" align="center" bgcolor="#FFFFFF"  cellspacing="0" cellpadding="0"  border="0">
				<tr style="background-color: rgb(238, 238, 238); height: 10px; font-family:Arial, Helvetica, sans-serif; font-size:9pt;">
					<td colspan="3" style="font-weight: bold; text-align: center; border-right: solid 2px #fff; width:110px;">Description</td>
					<td style="font-weight: bold; text-align: center; border-right: solid 2px #fff;width:110px;120px;">Price</td>
					<td style="font-weight: bold; text-align: center; width:95px;">Excess</td>
				</tr>
			</table>
		</td>
	</tr>
</script>
<script type="text/html" id="html-insurance-options-row">
	<tr>
		<td class='text' style='text-align:left;'><input
			type='radio' name='InsuranceID'  value='%id' %checked/><a
				style='text-decoration:underline; cursor:pointer; color:#000;'
				onclick='window.open("<?=$CDV->wp_ajax_url('%encoded_extradesc')?>","Car","width=600, height=620, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
				>%name</a>
		</td>
		<td class='text' align='left'><?=$CDV->currency()?>$%fees(Daily)</td>
		<td class='text' style='text-align:left;'><?=$CDV->currency()?>$%excessfee</td>
	</tr>
</script>
<script type="text/html" id="html-insurance-options-footer">
	<tr>
		<td bgcolor='#F89728'  colspan='5' align='right' class='text' style='padding:0;'><input
			type='submit' name='Next'  value='NEXT'  class='button' /></td>
	</tr>
</script>
</body>
</html>

