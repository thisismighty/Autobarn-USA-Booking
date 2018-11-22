<?php

class DataUSP
{
	public static $country='AU';
	
	protected $_unique=array(
		'AU'=>array(
			'default'=>'Unlimited km 
&middot; Caravan Park Discount 
&middot; 24/7 Roadside Assistance 
&middot; Access to Free Campgrounds
&middot; Rental available to all age groups: 18 to 75',
		),
		'NZ'=>array(
			'default'=>'Unlimited km
&middot; 24/7 Roadside Assistance
&middot; Rental available to all age groups: 18 to 80
&middot; Portable Toilet option
&middot; Self-contained option
&middot; Free Road Atlas',
			4=>'Unlimited km
&middot; 24/7 Roadside Assistance
&middot; Rental available to all age groups: 18 to 75
&middot; Largest 2-berth bed
&middot; Free Road Atlas',
			7=>'Unlimited km
&middot; 24/7 Roadside Assistance
&middot; Rental available to all age groups: 18 to 80
&middot; Portable Toilet option
&middot; Self-contained option
&middot; Free Road Atlas',
			8=>'Unlimited km
&middot; 24/7 Roadside Assistance
&middot; Rental available to all age groups: 18 to 80
&middot; Portable Toilet option
&middot; Self-contained option
&middot; Free Road Atlas',
			9=>'Unlimited km
&middot; 24/7 Roadside Assistance
&middot; Rental available to all age groups: 18 to 80
&middot; Seats 2 to 7 people
&middot; Optional Tent for camping
&middot; Free Road Atlas',
		),
        'US'=>array(
            'default'=>'Unlimited mi 
&middot; 24/7 Roadside Assistance 
&middot; Rental available to all age groups: 21 to 75',
        ),
	);
	
	public function get(){
		return $this->_unique[$this::$country];
	}

	public function get_one($car_size_id)
	{
		if(!isset($this->_unique[$this::$country][$car_size_id])){
			return $this->_unique[$this::$country]['default'];
		}
		return $this->_unique[$this::$country][$car_size_id];
	}

}

