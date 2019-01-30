<?php
ob_start();
?>
Thanks for booking with Travellers Autobarn
PLEASE PRINT THIS PAGE FOR FUTURE REFERENCE
Agent Information 
Booking Agency:	<?=$agent_obj[0]['agency']?>   <?=$agent_obj[0]['agentbranch']?> 
Corporate Rate ID:	<?=$agent_obj[0]['agentcode']?> 
Agent Email:	<?=$cookie['AgentEmail']?> 
Customer Information
Name: 	<?=$cookie['firstname']?> <?=$cookie['lastname']?> 
Email Address: 	<?=$cookie['CustomerEmail']?> 
Confirmation Number:U-<?=$cookie['ReservationNo']?> 
Vehicle Category:	<?=$cost_obj['car']['vehiclecategory']?> 
PICK-UP DETAILS	
Pickup Location: 	<?=$cookie['PickupLocationName']?> 
<?=$pickup_address?> 
Pickup Date:	<?=$cookie['PickupDay']?>/<?=$cookie['PickupMonth']?>/<?=$cookie['PickupYear']?> 
Pickup Time:	10:00
DROP-OFF DETAILS
Dropoff Location: 	<?=$cookie['DropoffLocationName']?> 
<?=$dropoff_address?> 
Dropoff Date:	<?=$cookie['DropoffDay']?>/<?=$cookie['DropoffMonth']?>/<?=$cookie['DropoffYear']?> 
Dropoff Time:	15:00

Voucher/Folder Number: <?=$cookie['ReferenceNo']?> 
HERE IS THE PRICE	
---- Rental For Period ( Inc GST ) ---- 	
Days 	$<?=$cost_obj['car']['totrate']?>	<?=$cost_obj['car']['numofdays']?> Days @ $<?=$cost_obj['car']['avgrate']?> 
<?=$cost_obj['insurance']['name']?> 	$<?=$cost_obj['insurance']['displaytotal']?>	<?=$cost_obj['insurance']['displaytype']?> at $<?=$cost_obj['insurance']['displaydaily']?> 
<?=$save_mandatory_fees_email_txt?> 
<?=$save_discount_email_txt?> 
Total (Inc. GST)	<?=$cost_obj['total']?> 

<?=$bond_txt?>
<?php
return ob_get_clean();