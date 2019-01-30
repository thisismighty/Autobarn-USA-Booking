<?php
ob_start();
?>
This is an email confirmation for your booking
PLEASE PRINT THIS PAGE FOR FUTURE REFERENCE
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


HERE IS THE PRICE
---- Rental For Period ( Inc GST ) ---
Days 	$<?=$cost_obj['car']['totrate']?>	<?=$cost_obj['car']['numofdays']?> Days @ $<?=$cost_obj['car']['avgrate']?>
<?=$cost_obj['insurance']['name']?> 	$<?=$cost_obj['insurance']['displaytotal']?>	<?=$cost_obj['insurance']['displaytype']?> at $<?=$cost_obj['insurance']['displaydaily']?>
<?=$save_mandatory_fees_email_txt?>
<?=$save_discount_email_txt?>
Total (Inc. GST)	<?=$cost_obj['total']?>

<?=$bond_txt?>
<?php
return ob_get_clean();