<?php
if(empty($_REQUEST))
	return;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('UTC'); //IMPORTANT for Hubspot timestamp format

function HS_Form_Submit($pageName,$Hubspot_Portal_ID,$formGuid,$PropertiesArray){

	if(isset($_COOKIE['hubspotutk'])){
		$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
	}else{
		$hubspotutk      = '';
	}
	
	$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
	$hs_context      = array(
		'hutk' => $hubspotutk,
		'ipAddress' => $ip_addr,
		'pageUrl' => (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
		'pageName' => $pageName
	);
	$hs_context_json = json_encode($hs_context);

	//Add the Hubspot data to array 
	$PropertiesArray['hs_context'] = $hs_context_json;
	$str_post = http_build_query($PropertiesArray);

	//replace the values in this URL with your portal ID and your form GUID
	$endpoint = 'https://forms.hubspot.com/uploads/form/v2/'.$Hubspot_Portal_ID.'/'.$formGuid;

	$ch = @curl_init();
	@curl_setopt($ch, CURLOPT_POST, true);
	@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
	@curl_setopt($ch, CURLOPT_URL, $endpoint);
	@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/x-www-form-urlencoded'
	));
	@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
	$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
	@curl_close($ch);

	if (substr($status_code, 0, 1) === '2') {
		//checks for 200 http code
		return true;
	}else{
		return false;
	}
}

function convert_value($carname){
	
	$value="";
	switch($carname){
		case "Stationwagon":
				$value="Station Wagon";
			break;
		case "Kuga Campervan":
				$value="Kuga Campervan";
			break;
		case "Hitop Campervan":
				$value="Hitop Campervan";
			break;
	}
	
	return $value;
}

function date_convert($date='01/01/2001'){	
	//Convert dates from d/m/y to Hubspot time stamp
	$originalDate = trim($date);
	// echo 'original: ' .$originalDate.'<br />';
	$newDate = DateTime::createFromFormat("d/m/Y", "$date", new DateTimeZone('UTC'));
	// echo 'after convert: ' .$newDate->format("d/m/Y") . "<br />";
	$date = $newDate;
	// echo 'with zero: ' .$date->format( "Y-m-d 00:00:00"). "<br />";
	// echo 'with time: ' .$date->format( "Y-m-d h:m:s") . '<br />';
	return $create_date = strtotime( $date->format( "Y-m-d 00:00:00") ) * 1000;
}

// 1) Add the data we want to push to HubSpot to the array below:
//add contact to Hubspot API - 
$Contact_Properties = array();
$Contact_Properties['email'] = $_REQUEST['email']; //Minimum Required

//Best to only add an item to the array if you have data for it. Ie. Wrap an if true condition around it. Posting blank data would wipe any existing data
$Contact_Properties['pick_up_location'] = $_REQUEST['pick_up_location'];  //Internal values set to actual names. https://www.evernote.com/l/Af_cQpB85StMKYoBEahltY0wNaaEuiH0upM
$Contact_Properties['pick_up_date'] = date_convert($_REQUEST['pick_up_date']); //UTC UNIX timestamp format https://developers.hubspot.com/docs/faq/how-should-timestamps-be-formatted-for-hubspots-apis
$Contact_Properties['drop_off_date'] = date_convert($_REQUEST['drop_off_date']); //UTC UNIX timestamp format
$Contact_Properties['drop_off_location'] = $_REQUEST['drop_off_location']; 

$Contact_Properties['vehicle_category'] = convert_value($_REQUEST['vehicle_category']); //insert vehicle type Kuga Campervan or Hitop Campervan

$Contact_Properties['phone'] = $_REQUEST['phone'];
$Contact_Properties['number_of_adults'] = $_REQUEST['number_of_adults'];
$Contact_Properties['lifecyclestage'] = $_REQUEST['lifecyclestage'];  // lead or customer (when payment is made push just their email and set this field to customer)
$Contact_Properties['firstname'] = $_REQUEST['firstname'];
$Contact_Properties['lastname'] = $_REQUEST['lastname'];
$Contact_Properties['total_price_rentals'] = $_REQUEST['total_price_rentals'];




// 2) Call function and Push data to Hubspot (USA)
$Request = HS_Form_Submit('API (Online Booking USA)','4939113','8b56ae6c-d432-4539-9939-aead7b6ef389',$Contact_Properties);

//See if 
if($Request){
   $response['result']=1;
}else{
   $response['result']=0;
}

echo json_encode($response);