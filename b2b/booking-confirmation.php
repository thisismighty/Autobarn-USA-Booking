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

die($find['screen']);
