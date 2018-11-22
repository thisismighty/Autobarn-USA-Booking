<?php

class DataHubspot
{
	public static	$hubspot_url	='https://forms.hubspot.com/uploads/form/v2/3390268/73134e3b-b6e4-4768-a5f8-01b7af6eeeb0';
	public static	$page_name		='API (Online Booking)';
	public static	$LogObj			=null;

	protected $_result	=null;
	protected $_info	=null;
	protected $_error	=null;
	protected $_errno	=null;

	public function step4($_cookie,$_server,$fields)
	{
		$fields=$this->_prepare_data($_cookie,$_server,$fields,'lead');
		$this->_curl_execute($this->_curl_handle($fields));
	}
	
	public function step6($_cookie,$_server,$fields)
	{
		$fields=$this->_prepare_data($_cookie,$_server,$fields,'customer');
		$this->_curl_execute($this->_curl_handle($fields));
	}
	
	protected function _prepare_data($_cookie,$_server,$fields,$lifecyclestage)
	{
		$fields['hs_context']=json_encode(array(
			'hutk'		=>isset($_cookie['hubspotutk'])?$_cookie['hubspotutk']:'',
			'ipAddress'	=>isset($_server['REMOTE_ADDR'])?$_server['REMOTE_ADDR']:'',
			'pageUrl'	=>(isset($_server['HTTPS'])?"https":"http")."://{$_server['HTTP_HOST']}{$_server['REQUEST_URI']}",
			'pageName'	=>$this::$page_name,
		));
		$fields['lifecyclestage']=$lifecyclestage;
		$fields['HS_pick_up_date']=$this->to_utc_timestamp($fields['PickupDate'],$fields['PickupTime']);
		$fields['HS_drop_off_date']=$this->to_utc_timestamp($fields['ReturnDate'],$fields['ReturnTime']);
		$fields['pick_up_location']=$fields['PickupLocation_name'];
		$fields['pick_up_date']=$fields['HS_pick_up_date'];
		$fields['drop_off_date']=$fields['HS_drop_off_date'];
		$fields['drop_off_location']=$fields['DropOffLocation_name'];
		$fields['number_of_adults']=$fields['notraveling'];
		static::$LogObj->log(
			__METHOD__.": posting this\n".
			print_r($fields,true)
		);
		return $fields;
	}
	
	public function to_utc_timestamp($date,$time)
	{
		$prev=date_default_timezone_get();
		date_default_timezone_set('UTC');
		$date=date_parse_from_format('d/m/Y H:i',"{$date} {$time}");
		if(!$date){
			date_default_timezone_set($prev);
			return false;
		}
		$ret=mktime(0, 0, 0, $date['month'], $date['day'], $date['year']);
		date_default_timezone_set($prev);
		return $ret*1000;
	}
	
	protected function _curl_handle($fields)
	{
		$ch=curl_init($this::$hubspot_url);
		curl_setopt_array($ch, array(
			CURLOPT_POST			=>true,
			CURLOPT_POSTFIELDS		=>http_build_query($fields),
			CURLOPT_HTTPHEADER		=>array(
				'Content-Type: application/x-www-form-urlencoded'
			),
			CURLOPT_RETURNTRANSFER	=>true,
			CURLINFO_HEADER_OUT		=>true,
			CURLOPT_TIMEOUT			=>10,
			CURLOPT_HEADER			=>true,
		));
		return $ch;
	}

	protected function _curl_execute($ch)
	{
		$this->_result=curl_exec($ch);
		$this->_info=curl_getinfo($ch);
		$this->_error=curl_error($ch);
		$this->_errno=curl_errno($ch);
		if($this->_result===false){
			static::$LogObj->log(
				__METHOD__.": curl call failed\n".
				print_r(array(
					'result'=>$this->_result,
					'info'=>$this->_info,
					'error'=>$this->_error,
					'errno'=>$this->_errno,
					),true)
			);
			return false;
		}
		static::$LogObj->log(
			__METHOD__.": curl call ok\n".
			print_r(array(
				'result'=>$this->_result,
				'info'=>$this->_info,
				),true)
		);
		return true;
	}
}

if(php_sapi_name()!='cli'){
	return;
}

$help=<<<EOT
Test the hubspot integration. Options are:

-h
	this help

-d [date and time]
	test the date and time to UTC timestamp, must be like '22/03/2018 10:00'
	be aware of how command line options work.


EOT
;

$opt=getopt('hd:');
if(isset($opt['h'])){
	fwrite(STDOUT,$help);
	die();
}
if(isset($opt['d'])){
	$A=new DataHubspot();
	list($date,$time)=explode(' ',$opt['d']);
	$z=$A->to_utc_timestamp($date, $time);
	var_dump(
		$z,
		date('Y-m-d H:i:s',$z/1000)
	);
	die();
}
fwrite(STDOUT,$help);
die();
