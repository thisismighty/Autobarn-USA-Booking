<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen" href="css/style.css" type="text/css">
<link rel="stylesheet" media="screen" href="css/dynCalendar.css" type="text/css">
<script language="javascript" type="text/javascript" src="js/browserSniffer.js"></script>
<script language="javascript" type="text/javascript" src="js/dynCalendar.js"></script>
<SCRIPT TYPE="text/javascript">
<!--
function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'width=600,height=800,scrollbars=yes');
return false;
}
//-->
</SCRIPT>

<title><?=$CDV->page_title()?></title>
<style type="text/css">
<!--
.text {font-family: Arial;font-size: 8pt;color: #000; }
-->
</style>
<!-- new js -->
<script src="<?=ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
<?=ViewJS::draw('bin/js/jquery-2.1.3.min.js')?>
<?=ViewJS::draw('bin/js/Log.js')?>
<?=ViewJS::draw('bin/js/Template.js')?>
<?=ViewJS::draw('bin/js/General.js')?>
<?=ViewJS::draw('bin/js/Data.js')?>
<?=ViewJS::draw('bin/js/Step2.js')?>
<script type="text/javascript">
	Log.display=<?=ControllerSourceSite::log_get()?>;
	Data.data=<?=$CDV->get_js()?>;
	General.data.timestamp=<?=round(microtime(true)*1000)?>;
</script>
<!-- /new js -->
</head>
<body>

<form method="post" name="theform" action="step2.php" id="theform" onsubmit="return Step2.controller.form_submit()">


<div class="frame_step_2_left">

<table width="200px" border="0">
<tr><td style="background-color:#F89728; font-weight:bold; padding:3px;">Adjust the dates of the quote here if required</td></tr>
<tr><td>Pickup Location:</td></tr>
<tr><td><select name='PickupLocationID' style='height: 22px'></select></td></tr>
<tr><td>Pickup date:</td></tr>
<tr>
  <td><table border="0" cellspacing="0" cellpadding="0">
  <tr><td class="formtext">
              <select name="PickupDay">
           <option value='01' >1</option><option value='02' >2</option><option value='03' >3</option><option value='04' >4</option><option value='05' >5</option><option value='06' >6</option><option value='07' >7</option><option value='08' >8</option><option value='09' >9</option><option value='10' >10</option><option value='11' >11</option><option value='12' >12</option><option value='13' >13</option><option value='14' >14</option><option value='15' >15</option><option value='16' >16</option><option value='17' >17</option><option value='18' >18</option><option value='19' >19</option><option value='20' >20</option><option value='21' >21</option><option value='22' >22</option><option value='23' >23</option><option value='24' >24</option><option value='25' >25</option><option value='26' >26</option><option value='27' >27</option><option value='28' >28</option><option value='29' >29</option><option value='30' >30</option><option value='31' >31</option>  </select>
           </td>
            <td class="formtext" >
            <select name="PickupMonth">
                  <option value='01' >Jan</option><option value='02' >Feb</option><option value='03' >Mar</option><option value='04' >Apr</option><option value='05' >May</option><option value='06' >Jun</option><option value='07' >Jul</option><option value='08' >Aug</option><option value='09' >Sep</option><option value='10' >Oct</option><option value='11' >Nov</option><option value='12' >Dec</option>
                  </select>
                  </td>
                   <td class="formtext">
                   <select name="PickupYear">
           <?=$CDV->years_selection()?>      </select>
                   </td>
                   <td style="width:33px">
         <script language="javaScript" type="text/javascript"> <!--
         function Callback_ISO1(date, month, year)
         {  if (String(month).length == 1) {
                  month = '0' + month;
            }
               if (String(date).length == 1) {
                  date = '0' + date;
            }
         document.forms['theform'].PickupDay.value = date;
         document.forms['theform'].PickupMonth.value = month;
         document.forms['theform'].PickupYear.value = year;
            }
            calendar1 = new dynCalendar('calendar1', 'Callback_ISO1');
            calendar1.setMonthCombo(true);
            calendar1.setYearCombo(true);
         //--> </script>
            </td>
            </tr>
              </table></td></tr>
<tr><td>Return Location</td></tr>
<tr><td> <select name='DropoffLocationID' style='height: 22px' ></select></td></tr>
<tr style="display:none;"><td> <input type="text" name="promocode" maxlength="30" size="30" value= /> </td> <td> <input type="text" name="AgencyCode" maxlength="30" size="30" value=stade /> </td></tr>
<tr><td>Return Date:</td></tr>
<tr><td><table border="0" cellspacing="0" cellpadding="0">
        <tr><td class="formtext">
        <select name="DropoffDay">
           <option value='01' >1</option><option value='02' >2</option><option value='03' >3</option><option value='04' >4</option><option value='05' >5</option><option value='06' >6</option><option value='07' >7</option><option value='08' >8</option><option value='09' >9</option><option value='10' >10</option><option value='11' >11</option><option value='12' >12</option><option value='13' >13</option><option value='14' >14</option><option value='15' >15</option><option value='16' >16</option><option value='17' >17</option><option value='18' >18</option><option value='19' >19</option><option value='20' >20</option><option value='21' >21</option><option value='22' >22</option><option value='23' >23</option><option value='24' >24</option><option value='25' >25</option><option value='26' >26</option><option value='27' >27</option><option value='28' >28</option><option value='29' >29</option><option value='30' >30</option><option value='31' >31</option>     </select>
           </td>
       <td class="formtext">
       <select name="DropoffMonth">
         <option value='01' >Jan</option><option value='02' >Feb</option><option value='03' >Mar</option><option value='04' >Apr</option><option value='05' >May</option><option value='06' >Jun</option><option value='07' >Jul</option><option value='08' >Aug</option><option value='09' >Sep</option><option value='10' >Oct</option><option value='11' >Nov</option><option value='12' >Dec</option>  </select>
           </td>

   <td class="formtext">
   <select name="DropoffYear">
          <?=$CDV->years_selection()?>
            </select>
            </td>
            <td style="width:33px">
      <script language="javaScript" type="text/javascript">
         <!--
         function Callback_ISO2(date, month, year)
         {
             if (String(month).length == 1) {
                month = '0' + month;
             }
             if (String(date).length == 1) {
             date = '0' + date;
             }
         document.forms['theform'].DropoffDay.value = date;
      document.forms['theform'].DropoffMonth.value = month;
      document.forms['theform'].DropoffYear.value = year;
          }
          calendar2 = new dynCalendar('calendar2', 'Callback_ISO2');
          calendar2.setMonthCombo(true);
          calendar2.setYearCombo(true);
          //-->
            </script></td>

            </tr>
            </table></td></tr>
            <tr  style="display:none;"><td><select name="pickupTime" style="width:85px; height: 22px">
                              <option value='00:00' >midnight</option>
                              <option value='00:30' >00:30 AM</option>
                     <option value='01:00' >1:00 AM</option><option value='01:30' >1:30 AM</option><option value='02:00' >2:00 AM</option><option value='02:30' >2:30 AM</option><option value='03:00' >3:00 AM</option><option value='03:30' >3:30 AM</option><option value='04:00' >4:00 AM</option><option value='04:30' >4:30 AM</option><option value='05:00' >5:00 AM</option><option value='05:30' >5:30 AM</option><option value='06:00' >6:00 AM</option><option value='06:30' >6:30 AM</option><option value='07:00' >7:00 AM</option><option value='07:30' >7:30 AM</option><option value='08:00' >8:00 AM</option><option value='08:30' >8:30 AM</option><option value='09:00' >9:00 AM</option><option value='09:30' >9:30 AM</option><option value='10:00' selected='selected'>10:00 AM</option><option value='10:30' >10:30 AM</option><option value='11:00' >11:00 AM</option><option value='11:30' >11:30 AM</option><option value='12:00' >12:00 PM</option><option value='12:30' >12:30 PM</option><option value='13:00' >13:00 PM</option><option value='13:30' >13:30 PM</option><option value='14:00' >14:00 PM</option><option value='14:30' >14:30 PM</option><option value='15:00' >15:00 PM</option><option value='15:30' >15:30 PM</option><option value='16:00' >16:00 PM</option><option value='16:30' >16:30 PM</option><option value='17:00' >17:00 PM</option><option value='17:30' >17:30 PM</option><option value='18:00' >18:00 PM</option><option value='18:30' >18:30 PM</option><option value='19:00' >19:00 PM</option><option value='19:30' >19:30 PM</option><option value='20:00' >20:00 PM</option><option value='20:30' >20:30 PM</option><option value='21:00' >21:00 PM</option><option value='21:30' >21:30 PM</option><option value='22:00' >22:00 PM</option><option value='22:30' >22:30 PM</option><option value='23:00' >23:00 PM</option><option value='23:30' >23:30 PM</option>
      </select></td></tr>
      <tr style="display:none;"><td><select name="DropoffTime"  style="width:85px; height: 22px">
            <option value='00:00' >midnight</option>
                      <option value='00:30' >00:30 AM</option>
                     <option value='01:00' >1:00 AM</option><option value='01:30' >1:30 AM</option><option value='02:00' >2:00 AM</option><option value='02:30' >2:30 AM</option><option value='03:00' >3:00 AM</option><option value='03:30' >3:30 AM</option><option value='04:00' >4:00 AM</option><option value='04:30' >4:30 AM</option><option value='05:00' >5:00 AM</option><option value='05:30' >5:30 AM</option><option value='06:00' >6:00 AM</option><option value='06:30' >6:30 AM</option><option value='07:00' >7:00 AM</option><option value='07:30' >7:30 AM</option><option value='08:00' >8:00 AM</option><option value='08:30' >8:30 AM</option><option value='09:00' >9:00 AM</option><option value='09:30' >9:30 AM</option><option value='10:00' >10:00 AM</option><option value='10:30' >10:30 AM</option><option value='11:00' >11:00 AM</option><option value='11:30' >11:30 AM</option><option value='12:00' >12:00 PM</option><option value='12:30' >12:30 PM</option><option value='13:00' >13:00 PM</option><option value='13:30' >13:30 PM</option><option value='14:00' >14:00 PM</option><option value='14:30' >14:30 PM</option><option value='15:00' selected='selected'>15:00 PM</option><option value='15:30' >15:30 PM</option><option value='16:00' >16:00 PM</option><option value='16:30' >16:30 PM</option><option value='17:00' >17:00 PM</option><option value='17:30' >17:30 PM</option><option value='18:00' >18:00 PM</option><option value='18:30' >18:30 PM</option><option value='19:00' >19:00 PM</option><option value='19:30' >19:30 PM</option><option value='20:00' >20:00 PM</option><option value='20:30' >20:30 PM</option><option value='21:00' >21:00 PM</option><option value='21:30' >21:30 PM</option><option value='22:00' >22:00 PM</option><option value='22:30' >22:30 PM</option><option value='23:00' >23:00 PM</option><option value='23:30' >23:30 PM</option>

            </select></td></tr>
             
              <tr style="display:none;">
              <td>Customer Age:</td>
              </tr>
<tr style="display:none;"><td><SELECT name=driverage><option value=0 selected>Please select</option><option value='20' selected>18-20 years old</option><option value='21'>21+ years old</option>
                   </SELECT></td></tr>
                      <tr><td><input name="submitbutton" class="button11" value="Search" type="submit" /></td></tr>
</table>
</div>
</form>
<!-- FINISH1 !-->

</td>

<!-- FINISH !-->


<div class="frame_step_2">
  <blockquote>
    <p><img src="images/travellerslogo-nz.gif" width="469" height="56" style="margin-left:40px;" />
    </p>
  </blockquote>
  <div class="red_check">
  <table width="260px" border="0" align="center" style="background-color:#F89728;">
  <tr><td style="text-align:center;"><table width="255px" border="0">
    <tr>
      <td colspan="5" style="text-align:center;">CHECK BOOKING: View, Email or Cancel an Existing Reservation</td>
      </tr>
    <tr>
    <form method="get" name="theform2" action="booking-confirmation.php" id="theform2">
      <td style="text-align:center;">Conf.:</td>
      <td style="text-align:center;"><input style="width:50px" name="va11"  value="" type="input" /></td>
      <td style="text-align:center;">Email:</td>
      <td style="text-align:center;"><input name="val22"  value="" type="input" style="width:50px"/></td>
      <td style="text-align:center;"><input name="submit3" class="button" value="Find" type="submit" /></td>
      
      </tr>
  </table></td></tr>
  </table>
</div>

  
      
      <div style="font-weight:bold; width:285px; margin:5px 0 5px 130px; text-align: center;">Please choose the kind of vehicle you want to reserve
      Rates are shown in <?=$CDV->currency()?>$ and include GST</div>
    
  
  <div style="width:650px;">
<table width="610px" border="0" align="center" style="text-align:center; margin:0 20px 0 20px; background-color:#F89728">
<tr style="height:10px;"><td style="font-weight:bold; padding-left:5px;"><?=$CDV->cars_and_campervans()?></td></tr>
</table> 
<input type=hidden name='SeasonCount' value='1' />
<table id="available-cars" width="610px" border="0" align="center" style="text-align:left; margin:0 20px 0 20px; border:1px solid #F89728;">
</table>

</div>

<div style="width:650px; margin-top:10px;">
<iframe name="ifrm0" width="650px" height="650px;" scrolling="no" id="ifrm0" frameBorder="0" ></iframe>
</div>
© 2016, Copyright Travellers Auto Barn, All rights reserved.
</div>
<script type="text/html" id="html-available-cars-head">
	<tr style="background-color:#eeeeee; height:10px;">
		<td style="font-weight:bold; text-align: center;">Vehicle Type</td>
		<td style="font-weight:bold; text-align: center;">Rental Charge</td>
		<td style="font-weight:bold; text-align: center;">kms Included</td>
		<td style="font-weight:bold; text-align: center;">Extra kms</td>
	</tr>
</script>
<script type="text/html" id="html-available-cars-loading">
	<tr><td>loading...</td></tr>
</script>
<script type="text/html" id="html-available-cars-row">
	<tr>
		<td><input
			type='radio'
			onclick='Step2.controller.step3("%carsizeid");'
			style='vertical-align: top;'
			name='a'><a
				style='text-decoration:underline; cursor:pointer;'
				onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
				>%categoryfriendlydescription<a>
			</input></td>
		<td><?=$CDV->currency()?>$ %totalrateafterdiscount</td>
		<td>unlimited</td>
		<td>free</td>
	</tr>
</script>
<script type="text/html" id="html-available-cars-row-request">
	<tr>
		<td><a
				style='text-decoration:underline; cursor:pointer;'
				onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
				>%categoryfriendlydescription<a>
			</input></td>
		<td><a href="onrequest.php?carsizeid=%carsizeid&categoryfriendlydescription=%categoryfriendlydescription" style="color:#000">Limited Availability - REQUEST NOW</a></td>
		<td>unlimited</td>
		<td>free</td>
	</tr>
</script>
<script type="text/html" id="html-available-cars-row-unavailable">
	<tr>
<?=$CDV->cars_row_unavailable_html()?>
	</tr>
</script>
<script type="text/html" id="html-available-cars-row-unavailable-because">
	<tr>
<?=$CDV->cars_row_unavailable_because_html()?>
	</tr>
</script>
</body>
</html>

