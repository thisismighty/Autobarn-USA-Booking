<?php

class DataConfirmation
{
	public static $country='AU';
	protected static $_FALLBACK=array(
		'AU'=>'
<!-- backup text -->
<p>
	<b>BOND:</b><br />
	For your bond we require a valid Visa or Mastercard Credit Card  - should you not have your own Credit Card please contact us so that we can forward to you our Credit Card Authorisation Form. Please be aware that Pre-paid credit cards - also called Cash Cards - can not be used for bonds.</p>
<p>
	<strong>EXTRA DRIVERS:</strong><br />
	Please be aware that all drivers need to sign the rental agreement - without signing the rental agreement no extra drivers are allowed to drive the vehicle. A $/3 day extra driver fee applies - capped at $75/rental/driver.</p>
<p>
	<strong>CREDIT CARD PAYMENT:</strong><br />
	Please be advised that a 2.2% credit card fee applies to all Mastercard/Visa card payments or overseas debit cards. Any payments via American Express apply a 5% credit card fee.</p>
<p>
	<b>OPENING TIMES FOR PICK-UPS/DROP-OFFS:</b><br />
	Monday - Friday: 9 am - 4:00 pm<br />
	Saturday: 9 am - 12:00 pm<br /> </p>
<p>
	
<b>HOW TO GET TO OUR BRANCHES</b><br />
	For direction to our branches please 
<a href="http://www.travellers-autobarn.com.au/campervan-rental-australia/">click here</a>
<br /></p>
<p>
	<b>CANCELLATION POLICY:</b><br />
	Within 28 days of hire - $200<br />
	Within 7 days of hire - 50%<br />
	Less than 24hours - 100%<br />
	<br />
	<strong>TERMS & CONDITIONS:</strong><br />
	Please see our Terms & Conditions  <a href="http://www.travellers-autobarn.com.au/RCM/tcoz.pdf">click here!</a></p>
<p>
	Phone the rental depot to discuss your pick up. Sometimes there can be many people picking up at once, which results in delays. If you are flexible, ask them about picking up at the least busy part of the day. A quick call to the depot to discuss your pick up time could get you on the road faster.</p>
<p>
	Thank you again for your reservation and we look forward to looking after your rental requirements. We wish you safe travels.</p>
',
		'NZ'=>'
<!-- backup text -->
<h3>NEW ZEALAND PICK-UP / DROP-OFF LOCATIONS</h3>

<h4>TAB HITOP CAMPERVAN / KUGA CAMPERVAN LOCATIONS - 0800 348 348</h4>

<br>IMPORTANT - if you have booked a TAB Hitop Campervan or TAB Kuga Campervan please visit our <a href="http://www.travellers-autobarn.co.nz/campervan-hire-new-zealand/campervan-rental-new-zealand/"> website </a> for the pick-up address closer to your pick-up date.


<b>TRAVELLERS AUTOBARN PICK-UP TIMES</b>
<br>Monday - Friday: 9 am to 4:00 pm <br>
Saturdays: 9 am to 12:00 pm<br> 

<BR><b>TRAVELLERS AUTOBARN DROP-OFF TIMES</b>
<br>Monday - Friday: 9 am to 3:00 pm <br>
Saturdays: 9 am to 12:30 pm <br>

Please note between the 1st of May to 31st of August our opening hours are 9 am to 4 pm and we are closed on Saturdays.<br><br>

<h4>ESCAPE CAMPER LOCATIONS - 0800 216 171</h4>
<b>ESCAPE CAMPER AUCKLAND PICK UP/DROP OFF <b>
<br>61 The Strand, Parnell<br>Auckland CBD<br>
<BR>
<b>ESCAPE CAMPER CHRISTCHURCH PICK UP</b>
<br>15 Kingsley Street
<br>Sydenham Christchurch<br>
<BR><b>CHRISTCHURCH DROP OFF</b>
<br>15 Kingsley Street
<br>Sydenham Christchurch<br><br>

<b>ESCAPE CAMPER PICK-UP TIMES</b>
<br>Monday - Friday: 9 am to 4:00 pm (late penalty of $120 applies for customers arriving after 4 pm)<br>
Saturdays: 10 am to 2:00 pm (late penalty of $120 applies for customers arriving after 2 pm)<br> 

<BR><b>ESCAPE CAMPER DROP OFF TIMES</b>
<br>Monday - Friday: 9 am to 2:00 pm <br>
Saturdays: 10 am to 2:00 pm<br>


<h4>Other Important Information</h4>
<b>BOND/LICENCE:</b>
<br> For your bond we require a valid Visa or Mastercard Credit Card. An international driving license is required & to drive any of the Happy Campers (Happy Campers/Happy Camper Deluxe/Happy Kuga Camper/Happy Sleeper) you must have held a license for at least 1 year. You only require a valid international driving license for Escape Campers.
<br>
<br>
<p>
<p><b>CANCELLATION POLICY:</b>
<br>Within 28 days of hire - $200
<br>Within 7 days of hire - 50%
<br>Less than 24hours - 100%
<br><br>
<b> TERMS & CONDITIONS </b><br><br>
Please read our Terms & Conditions - you can either open the attachment or download our Terms & Conditions by <a href="http://www.travellers-autobarn.com.au/RCM/tcnz.pdf">clicking here!</a>
<br>
<p>Thank you again for your reservation and we look forward 
to looking after your rental requirements. We wish you safe travels.
<br>
',
	);
	
	protected static $_BASE_URL=array(
		'AU'=>'https://secure20.rentalcarmanager.com.au/db/AuAutoBarn191/EmailConfirmation%d.txt',
		'NZ'=>'https://secure.rentalcarmanager.com.au/db/NZAutobarn68/EmailConfirmation%d.txt',
	);
	protected static $_DEFAULT_URL=array(
		'AU'=>'https://secure20.rentalcarmanager.com.au/db/AuAutoBarn191/EmailConfirmationAgent.txt',
		'NZ'=>'https://secure.rentalcarmanager.com.au/db/NZAutobarn68/EmailConfirmationAgent.txt',
	);
	
	public static function get_fallback()
	{
		return static::$_FALLBACK[static::$country];
	}

	public static function get_default()
	{
		$try=@file_get_contents(static::$_DEFAULT_URL[static::$country],false,stream_context_create(array(
			'ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
			),
		)));
		if($try!==false&&trim($try)!=''){
			return $try;
		}
		return static::get_fallback();
	}
	
	public static function get_by_location_id($id)
	{
		$try=@file_get_contents(sprintf(static::$_BASE_URL[static::$country],$id),false,stream_context_create(array(
			'ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
			),
		)));
		if($try!==false&&trim($try)!=''){
			return $try;
		}
		return static::get_default();
	}
}
