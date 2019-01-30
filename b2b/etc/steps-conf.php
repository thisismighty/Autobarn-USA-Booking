<?php

if(gethostname()=='fulvios-sandbox'){
	EMDebug::$to_email=false;
	error_reporting(E_ALL);
	ini_set('display_errors',false);
	set_error_handler(array('EMDebug','error_handler'));
	set_exception_handler(array('EMDebug','exception_handler'));
	register_shutdown_function(array('EMDebug','shutdown_handler'));
	ControllerSourceSite::log_set(2);
	if($_SERVER['HTTP_HOST']=='www.travellers-autobarn.co.nz'||$_SERVER['HTTP_HOST']=='travellers-autobarn.co.nz'){
		DataConfirmation::$country=DataLocation::$country=ControllerDefaultValues::$country='NZ';
		ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.1/main');
	}else{
		ControllerSourceSite::api_url_set('https://secure20.rentalcarmanager.com.au/api/3.1/main');
	}
	DataBookingConfirmation::settings('bookingconfirmation','192.168.1.4','root','Chr1s123','travellersautobarnau');
	EMDailyLog::settings(__DIR__.'/../log/',strtotime('-3 month'));
	EMMail::settings_log(new EMDailyLog('email'));
	EMMail::settings_add(null, null, 'john@em.com.au');
	EMMail::settings_override('fulvio@em.com.au', 'fulvio@em.com.au','fulvio@em.com.au');
	ControllerDefaultValues::$wp_ajax_url=array(
		'AU'=>'http://tabau-fo.fo/ajax/b2b-popups.php?s={placeholder}',
		'NZ'=>'http://tabnz.fo/ajax/b2b-popups.php?s={placeholder}',
	);
}
elseif(gethostname()=='pingu') {
	EMDebug::$to_email			=	false;
	error_reporting(E_ALL);
	ini_set('display_errors',false);
	set_error_handler(array('EMDebug','error_handler'));
	set_exception_handler(array('EMDebug','exception_handler'));
	register_shutdown_function(array('EMDebug','shutdown_handler'));
	ControllerSourceSite::log_set(2);

	if( true ) { //$_SERVER['HTTP_HOST']=='www.travellers-autobarn.co.nz'||$_SERVER['HTTP_HOST']=='travellers-autobarn.co.nz'){
		DataConfirmation::$country=DataLocation::$country=ControllerDefaultValues::$country='NZ';
		ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.1/main');
	}else{
		ControllerSourceSite::api_url_set('https://secure20.rentalcarmanager.com.au/api/3.1/main');
	}

	DataBookingConfirmation::settings('bookingconfirmation','192.168.1.4','root','Chr1s123','travellersautobarnau');
	EMDailyLog::settings(__DIR__.'/../log/',strtotime('-3 month'));
	EMMail::settings_log(new EMDailyLog('email'));
	EMMail::settings_add(null, null, 'fulvio@em.com.au');
	ControllerDefaultValues::$wp_ajax_url=array(
		'AU'=>'http://tabau-fo.fo/ajax/b2b-popups.php?s={placeholder}',
		'NZ'=>'http://tabnz.fo/ajax/b2b-popups.php?s={placeholder}',
	);
	ControllerOnRequest::$email_receipient='reservations@travellers-autobarn.com';
}
elseif(gethostname()=='emidau'){
	EMDebug::$to_email=false;
	error_reporting(E_ALL);
	ini_set('display_errors',false);
	set_error_handler(array('EMDebug','error_handler'));
	set_exception_handler(array('EMDebug','exception_handler'));
	register_shutdown_function(array('EMDebug','shutdown_handler'));
	ControllerSourceSite::log_set(2);
	if($_SERVER['HTTP_HOST']=='tab-booking-nz.em.id.au'){
		DataConfirmation::$country=DataLocation::$country=ControllerDefaultValues::$country='NZ';
		DataBookingConfirmation::settings('bookingconfirmation','localhost','staging','fuse456','staging_autobarn_nz');
		ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.1/main');
	}else{
		DataBookingConfirmation::settings('bookingconfirmation','localhost','staging','fuse456','staging_autobarn_au');
		ControllerSourceSite::api_url_set('https://secure20.rentalcarmanager.com.au/api/3.1/main');
	}
	EMDailyLog::settings(__DIR__.'/../log/',strtotime('-3 month'));
	EMMail::settings_log(new EMDailyLog('email'));
	EMMail::settings_add(null, null, 'john@em.com.au');
	ControllerDefaultValues::$wp_ajax_url=array(
		'AU'=>'http://tab-booking.em.id.au/ajax/b2b-popups.php?s={placeholder}',
		'NZ'=>'http://tab-booking-nz.em.id.au/ajax/b2b-popups.php?s={placeholder}',
	);
	ControllerOnRequest::$email_receipient='reservations@travellers-autobarn.com';
}elseif(gethostname()=='sabre420.anchor.net.au'){
	EMDebug::$to_email='fulvio@em.com.au';
	error_reporting(E_ALL);
	ini_set('display_errors',false);
	set_error_handler(array('EMDebug','error_handler'));
	set_exception_handler(array('EMDebug','exception_handler'));
	register_shutdown_function(array('EMDebug','shutdown_handler'));
	ControllerSourceSite::log_set(2);
	if($_SERVER['HTTP_HOST']=='www.travellers-autobarn.co.nz'||$_SERVER['HTTP_HOST']=='travellers-autobarn.co.nz'){
		DataConfirmation::$country=DataLocation::$country=ControllerDefaultValues::$country='NZ';
		DataBookingConfirmation::settings('bookingconfirmation','localhost','autobarnnz_dbu','patron6boat3pivot','autobarnnz');
		ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.1/main');
	}else{
		DataBookingConfirmation::settings('bookingconfirmation','localhost','autobarnau_dbu','hang=sour3virtue','tabwp');
		ControllerSourceSite::api_url_set('https://secure20.rentalcarmanager.com.au/api/3.1/main');
	}
	EMDailyLog::settings(__DIR__.'/../log/',strtotime('-3 month'));
	EMMail::settings_log(new EMDailyLog('email'));
	EMMail::settings_add(null, null, 'fulvio@em.com.au');
	ControllerOnRequest::$email_receipient='reservations@travellers-autobarn.com';
}elseif(gethostname()=='viper230.anchor.net.au'){
	EMDebug::$to_email='fulvio@em.com.au';
	error_reporting(E_ALL);
	ini_set('display_errors',false);
	set_error_handler(array('EMDebug','error_handler'));
	set_exception_handler(array('EMDebug','exception_handler'));
	register_shutdown_function(array('EMDebug','shutdown_handler'));
	ControllerSourceSite::log_set(2);
	if($_SERVER['HTTP_HOST']=='www.travellers-autobarn.co.nz'||$_SERVER['HTTP_HOST']=='travellers-autobarn.co.nz'){
		DataConfirmation::$country=DataLocation::$country=ControllerDefaultValues::$country='NZ';
		DataBookingConfirmation::settings('bookingconfirmation','localhost','autobarnnz','zuuY3K7xqsBE3EhE','autobarnnz');
		ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.1/main');
	}else{
		DataBookingConfirmation::settings('bookingconfirmation','localhost','autobarnau','zF7J7Gl0RuJnjuN','autobarnau');
		ControllerSourceSite::api_url_set('https://secure20.rentalcarmanager.com.au/api/3.1/main');
	}
	EMDailyLog::settings(__DIR__.'/../log/',strtotime('-3 month'));
	EMMail::settings_log(new EMDailyLog('email'));
	EMMail::settings_add(null, null, 'fulvio@em.com.au');
	ControllerOnRequest::$email_receipient='reservations@travellers-autobarn.com';
}else{
	die('hostname unknown: '.gethostname());
}
