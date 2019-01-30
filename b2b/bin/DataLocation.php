<?php

class DataLocation
{
	public static $country='AU';
	
	protected $_addresses=array(
		'AU'=>array(
			'Sydney'=>'1C McPherson St entrance is opposite 16 McPherson Banksmeadow',
			'Melbourne'=>'55 King Street Airport West',
			'Brisbane'=>'360 Nudgee Road Hendra',
			'Cairns'=>'123 Bunda Street Cairns',
			'Perth'=>'16 Adrian Street Welshpool',
			'Darwin'=>'13 Daly Street Darwin',
		),
		'NZ'=>array(
			'Auckland'=>'See Pickup Address Below',
			'Christchurch'=>'See Pickup Address Below',
		),
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

	protected $_email_subject=array(
		'AU'=>'Booking confirmation with Travellers Autobarn - Australia',
		'NZ'=>'Booking confirmation with Travellers Autobarn - New Zealand',
	);
	public function email_subject(){
		if(!isset($this->_email_subject[$this::$country])){
			return false;
		}
		return $this->_email_subject[$this::$country];
	}

	protected $_email_cancelled_subject=array(
		'AU'=>'Your booking with Travellers Autobarn - Australia was cancelled',
		'NZ'=>'Your booking with Travellers Autobarn - New Zealand was cancelled',
	);
	public function email_cancelled_subject(){
		if(!isset($this->_email_cancelled_subject[$this::$country])){
			return false;
		}
		return $this->_email_cancelled_subject[$this::$country];
	}
	
	protected $_email_confirmation_subject=array(
		'AU'=>'Thanks for booking with Travellers Autobarn - Australia',
		'NZ'=>'Thanks for booking with Travellers Autobarn - New Zealand',
	);
	public function email_confirmation_subject(){
		if(!isset($this->_email_confirmation_subject[$this::$country])){
			return false;
		}
		return $this->_email_confirmation_subject[$this::$country];
	}

}
