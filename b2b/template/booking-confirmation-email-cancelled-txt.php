<?php
ob_start();
?>
This reservation was cancelled 	
This is a BOOKING CANCELLATION notification to inform you that the
following booking details are now cancelled. 	
Agent Information	
Booking Agency:	<?=$agent_obj[0]['agency']?>   <?=$agent_obj[0]['agentbranch']?>	
Voucher/Folder Number:	<?=$cookie['ReferenceNo']?>	
Agent Email: 	<?=$cookie['AgentEmail']?>	
Customer information	
Name: 	<?=$cookie['firstname']?> <?=$cookie['lastname']?>	
Email: 	<?=$cookie['CustomerEmail']?>	
Confirmation Number:U-<?=$cookie['ReservationNo']?>	
Vehicle Category:	<?=$cost_obj['car']['vehiclecategory']?>	
PICK-UP DETAILS	
Pick Location:	<?=$cookie['PickupLocationName']?>
<?=$pickup_address?>	
Phone:	1800 674 374	
Pick date :	<?=$cookie['PickupDay']?>/<?=$cookie['PickupMonth']?>/<?=$cookie['PickupYear']?>	
DROP-OFF DETAILS	
Drop Location:	<?=$cookie['DropoffLocationName']?>
<?=$dropoff_address?>	
Phone:	1800 674 374	
Drop date :	<?=$cookie['DropoffDay']?>/<?=$cookie['DropoffMonth']?>/<?=$cookie['DropoffYear']?>	
 	
	

Kind regards
Travellers Autobarn
<?php
return ob_get_clean();