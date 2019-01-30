<?php

class ViewBookingConfirmation
{
	public function email_cancelled_html(
		$agent_obj,$cookie,$cost_obj,
		$dropoff_address,$pickup_address
	){
		return require __DIR__.'/../template/booking-confirmation-email-cancelled-html.php';
	}

	public function email_cancelled_txt(
		$agent_obj,$cookie,$cost_obj,
		$dropoff_address,$pickup_address
	){
		return require __DIR__.'/../template/booking-confirmation-email-cancelled-txt.php';
	}

	public function email_html(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_email_html,$save_mandatory_fees_email_html,
		$dropoff_address,$pickup_address,$bond_html
	){
		return require __DIR__.'/../template/booking-confirmation-email-html.php';
	}

	public function email_txt(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_email_txt,$save_mandatory_fees_email_txt,
		$dropoff_address,$pickup_address,$bond_html
	){
		$mail=new PHPMailer();
		$mail->msgHTML($bond_html,'',true);
		$bond_txt=$mail->AltBody;
		return require __DIR__.'/../template/booking-confirmation-email-txt.php';
	}
	
	public function screen_cancelled(
		$agent_obj,$cookie,$cost_obj,
		$dropoff_address,$pickup_address
	){
		return require __DIR__.'/../template/booking-confirmation-screen-cancelled.php';
	}

	public function screen_email_sent(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_screen_html,$save_mandatory_fees_screen_html,
		$dropoff_address,$pickup_address,$bond_html
	){
		return require __DIR__.'/../template/booking-confirmation-screen-email-sent.php';
	}

	public function screen(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_screen_html,$save_mandatory_fees_screen_html,
		$dropoff_address,$pickup_address,$bond_html
	){
		return require __DIR__.'/../template/booking-confirmation-screen.php';
	}

	public function email_booking_html(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_email_html,$save_mandatory_fees_email_html,
		$dropoff_address,$pickup_address,$bond_html,$CDV
	)
	{
		return require __DIR__.'/../template/booking-confirmation-confirmation-email-html.php';
	}

	public function email_booking_txt(
		$agent_obj,$cookie,$cost_obj,
		$save_discount_email_txt,$save_mandatory_fees_email_txt,
		$dropoff_address,$pickup_address,$bond_html,$CDV
	)
	{
		$mail=new PHPMailer();
		$mail->msgHTML($bond_html,'',true);
		$bond_txt=$mail->AltBody;
		return require __DIR__.'/../template/booking-confirmation-confirmation-email-txt.php';
	}

	public function error($message){
		return require __DIR__.'/../template/booking-confirmation-error.php';
	}


}
/*
error_reporting(E_ALL);
ini_set('display_errors',false);
set_error_handler('error_handler');
function error_handler($no, $str = '', $file = '', $line = 0){
	echo "\n\n";
	var_dump($str,$file,$line);die();
}
function h($str){
	return "###{$str}###";
}

$agent_obj=array(
	0=>array(
		'agency'=>h('agency'),
		'agentbranch'=>h('agentbranch'),
	),
);
$cookie=array(
	'ReferenceNo'=>h('ReferenceNo'),
	'AgentEmail'=>h('AgentEmail'),
	'firstname'=>h('firstname'),
	'lastname'=>h('lastname'),
	'CustomerEmail'=>h('CustomerEmail'),
	'ReservationNo'=>h('ReservationNo'),
	'PickupLocationName'=>h('PickupLocationName'),
	'PickupDay'=>h('PickupDay'),
	'PickupMonth'=>h('PickupMonth'),
	'PickupYear'=>h('PickupYear'),
	'DropoffLocationName'=>h('DropoffLocationName'),
	'DropoffDay'=>h('DropoffDay'),
	'DropoffMonth'=>h('DropoffMonth'),
	'DropoffYear'=>h('DropoffYear'),
);
$pickup_address=h('pickup_address');
$dropoff_address=h('dropoff_address');
$cost_obj=array(
	'car'=>array(
		'vehiclecategory'=>h('car/vehiclecategory'),
		'imagename'=>h('car/imagename'),
		'totrate'=>h('car/totrate'),
		'numofdays'=>h('car/numofdays'),
		'avgrate'=>h('car/avgrate'),
	),
	'insurance'=>array(
		'name'=>h('insurance/name'),
		'displaytotal'=>h('insurance/displaytotal'),
		'displaytype'=>h('insurance/displaytype'),
		'displaydaily'=>h('insurance/displaydaily'),
	),
	'total'=>h('total'),
);
$save_discount_screen_html='<tr><td>'.h('save_discount_screen_html').'</td></tr>';
$save_mandatory_fees_screen_html='<tr><td>'.h('save_mandatory_fees_screen_html').'</td></tr>';
$save_discount_screen_txt=h('save_discount_screen_txt');
$save_mandatory_fees_screen_txt=h('save_mandatory_fees_screen_txt');
$bond_html=h('bond_html');
require 'PHPMailer.php';
$a=new ViewBookingConfirmation();
file_put_contents('screen.html',$a->screen($agent_obj,$cookie,$cost_obj,$save_discount_screen_html,$save_mandatory_fees_screen_html,$dropoff_address,$pickup_address,$bond_html));
file_put_contents('screen_email_sent.html',$a->screen_email_sent($agent_obj,$cookie,$cost_obj,$save_discount_screen_html,$save_mandatory_fees_screen_html,$dropoff_address,$pickup_address,$bond_html));
file_put_contents('screen_cancelled.html',$a->screen_cancelled($agent_obj,$cookie,$cost_obj,$dropoff_address,$pickup_address));
file_put_contents('email_txt.html',$a->email_txt($agent_obj,$cookie,$cost_obj,$save_discount_screen_txt,$save_mandatory_fees_screen_txt,$dropoff_address,$pickup_address,$bond_html));
file_put_contents('email_html.html',$a->email_html($agent_obj,$cookie,$cost_obj,$save_discount_screen_html,$save_mandatory_fees_screen_html,$dropoff_address,$pickup_address,$bond_html));
file_put_contents('email_cancelled_txt.html',$a->email_cancelled_txt($agent_obj,$cookie,$cost_obj,$dropoff_address,$pickup_address));
file_put_contents('email_cancelled_html.html',$a->email_cancelled_html($agent_obj,$cookie,$cost_obj,$dropoff_address,$pickup_address));
*/