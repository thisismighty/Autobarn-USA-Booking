<?php
require 'bin/required.php';
require 'etc/steps-conf.php';

$VBC=new ViewBookingConfirmation();
if(!isset($_GET['va11'])||!isset($_GET['val22'])){
	die($VBC->error('Please enter a correct confirmation number'));
}

$DBC=new DataBookingConfirmation();
$find=$DBC->check($_GET['va11'], $_GET['val22']);
if(!$find){
	die($VBC->error(
		'To check details of your booking please email our Reservations Team directly '
		.'at <a href="mailto:reservations@travellers-autobarn.com">reservations@travellers-autobarn.com</a>.'
	));
}

$DL=new DataLocation();
$EMM=new EMMail();
$try=$EMM->send_email(
	array(
		$find['agentemail'],'Travellers Auto Barn <reservations@travellers-autobarn.com.au>',
	),$DL->email_cancelled_subject(),$find['email_cancelled_html'],$find['email_cancelled_txt'],
	'Travellers Auto Barn <reservations@travellers-autobarn.com>','Travellers Auto Barn <reservations@travellers-autobarn.com>'
);
if(!$try){
	die($VBC->error('Error sending email, please try again'));
}

die($find['screen_cancelled']);
