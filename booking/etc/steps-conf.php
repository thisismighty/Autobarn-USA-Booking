<?php
define('DEMO',FALSE);

ViewCSS::settings(__DIR__.'/../bin/css/','bin/css/',array(
	'tablet'=>'(min-width:900px) and (max-width:1059px)',
	'mobile'=>'(max-width:899px)',
));
ViewJS::settings(__DIR__.'/../bin/js/','bin/js/');

	DataHubspot::$LogObj=new EMLog(__DIR__.'/../../../hubspot.log');
	if($_SERVER['HTTP_HOST']=='www.staging.travellers-autobarnrv.com'||$_SERVER['HTTP_HOST']=='staging.travellers-autobarnrv.com'){
		DataUSP::$country=DataStep3::$country=DataStep4::$country=DataStep6::$country=ControllerDefaultValues::$country='US';
		DataStep3::$pop_url='http://www.staging.travellers-autobarnrv.com/ajax/rcm-popups.php';
		DataStep4::$tc_url='https://www.staging.travellers-autobarnrv.com/campervan-hire-australia/terms-and-conditions/';
		DataMostPopular::$pop_url='https://www.staging.travellers-autobarnrv.com/ajax/most-popular.php';
		if(defined('DEMO')&&DEMO){
			ControllerSourceSite::api_url_set('https://demo.rentalcarmanager.com/api/3.1/main/');
		}else{
			ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com/api/3.2/main/dHJhdmVsbGVycy1hdXRvYmFybnJ2LmNvbS8gVXNBdXRvQmFybjQ2Nw==');
		}
	}else if($_SERVER['HTTP_HOST']=='www.travellers-autobarnrv.com'||$_SERVER['HTTP_HOST']=='travellers-autobarnrv.com'){
		DataUSP::$country=DataStep3::$country=DataStep4::$country=DataStep6::$country=ControllerDefaultValues::$country='US';
		DataStep3::$pop_url='http://www.travellers-autobarnrv.com/ajax/rcm-popups.php';
		DataStep4::$tc_url='https://www.travellers-autobarnrv.com/campervan-hire-australia/terms-and-conditions/';
		DataMostPopular::$pop_url='https://www.travellers-autobarnrv.com/ajax/most-popular.php';
		if(defined('DEMO')&&DEMO){
			ControllerSourceSite::api_url_set('https://demo.rentalcarmanager.com/api/3.1/main/');
		}else{
			ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com/api/3.2/main/dHJhdmVsbGVycy1hdXRvYmFybnJ2LmNvbS8gVXNBdXRvQmFybjQ2Nw==');
		}
	}elseif($_SERVER['HTTP_HOST']=='travellers-autobarn.co.nz'||$_SERVER['HTTP_HOST']=='www.travellers-autobarn.co.nz'){
		DataUSP::$country=DataStep3::$country=DataStep4::$country=DataStep6::$country=ControllerDefaultValues::$country='NZ';
		DataStep3::$pop_url='http://travellers-autobarn.co.nz/ajax/rcm-popups.php';
		DataStep4::$tc_url='https://www.travellers-autobarn.co.nz/our-campervans-and-cars/terms-and-conditions/';
		DataMostPopular::$pop_url='https://www.travellers-autobarn.co.nz/ajax/most-popular.php';
		DataHubspot::$hubspot_url='https://forms.hubspot.com/uploads/form/v2/3435451/c0dd6427-88f8-452d-80b5-cdf457fbe0cc';
		DataHubspot::$page_name='API (Online Booking NZ)';
		if(defined('DEMO')&&DEMO){
			ControllerSourceSite::api_url_set('https://demo.rentalcarmanager.com/api/3.0/main');
		}else{
			ControllerSourceSite::api_url_set('https://secure.rentalcarmanager.com.au/api/3.0/main');
		}
	}
