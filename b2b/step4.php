<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<title></title>
<head>
<!-- Copyright 2003-2009 GMH SYSTEMS LTD  -->
<!-- Product Development - Rental Car Manager  ( www.rentalcarmanager.com )  -->
<!--  All Rights Reserved  -->
<!--  This product and related documentation is protected by copyright and   -->
<!--  distributed under license restricting its use, copying, distribution   -->
<!--  and decompilation. No part of this product or related documentation may  -->
<!--  reproduced in any form by any means without prior written consent of -->
<!--  GMH Systems LTD  -->
<!--  For more information contact info@rentalcarmanager.com -->  
 <STYLE TYPE="text/css">
.white {  font-family: Arial;font-size: 10pt;color: #FFFFFF; font-weight: bold; }  
.text  {  font-family: Arial;font-size: 8pt;color: #000; padding:2px;}
.formtext {  font-family: Arial;font-size: 8pt;color: #000; font-weight: bold; }
.header {  font-family: Arial;font-size: 10pt;color: #000; font-weight: bold; text-align:left; }
.red {  font-family: Arial;font-size: 8pt;color: #FF0000; font-weight: bold; }
SELECT {   font-family: Arial;font-size: 8pt;color: #000; }
.button {   font-family: Arial;font-size: 8pt;color: #000; }
input  {   font-family: Arial;font-size: 8pt;color: #000; }
.BGColour input {
 font: 12px Verdana, Geneva, Arial, Helvetica, sans-serif;
 background-color: #FFFFCC;
 color: #102132;

}
input[type="submit"][disabled]{
	color:graytext;
}
</STYLE>

<script LANGUAGE="JavaScript">
<!-- Begin


function Validate()
{
        if (document.theForm.firstname.value == "")
  {      alert("First Name required.");
      document.theForm.firstname.focus();
      return (false);
  }
   if (document.theForm.lastname.value == "")
  {      alert("Last Name required.");
      document.theForm.lastname.focus();
      return (false);
  }
  //  if (document.theForm.address.value == "")
 // { //     alert("Address details required.");
    //  document.theForm.address.focus();
    //  return (false);
//  }
 // if (document.theForm.city.value == "")
 // {   //   alert("Address details required.");
     // document.theForm.city.focus();
     // return (false);
//  }
 
  
  if (document.theForm.AgentEmail.value == "")
  {      alert("Agent email address required.");
      document.theForm.AgentEmail.focus();
      return (false);
  }

if (document.theForm.CustomerEmail.value == "")
  {      alert("Email address required.");
      document.theForm.CustomerEmail.focus();
      return (false);
  }
  if (document.theForm.NoTravelling.value == "")
  {      alert("Number if Travelling required.");
      document.theForm.NoTravelling.focus();
      return (false);
  }
  if (document.theForm.ReferenceNo.value == "")
  {      alert("Voucher/Folder Numbers required.");
      document.theForm.ReferenceNo.focus();
      return (false);
  }
  if (document.theForm.agreeWithTerms.checked == false)
  {      alert("Please confirm that you have read and agreed with our terms and conditions.");
      document.theForm.agreeWithTerms.focus();
      return (false);
  }
  
  return (true)
  


}
//-->
</script>
<script type="text/javascript">
function ismaxlength(obj){
var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
if (obj.getAttribute && obj.value.length>mlength)
obj.value=obj.value.substring(0,mlength)
}
</script>


<script src="<?=ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
<?=ViewJS::draw('bin/js/jquery-2.1.3.min.js')?>
<?=ViewJS::draw('bin/js/Log.js')?>
<?=ViewJS::draw('bin/js/Template.js')?>
<?=ViewJS::draw('bin/js/General.js')?>
<?=ViewJS::draw('bin/js/Data.js')?>
<?=ViewJS::draw('bin/js/Step4.js')?>
<script type="text/javascript">
	Log.display=<?=ControllerSourceSite::log_get()?>;
	Data.data=<?=$CDV->get_js()?>;
	General.data.timestamp=<?=round(microtime(true)*1000)?>;
	Step4.data.country='<?=ControllerDefaultValues::$country?>';
	Step4.data.found_us='<?=$CDV->found_us()?>';
</script>
</head>


 

<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<centear>
<TABLE align=center width="550px" cellSpacing=0 cellPadding=0  border=0>
<tr><td >
 
<!-- start1  -->



<!-- end1 -->

<!-- RCM HTML CODE-----------> 



   <TABLE  width=510  align=center bgcolor=#F89728   cellSpacing=0 cellPadding=0  border=0><tr><td>
	<table id="reservation-quotation" width=100% align=center bgcolor=#FFFFFF   cellSpacing=0 cellPadding=0  border=0 style="border: 1px solid #F89728;">
	</table>
<INPUT TYPE="BUTTON" style="float:right; margin-right:1px;" VALUE="CHOSE DIFFERENT EXCESS REDUCTION OPTION" 
ONCLICK="window.location.href='step3.php'">  
    <form method=post action=''  name='theForm' target='_parent'  onSubmit='return Validate()&&Step4.controller.validate();'>
<table bgcolor="#FFFFFF" style="width:100%">
         <TR ><td colspan=4 align=center bgColor=#fff   class=header style="text-align:center; background-color:#FFFFFF; padding-top:15px;">Please fill in the details below and submit reservation
         </td></tr>
         
        
         <tr><td class=text colspan=3>
         <table width=100% cellpadding=4 cellspacing=2 border=1>
         <tr><td width=120 align=left class=text><font color=red>*</font>First Name:</td><td align=left class=text  colspan=2><input Type=text name=firstname maxlength=30 Size=20 value=''> <font color=red>*</font>Last Name: <input Type=text name=lastname maxlength=30 Size=20 value=''></td></tr>
         <tr><td align=left class=text><font color=red>*</font>Agent Email:</td><td align=left class=text colspan=2><input Type=text name=AgentEmail maxlength=50  Size=30 value=""></td></tr>


        </td></tr>
         

        
       
         <tr>
           <td align=left class=text><font color=red>*</font>Customer Email:</td><td align=left class=text  colspan=2><input Type=text name=CustomerEmail maxlength=50 Size=30 value=''></td></tr>
         <tr><td align=left class=text>Telephone:</td><td align=left class=text  colspan=2><input Type=text name=Phone Size=20 maxlength=20 value=''> Optional in case we need to contact you</td></tr>
         
         <!--  <tr>
         <td CLASS=text align=left>Arrival FLT:</td>
         <td CLASS=text align=left><input Type=text name=Flight maxlength=50 Size=30 value=''></td>
         </tr><tr>
         <td CLASS=text align=left>Departure FLT:</td>
         <td CLASS=text align=left><input Type=text name=Flightout maxlength=50 Size=30 value=''></td>
         </tr> <tr>-->
         <td CLASS=text align=left><font color=red>*</font># of Passengers:</td>
         <td CLASS=text align=left><input Type=text name=NoTravelling Size=3 value=''></td>
       
         </tr> 
         <tr>
           <td colspan="2" align=left><span style="font-size:19px;">-- FOR TRAVEL AGENT USE --</span></td>
         </tr>
          <tr>
         <td align=left class=text><font color=red>*</font>Voucher/Folder Numbers:</td>
         <td align=left class=text colspan=2><input Type=text name=ReferenceNo maxlength=12 onkeyup="return ismaxlength(this)"  size=12></textarea></td>
         </tr></table></td></tr>
      


        <tr><td colspan="4" align="center"   ><br />
<span class="askAgreeTermsCondText" style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:10px;">
      <input type="checkbox" value="1" name="agreeWithTerms">
      I have read and agree to the <a href="<?=$CDV->tc_url()?>" target="terms">terms and conditions</a> and I am between 18-75 years of age.
    </span>
     </td>
</tr>  
         
         <TR><td colspan=4 align=center  class=text style="padding-top:10px;">
             
         <input type=submit class=button value='CLICK TO SUBMIT RESERVATION'>

         </td></tr></form>

</td></tr></table></td></tr></table></form></td></tr></table> </td></tr></table>
   </td></tr></table>
<!-- END RCM HTML CODE-----------> 
<script type="text/html" id="html-reservation-quotation-loading">
	<tr>
		<td colspan=4>loading...</td>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-head">
	<tr height=20>
		<td  align=center class=header style="padding-left:5px;" bgColor=#F89728  colspan=4> RESERVATION QUOTATION</td>
	</tr>
	<tr>
		<td colspan=4 height=1 bgcolor=#C0C0C0></td>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-days">
	<tr>
<?=$CDV->reservation_quotation_days_html()?>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-excess">
	<tr>
<?=$CDV->reservation_quotation_excess_html()?>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-mandatory">
	<tr>
<?=$CDV->reservation_quotation_mandatory_html()?>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-discount">
	<tr>
<?=$CDV->reservation_quotation_discount_html()?>
	</tr>
</script>
<script type="text/html" id="html-reservation-quotation-footer">
	<tr>
		<td colspan=4 height=1 bgcolor=#999999></td>
	</tr>
<?=$CDV->reservation_quotation_total_html()?>
</script>
   
