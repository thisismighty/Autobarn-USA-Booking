<?php

class ControllerDefaultValues
{
	public static $country='AU';
	
	protected static $_analytics_referrer=array(
		'au'=>'1',
		'fr'=>'4',
		'nz'=>'5',
		'it'=>'14',
		'de'=>'12',
		'nl'=>'13',
		'us'=>'',
	);

	protected $_analytics_currency=array(
		'AU'=>'AUD',
		'NZ'=>'NZD',
		'US'=>'USD',
	);
	
	protected $_data=array(
		#step1-step2
		'_server_time'=>0,
		'country'=>'AU',
		'referrer'=>'au',
		'PickupLocationID'=>1,
		'DropOffLocationID'=>1,
		'PickupLocation_name'=>'Los Angeles',
		'DropOffLocation_name'=>'Los Angeles',
		'PickupDateAlt'=>'',
		'PickupDate'=>'',
		'PickupTime'=>'13:00',
		'ReturnDateAlt'=>'',
		'ReturnDate'=>'',
		'ReturnTime'=>'10:00',
		'CategoryTypeID'=>'11',
		'CategoryType_name'=>'Campervan',
		'CategoryType_vehicledescriptionurl'=>'',
		'CategoryType_imageurl'=>'',
		'price_table_html'=>'',
		'Age'=>'4',
		'DriverAge'=>'4',
		'PromoCode'=>'',
		'Vehiclecategoryid'=>'19',
		#step2-step3
		'firstname'=>'',
		'lastname'=>'',
		'email'=>'',
		'country_code'=>'',
		'phone'=>'',
		'dob'=>'',
		'license'=>'',
		'issuedin'=>'',
		'expire'=>'',
		'address'=>'',
		'city'=>'',
		'postcode'=>'',
		'txtState'=>'',
		'areaofuse'=>'',
		'ddlTransmission'=>'',
		'txtCollectionPoint'=>'',
		'txtFlightNo'=>'',
		'notraveling'=>'',
		'valoldcustomer'=>'',
		'valquote'=>'',
		'valbooking'=>'',
		'optional_extras_json'=>'',
		'km_charges_json'=>'',
		'CustomerData'=>'',
		'ReservationRef'=>'',
		'ReservationNo'=>'',
		'BookingType'=>2,
		'total_price'=>0,
		'total_gst'=>0,
		'total_deposit'=>0,
		'daily_rate_json'=>'',
		'extra_fees_json'=>'',
		'mandatory_fees_json'=>'',
		'discount_json'=>'',
		'insurance_json'=>'',
		'insurance_json_2'=>'',
		'most_popular'=>'',
		'car_availability'=>'',
		'DriversLicence'=>'',
		'bookmode'=>'',
	);
	
	public function __construct()
	{
		$this->_data['_server_time']=round(microtime(true)*10000);
		$this->_data['PickupDate']=date('d/m/Y',strtotime('+3 months'));
		$this->_data['ReturnDate']=date('d/m/Y',strtotime('+4 months'));
		$MP=new DataMostPopular();
		$this->_data['most_popular']=$MP->url();
		
		if($this::$country=='NZ'){
			$this->_data['CategoryTypeID']=1;
			$this->_data['PickupLocationID']=1;
			$this->_data['DropOffLocationID']=1;
			$this->_data['referrer']='nz';
			$this->_data['country']='NZ';
		}
        if($this::$country=='US'){
            $this->_data['CategoryTypeID']=1;
            $this->_data['PickupLocationID']=1;
            $this->_data['DropOffLocationID']=1;
            $this->_data['referrer']='us';
            $this->_data['country']='US';
        }
	}
	
	protected function _join($_session,$_post,array $variables)
	{
		foreach($variables as $variable){
			if(isset($_post[$variable])){
				$_session[$variable]=$_post[$variable];
				continue;
			}
			if(!isset($_session[$variable])){
				$_session[$variable]=$this->_data[$variable];
				continue;
			}
		}
		foreach(array_keys($_session) as $validation){
			if(!isset($this->_data[$validation])){
				unset($_session[$validation]);
			}
		}
		return $_session;
	}

	protected function _format_dates($try)
	{
		foreach(explode(',','PickupDateAlt,PickupDate,ReturnDateAlt,ReturnDate') as $convert){
			if(!isset($try[$convert])){
				continue;
			}
			$try[$convert.'_formatted']=date('l d M Y',strtotime(join('-',array_reverse(explode('/',$try[$convert])))));
		}
		return $try;
	}
	
	public function step2($_session,$_post)
	{
		$try=$this->_join(
			$_session,
			$_post,
			explode(
				',',
				'_server_time,country,referrer,PickupLocationID,DropOffLocationID,PickupDateAlt,PickupDate,PickupTime,ReturnDateAlt,ReturnDate,ReturnTime,CategoryTypeID,Age,PromoCode,'
				.'PickupLocation_name,DropOffLocation_name,CategoryType_name,CategoryType_vehicledescriptionurl,CategoryType_imageurl,price_table_html,most_popular,car_availability,DriversLicence'
			)
		);
		return $this->_format_dates($try);
	}
	
	public function step3($_session,$_post)
	{
		$try=$this->_join(
			$_session,
			$_post,
			explode(
				',',
				'referrer,country,PickupLocationID,PickupDateAlt,PickupDate,DropOffLocationID,ReturnDateAlt,ReturnDate,Vehiclecategoryid,Age,DriverAge,PromoCode,ReservationNo,'.
				'PickupLocation_name,DropOffLocation_name,CategoryType_name,CategoryType_vehicledescriptionurl,CategoryType_imageurl,price_table_html,most_popular,km_charges_json,car_availability,mandatory_fees_json,DriversLicence,bookmode'
			)
		);
		
		return $this->_format_dates($try);
	}

	public function step4($_session,$_post)
	{
		$try=$this->_join(
			$_session,
			$_post,
			explode(
				',',
				'referrer,Vehiclecategoryid,CategoryType_name,country,total_price,total_gst,daily_rate_json,extra_fees_json,mandatory_fees_json,discount_json,insurance_json,insurance_json_2,optional_extras_json,'.
				'CategoryType_imageurl,firstname,lastname,email,country_code,phone,notraveling,foundus,CustomerData,ReservationRef,ReservationNo,'.
				'total_deposit,most_popular,km_charges_json,price_table_html,car_availability,bookmode'
			)
		);
		
		return $this->_format_dates($try);
	}

	public function step5($_session,$_post)
	{
		$try=$this->_join(
			$_session,
			$_post,
			explode(
				',',
				'referrer,country,CategoryType_name,firstname,lastname,email,country_code,phone,notraveling,foundus,CustomerData,ReservationRef,ReservationNo,'.
				'total_deposit,car_availability'
			)
		);
		
		return $this->_format_dates($try);
	}
	
	public function anal($referrer)
	{
		if(!isset($this::$_analytics_referrer[$referrer])){
			if($this::$country=='NZ'){
				return $this::$_analytics_referrer['nz'];
			} elseif($this::$country=='US'){
                return $this::$_analytics_referrer['us'];
            }
			return $this::$_analytics_referrer['au'];
		}
		return $this::$_analytics_referrer[$referrer];
	}

	public function analytics_currency()
	{
		if(isset($this->_analytics_currency[$this::$country])){
			return $this->_analytics_currency[$this::$country];
		}
		return 'USD';
	}

	public static $get_to_us_url=array(
		'AU'=>'http://www.travellers-autobarn.com.au/campervan-rental-australia/',
		'NZ'=>'http://www.travellers-autobarn.co.nz/campervan-hire-new-zealand/campervan-rental-new-zealand/',
		'US'=>'http://autobarn-us.sanjayrnath.me/campervan-hire-new-zealand/',
	);
	public function get_to_us_url()
	{
		return $this::$get_to_us_url[$this::$country];
	}

	public static $remarketing_code = array(
		'AU' => '<!-- Google Code for Remarketing Tag -->
            <!--------------------------------------------------
            Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
            --------------------------------------------------->
            <script type="text/javascript">
                /* <![CDATA[ */
                var google_conversion_id = 1057219496;
                var google_custom_params = window.google_tag_params;
                var google_remarketing_only = true;
                /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
                <div style="display:inline;">
                    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1057219496/?guid=ON&amp;script=0"/>
                </div>
            </noscript>',
		'NZ' => ''
	);

	public function remarketing_code()
	{
		return $this::$remarketing_code[$this::$country];
	}

	public static $phone_numbers=array(
		'AU'=>'<tr>
		<td>Australia (Free call)</td>
		<td>1800 674 374</td>
	</tr>
	<tr>
		<td>New Zealand</td>
		<td>0800 348 348</td>
	</tr>',
		'NZ'=>'<tr>
		<td>New Zealand (Free call)</td>
		<td>0800 348 348</td>
	</tr>
	<tr>
		<td>Australia</td>
		<td>1800 674 374</td>
	</tr>'
	);
	public function phone_numbers()
	{
		return $this::$phone_numbers[$this::$country];
	}

	public static $flags=array(
		'AU'=>'<table class="flags">
	<tbody>
		<tr>
			<td>
				<a href="http://www.travellers-autobarn.de/" target="_blank" alt="German site">
					<img src="image/Flag-Germany.jpg" alt="German site">
				</a>
			</td>
			<td>
				<a href="http://www.travellers-autobarn.fr/" target="_blank" alt="French site">
					<img src="image/Flag-France.jpg" alt="French site">
				</a>
			</td>
			<td>
				<a href="http://www.travellers-autobarn.nl/" target="_blank" alt="Dutch site">
					<img src="image/Flag-Netherlands.jpg" alt="Dutch site">
				</a>
			</td>
			<td>
				<a href="http://www.travellers-autobarn.it/" target="_blank" alt="Italian site">
					<img src="image/Flag-Italy.jpg" alt="Italian site">
				</a>
			</td>
		</tr>
	</tbody>
</table>',
		'NZ'=>'',
        'US'=>'',
	);
	public function flags()
	{
		return $this::$flags[$this::$country];
	}

	public static $low_season=array(
		'AU'=>'<p>
	* During low season Melbourne (June 1 - August 31 each year) is only
	operating between 10 am to 4 pm Monday to Friday. Same counts for Darwin
	between December 15 to March 15 each year.
</p>',
		'NZ'=>'<p>
	* During low season (May 1 - August 31 each year) we are only operating between 10 am to 4 pm Monday to Friday.
</p>',
        'US'=>''
	);
	public function low_season()
	{
		return $this::$low_season[$this::$country];
	}
	
}
