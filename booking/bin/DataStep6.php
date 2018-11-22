<?php

class DataStep6
{
	public static $country='AU';

	protected $_addresses=array(
		'AU'=>array(
			'Sydney'=>'1C McPherson St, Banksmeadow, NSW 2019',
			'Melbourne'=>'55 King Street, Airport West, VIC 3042',
			'Brisbane'=>'360 Nudgee Road, Hendra QLD 4011',
			'Cairns'=>'123 Bunda Street, Cairns, QLD 4870',
			'Perth'=>'16 Adrian Street, Welshpool, WA 6106',
			'Darwin'=>'19 Bishop Street, Woolner, Darwin, NT 0820',
		),
		'NZ'=>array(),
        'US'=>array()
	);
	public function address($location_name)
	{
		if(!isset($this->_addresses[$this::$country])){
			return false;
		}
		if(!isset($this->_addresses[$this::$country][$location_name])){
			return false;
		}
		return $this->_addresses[$this::$country][$location_name];
	}

	protected $_location_help=array(
		'AU'=>array(
			'Sydney'=>'entrance is opposite 16 McPherson St',
			'Melbourne'=>'',
			'Brisbane'=>'',
			'Cairns'=>'',
			'Perth'=>'',
			'Darwin'=>'',
		),
		'NZ'=>array(),
        'US'=>array()
	);
	public function location_help($location_name)
	{
		if(!isset($this->_location_help[$this::$country])){
			return false;
		}
		if(!isset($this->_location_help[$this::$country][$location_name])){
			return false;
		}
		return $this->_location_help[$this::$country][$location_name];
	}

	protected $_opening_times=array(
		'AU'=><<<EOT
<p>A copy of your booking voucher has been emailed to you.</p>
<h4>Opening times for pick-ups/Drop-offs:</h4>
<p>Monday - Friday: 9 am - 4:00 pm</p>
<p>Saturday: 9 am - 12:00 pm</p>
<p>NOTE: During low season Melbourne (June 1 - August 31 each year) is only
operating between 10 am to 4 pm Monday to Friday. Same counts for Darwin
between December 15 to March 15 each year.
<h4>How to get to us</h4>
<p>Please <a href="http://www.travellers-autobarn.com.au/campervan-rental-australia/">click here</a> for
directions to our branches from the airport or city center.</p>
EOT
		,
		'NZ'=><<<EOT
EOT
        ,
        'US'=><<<EOT
EOT
	);
	public function opening_times()
	{
		if(!isset($this->_opening_times[$this::$country])){
			return false;
		}
		return $this->_opening_times[$this::$country];
	}

	protected $_contact=array(
		'AU'=><<<EOT
<h4>Contact us</h4>
<table>
	<tr>
		<td>Australia (Free call)</td>
		<td>1800 674 374</td>
	</tr>
	<tr>
		<td>New Zealand</td>
		<td>09 8891 737</td>
	</tr>
	<tr>
		<td>United Kingdom</td>
		<td>020 3287 8375</td>
	</tr>
	<tr>
		<td>United States</td>
		<td>0213 438 9976</td>
	</tr>
	<tr>
		<td>Germany</td>
		<td>06103 3723 922</td>
	</tr>
	<tr>
		<td>International</td>
		<td>+61 2 9360 1500</td>
	</tr>
	<tr>
		<td><a href="skype:tab_bookings?call"><img
			src="/wp-content/themes/travellers-autobarn/assets/images/icons/skype.png">Skype</a></td>
		<td></td>
	</tr>
</table>
<table>
	<tr><td><a
		href="http://www.travellers-autobarn.de/"
		alt="German site"><img
			src="/wp-content/uploads/2014/03/Flag-Germany.jpg"
			alt="German site"/></a></td></tr>
	<tr><td><a
		href="http://www.travellers-autobarn.fr/"
		alt="French site"><img
			src="/wp-content/uploads/2014/03/Flag-France.jpg"
			alt="French site"/></a></td></tr>
	<tr><td><a
		href="http://www.travellers-autobarn.nl/"
		alt="Dutch site"><img
			src="/wp-content/uploads/2014/03/Flag-Netherlands.jpg"
			alt="Dutch site"/></a></td></tr>
	<tr><td><a
		href="http://www.travellers-autobarn.it/"
		alt="Italian site"><img
			src="/wp-content/uploads/2014/03/Flag-Italy.jpg"
			alt="Italian site"/></a></td></tr>
</table>
EOT
		,
		'NZ'=><<<EOT
EOT
        ,
        'US'=><<<EOT
EOT
	);
	public function contact()
	{
		if(!isset($this->_contact[$this::$country])){
			return false;
		}
		return $this->_contact[$this::$country];
	}
}
