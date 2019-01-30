<?php

class ControllerOnRequest
{
	public static $email_receipient='fulvio@em.com.au';
	
	public function post($post,$cookie,$get,$email_subject)
	{
		$validate=$this->validate($post, $cookie, $get);
		if(is_array($validate)){
			return $validate;
		}
		if(is_null($validate)){
			return array();
		}
		$html=$this->view_html($post,$cookie,$get);
		if(!$this->email(
			$post,$cookie,$get,$email_subject,
			$html,
			$this->view_txt($html)
		)){
			return array('form'=>'There was an error emailing your form.');
		}
		return true;
	}
	public function view_html($post,$cookie,$get)
	{
		$pickup_date=date('j F Y',strtotime("{$cookie['PickupYear']}-{$cookie['PickupMonth']}-{$cookie['PickupDay']}"));
		$dropoff_date=date('j F Y',strtotime("{$cookie['DropoffYear']}-{$cookie['DropoffMonth']}-{$cookie['DropoffDay']}"));
		foreach(array_keys($post) as $k){
			$post[$k]=htmlentities(strip_tags($post[$k]));
		}
		foreach(array_keys($cookie) as $k){
			$cookie[$k]=htmlentities(strip_tags($cookie[$k]));
		}
		foreach(array_keys($get) as $k){
			$get[$k]=htmlentities(strip_tags($get[$k]));
		}
		return <<<EOT
<p>Hi valued partner,</p>
<p>Please see below the details of your booking request - please note at this
	stage this is only a REQUEST and we will get back to you within 24 to 48 hours:</p>
<p>
	<strong>PICK UP:</strong> {$cookie['PickupLocationName']}, {$pickup_date}<br/>
	<strong>DROP OFF:</strong> {$cookie['DropoffLocationName']}, {$dropoff_date}<br/>
	<strong>VEHICLE:</strong> {$get['categoryfriendlydescription']}<br/>
	<strong>BOND:</strong> {$post['excess']}<br/>
	<strong>AGENT CODE:</strong> {$cookie['AgencyCode']}<br/>
	<strong>AGENT NAME:</strong> {$cookie['AgencyName']}<br/>
	<strong>AGENT EMAIL:</strong> {$post['AgentEmail']}<br/>
	<strong>NOTES:</strong> {$post['notes']}
</p>
<p>Thanks,</p>

EOT;
	}
	public function view_txt($html)
	{
		return strip_tags($html);
	}

	public function validate($post,$cookie,$get)
	{
		if(!isset($get['carsizeid'])||!is_numeric($get['carsizeid'])){
			return array('request'=>'Vehicle size not found.');
		}
		if(!isset($get['categoryfriendlydescription'])||$get['categoryfriendlydescription']==''){
			return array('request'=>'Category not found.');
		}
		foreach(explode(',','CategoryTypeInfoID,PickupTime,ReturnTime,Age,AgentEmail,AgencyCode,AgencyName,'
			.'PickupLocationID,DropoffLocationID,PickupLocationName,DropoffLocationName,'
			.'PickupDay,PickupMonth,PickupYear,DropoffDay,DropoffMonth,DropoffYear,'
			.'PickupTime,Age') as $field){
			if(!isset($cookie[$field])){
				return array('request'=>$field.' not found.');
			}
		}
		if(empty($post)){
			return null;
		}
		if($post['AgentEmail']==''||!filter_var($post['AgentEmail'], FILTER_VALIDATE_EMAIL)){
			return array('AgentEmail'=>'Please enter a valid email address.');
		}
		return true;
	}
	public function email($post,$cookie,$get,$email_subject,$html,$txt)
	{
		$EMM=new EMMail();
		$try=$EMM->send_email(
			$this::$email_receipient,$email_subject,$html,$txt,
			'Travellers Auto Barn <reservations@travellers-autobarn.com.au>',$post['AgentEmail']
		);
		if(!$try){
			return false;
		}
		$EMM=new EMMail();
		return $EMM->send_email(
			$post['AgentEmail'],$email_subject,$html,$txt,
			$this::$email_receipient,$this::$email_receipient
		);
	}

}
