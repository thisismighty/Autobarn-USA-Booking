<?php
require 'bin/required.php';
require 'etc/steps-conf.php';


$error=array();

$CDV=new ControllerDefaultValues();

$COR=new ControllerOnRequest();
$error=$COR->post($_POST,$_COOKIE,$_GET,$CDV->onrequest_email_subject());
if(isset($error['request'])){
	die($error['request'].' <a href="index.php">Go back to the booking system and try again</a>.');
}
if($error===true){
	header('Location: onrequest-thankyou.php');
	die();
}

$start_js="OnRequest.controller.start();";
if(isset($error['form'])){
	$start_js=<<<EOT
OnRequest.view.error('{$error['form']} <a href="index.php">Go back to the booking system and try again</a>.');
EOT;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<link rel="stylesheet" media="screen" href="css/style.css" type="text/css"/>
		<link rel="stylesheet" media="screen" href="css/dynCalendar.css" type="text/css"/>
		<script language="javascript" type="text/javascript" src="js/browserSniffer.js"></script>
		<script language="javascript" type="text/javascript" src="js/dynCalendar.js"></script>
		<title>TRAVELLERS AUTOBARN - AGENT ON REQUEST BOOKING</title>
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
		<script src="<?=ControllerSourceSite::api_url_get()?>" type="text/javascript"></script>
		<?=ViewJS::draw('bin/js/jquery-2.1.3.min.js')?>
		<?=ViewJS::draw('bin/js/Log.js')?>
		<?=ViewJS::draw('bin/js/Template.js')?>
		<?=ViewJS::draw('bin/js/General.js')?>
		<?=ViewJS::draw('bin/js/Data.js')?>
		<?=ViewJS::draw('bin/js/OnRequest.js')?>
<script type="text/javascript">
	Log.display=<?=ControllerSourceSite::log_get()?>;
	General.data.timestamp=<?=round(microtime(true)*1000)?>;
</script>
	</head>
	<body>
		<form method="post" name="theform" action="" id="theform">
			<div class="frame_step_1" style="text-align:left;">
				<img src="images/tablogo.png" />
				<h2 style="font-size:24px;text-align:center;border-bottom:1px solid #eee;font-weight:bold;margin:0 5px 5px 5px;padding:10px;">BOOKED OUT - REQUEST AVAILABILITY</h2>
				<div style="width:550px;"> 
					<table width="550px" border="0">
						<tr>
							<td width="196px">
								<span style="color:#F00">* Required Fields</span>
							</td>
							<td width="344">
							</td> 
						</tr>
						<tr>
							<td width="196">PICK UP LOCATION:</td>
							<td width="344"><?=$_COOKIE['PickupLocationName']?></td>
						</tr>
						<tr>
							<td width="196">
							</td>
							<td width="344"><?=date('j F Y',strtotime("{$_COOKIE['PickupYear']}-{$_COOKIE['PickupMonth']}-{$_COOKIE['PickupDay']}"))?></td>
						</tr>
						<tr>
							<td width="196">DROP OFF LOCATION:</td>
							<td width="344"><?=$_COOKIE['DropoffLocationName']?></td>
						</tr>
						<tr>
							<td width="196"></td>
							<td width="344"><?=date('j F Y',strtotime("{$_COOKIE['DropoffYear']}-{$_COOKIE['DropoffMonth']}-{$_COOKIE['DropoffDay']}"))?></td>

						</tr>
						<tr>
							<td width="196">VEHICLE:</td>
							<td width="344"><?=$_GET['categoryfriendlydescription']?></td>
						</tr>
						<tr>
							<td width="196">BOND:</td>
							<td width="344"><select id="excess" name="excess"></select></td>
						</tr>
						<tr>
							<td width="196">AGENCY CODE:</td>
							<td width="344"><?=$_COOKIE['AgencyCode']?></td>
						</tr>
						<tr>
							<td width="196">AGENT NAME:</td>
							<td width="344"><?=$_COOKIE['AgencyName']?></td>
						</tr>
						<tr>
							<td width="196"><span style="color:#F00">*</span> AGENT EMAIL:</td>
							<td width="344">
								<input type="text" name="AgentEmail" style="width:198px"
									value="<?=isset($_POST['AgentEmail'])?strip_tags(htmlentities($_POST['AgentEmail'])):''?>"
									/>
								<?=isset($error['AgentEmail'])?'<p style="color:red;padding-bottom:5px;">'.$error['AgentEmail'].'</p>':''?>
							</td>
						</tr>
						<tr>
							<td width="196" style="vertical-align:middle">NOTES:</td>
							<td width="344"><textarea
								name="notes"
								placeholder="Enter your notes here..."
								style="width:196px;height:50px;"><?=
									isset($_POST['notes'])?strip_tags($_POST['notes']):''
								?></textarea>
						</tr>
						<tr>
							<td></td>
							<td width="344"><input name="submit2" class="button" value="REQUEST AVAILABILITY" type="submit"  style="width:205px" disabled="disabled" /></td>
						</tr>
					</table>
				</div>
				<div id="api_error"><img style='float:left;' src='images/error_icon.jpg'/><div class="msg" style='width:470px; padding-top:3px; padding-left:3px; float:left;'></div><div style='clear:both;'></div></div>
		</form>
		&copy; <?=date('Y')?>, Copyright Travellers Auto Barn, All rights reserved.
		<script type="text/html" id="html-insurance-options-row">
			<option value='%name' %checked>%name <?=$CDV->currency()?>$%fees Daily</option>
		</script>
		<script type="text/javascript">
			OnRequest.data.carsizeid=<?=$_GET['carsizeid']?>;
			<?=$start_js?>
		</script>
	</body>
</html>
