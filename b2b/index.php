<?php

require 'bin/required.php';
require 'etc/steps-conf.php';

$CDV=new ControllerDefaultValues();


?>


  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 
<head>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<link rel="stylesheet" media="screen" href="css/style.css" type="text/css">
<link rel="stylesheet" media="screen" href="css/dynCalendar.css" type="text/css">
<script language="javascript" type="text/javascript" src="js/browserSniffer.js">
</script>
<script language="javascript" type="text/javascript" src="js/dynCalendar.js">
</script>
<script Language="JavaScript">
<!--
function Validate(theForm)
{
  if (theForm.AgencyCode.value == "" )
  {      alert("Agency Code  required.");
      theForm.AgencyCode.focus();
      return (false);
  } 
    if (theForm.AgencyName.value == "" )
  {      alert("Consultant Name required.");
    theForm.AgencyName.focus();
      return (false);
  }
   return (true);
}
//-->  
</Script>

<title><?=$CDV->page_title()?></title>
<style type="text/css">
<!--
.text {font-family: Arial;font-size: 8pt;color: #000; }
#api_error{
	display:none;
	margin:5px 0 5px 10px;
	width:520px;
	min-height:18px;
	padding:5px;
	color:red;
	border:1px solid red;
	font-weight:bold;
	text-align:left;
}
-->
</style>
<!-- new js -->
<script src="<?=ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
<?=ViewJS::draw('bin/js/jquery-2.1.3.min.js')?>
<?=ViewJS::draw('bin/js/Log.js')?>
<?=ViewJS::draw('bin/js/Template.js')?>
<?=ViewJS::draw('bin/js/General.js')?>
<?=ViewJS::draw('bin/js/Data.js')?>
<?=ViewJS::draw('bin/js/Index.js')?>
<script type="text/javascript">
	Log.display=<?=ControllerSourceSite::log_get()?>;
	Data.data=<?=$CDV->get_js()?>;
	General.data.timestamp=<?=round(microtime(true)*1000)?>;
</script>
<!-- /new js -->
</head>
<body>


   
   
<tr><td align="center" valign="top">
                                  
        <form method="post" name="theform" action="step2.php" id="theform" onsubmit="return Validate(this)&&Index.controller.validation()">
<div class="frame_step_1">
<img src="images/head_1.jpg" width="533" height="72" />
<!-- primul table -->
<div style="width:550px;"> 
<table width="550px" border="0">
   <tr>
      <td width="196px">
      <span style="color:#F00">* Required Fields</span>
      </td>
      <td width="344">
          </td> 
    </tr>
    <tr style="display:none;">
      <td width="196">
      <span style="color:#F00">*</span>STEP1: CUSTOMER AGE
      </td>
      <td width="344">  <SELECT name=driverage><option value='20'>18-20 years old</option><option value='21'>21+ years old</option>
                   </SELECT>
         </td>    
   </tr>
    <tr>
      <td width="196">
      <span style="color:#F00">*</span>STEP1: PICK UP LOCATION
      </td>
      <td width="344"><select name='PickupLocationID' style='width:205px; height: 22px'></select>
         </td>    
   </tr>
    <tr>
      <td width="196">
      </td>
      <td width="344"><table border="0" cellspacing="0" cellpadding="0">
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
              </table>
         </td>    
   </tr>
    <tr>
      <td width="196">
      <span style="color:#F00">*</span>STEP2: DROP OFF LOCATION
      </td>
      <td width="344"><select name='DropoffLocationID' style='width:205px; height: 22px' ></select>
         </td>    
   </tr>
    <tr>
      <td width="196"></td>
      <td width="344"><table border="0" cellspacing="0" cellpadding="0">
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
            </table>
         </td>    
   </tr>
   
    <tr>
      <td width="196">
      <span style="color:#F00">*</span>STEP3: AGENCY CODE
      </td>
      <td width="344"><input name="AgencyCode" id="clearid1"  value="" type="input" style="width:198px" />
        

         </td>    
   </tr>
    <tr>
    <td width="196"><span style="color:#F00">*</span>STEP4: AGENT NAME</td>
    <td width="344"> <input name="AgencyName"  value="" type="text" style="width:198px" /></td>
    </tr>
     <tr>
    <td width="196"><span style="color:#fff">*</span>STEP5: PROMO CODE
       
        </td>
        <td width="344"><input type="text" name="promocode" style="width:198px" value="" />
    </tr>
    <tr>
   <input type="hidden" name="MyNewRandomNum" value="70.97797" />

      <td width="196"></td>
        <div style="display:none">
        <select name="pickupTime" style="width:85px; height: 22px">
                              <option value='00:00' >midnight</option>
                             
                     <option value='01:00' >1:00 AM</option><option value='01:30' >1:30 AM</option><option value='02:00' >2:00 AM</option><option value='02:30' >2:30 AM</option><option value='03:00' >3:00 AM</option><option value='03:30' >3:30 AM</option><option value='04:00' >4:00 AM</option><option value='04:30' >4:30 AM</option><option value='05:00' >5:00 AM</option><option value='05:30' >5:30 AM</option><option value='06:00' >6:00 AM</option><option value='06:30' >6:30 AM</option><option value='07:00' >7:00 AM</option><option value='07:30' >7:30 AM</option><option value='08:00' >8:00 AM</option><option value='08:30' >8:30 AM</option><option value='09:00' >9:00 AM</option><option value='09:30' >9:30 AM</option><option value='10:00' selected='selected'>10:00 AM</option><option value='10:30' >10:30 AM</option><option value='11:00' >11:00 AM</option><option value='11:30' >11:30 AM</option><option value='12:00' >12:00 PM</option><option value='12:30' >12:30 PM</option><option value='13:00' >13:00 PM</option><option value='13:30' >13:30 PM</option><option value='14:00' >14:00 PM</option><option value='14:30' >14:30 PM</option><option value='15:00' >15:00 PM</option><option value='15:30' >15:30 PM</option><option value='16:00' >16:00 PM</option><option value='16:30' >16:30 PM</option><option value='17:00' >17:00 PM</option><option value='17:30' >17:30 PM</option><option value='18:00' >18:00 PM</option><option value='18:30' >18:30 PM</option><option value='19:00' >19:00 PM</option><option value='19:30' >19:30 PM</option><option value='20:00' >20:00 PM</option><option value='20:30' >20:30 PM</option><option value='21:00' >21:00 PM</option><option value='21:30' >21:30 PM</option><option value='22:00' >22:00 PM</option><option value='22:30' >22:30 PM</option><option value='23:00' >23:00 PM</option><option value='23:30' >23:30 PM</option>
      </select>
      <select name="DropoffTime"  style="width:85px; height: 22px">
            <option value='00:00' >midnight</option>
                   
                     <option value='01:00' >1:00 AM</option><option value='01:30' >1:30 AM</option><option value='02:00' >2:00 AM</option><option value='02:30' >2:30 AM</option><option value='03:00' >3:00 AM</option><option value='03:30' >3:30 AM</option><option value='04:00' >4:00 AM</option><option value='04:30' >4:30 AM</option><option value='05:00' >5:00 AM</option><option value='05:30' >5:30 AM</option><option value='06:00' >6:00 AM</option><option value='06:30' >6:30 AM</option><option value='07:00' >7:00 AM</option><option value='07:30' >7:30 AM</option><option value='08:00' >8:00 AM</option><option value='08:30' >8:30 AM</option><option value='09:00' >9:00 AM</option><option value='09:30' >9:30 AM</option><option value='10:00' >10:00 AM</option><option value='10:30' >10:30 AM</option><option value='11:00' >11:00 AM</option><option value='11:30' >11:30 AM</option><option value='12:00' >12:00 PM</option><option value='12:30' >12:30 PM</option><option value='13:00' >13:00 PM</option><option value='13:30' >13:30 PM</option><option value='14:00' >14:00 PM</option><option value='14:30' >14:30 PM</option><option value='15:00' selected='selected'>15:00 PM</option><option value='15:30' >15:30 PM</option><option value='16:00' >16:00 PM</option><option value='16:30' >16:30 PM</option><option value='17:00' >17:00 PM</option><option value='17:30' >17:30 PM</option><option value='18:00' >18:00 PM</option><option value='18:30' >18:30 PM</option><option value='19:00' >19:00 PM</option><option value='19:30' >19:30 PM</option><option value='20:00' >20:00 PM</option><option value='20:30' >20:30 PM</option><option value='21:00' >21:00 PM</option><option value='21:30' >21:30 PM</option><option value='22:00' >22:00 PM</option><option value='22:30' >22:30 PM</option><option value='23:00' >23:00 PM</option><option value='23:30' >23:30 PM</option>
            
            </select>
        </div>
      <td width="344"><input name="submit2" class="button" value="Get Your Quote" type="submit"  style="width:205px" />
        
         </td>    
   </tr>
</table>
</div>

<!-- gata primul table -->
<div id="api_error"><img style='float:left;' src='images/error_icon.jpg'/><div class="msg" style='width:470px; padding-top:3px; padding-left:3px; float:left;'></div><div style='clear:both;'></div></div>
<input type="hidden" name="copy_rcmLocationInfo"		value="[]"/>
<input type="hidden" name="copy_rcmLocationFees"		value="[]"/>
<input type="hidden" name="copy_rcmAvailableCars"		value="[]"/>
<input type="hidden" name="copy_rcmCategoryTypeInfo"	value="[]"/>

</form>
<div class="red_check">
<table width="530px" border="0" align="center" style="background-color:#F89728;">
<tr><td style="text-align:center;"><table width="525px" border="0">
  <tr>
    <td colspan="5" style="text-align:center;">CHECK BOOKING: View, Email or Cancel an Existing Reservation</td>
  </tr>
  <tr>
    <td style="text-align:center;">Conf. Number:</td>
    <form method="get" name="theform2" action="booking-confirmation.php" id="theform2">
    <td style="text-align:center;"><input style="width:50px" name="va11"  value="" type="input" /></td>
    <td style="text-align:center;">Email:</td>
    <td style="text-align:center;"><input name="val22"  value="" type="input" /></td>
    <td style="text-align:center;"><input name="submit3" class="button" value="Find My Reservation!" type="submit" /></td>
    </form>
   
  </tr>
  
</table></td></tr>
</table>
</div>
© 2016, Copyright Travellers Auto Barn, All rights reserved.
</body>
</html>
