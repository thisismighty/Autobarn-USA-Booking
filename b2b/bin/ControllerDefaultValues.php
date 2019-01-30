<?php

class ControllerDefaultValues
{
	public static $country='AU';
	
	protected $_error='';

	protected $_data=array(
		'_error'				=>''
		,'PickupLocationID'		=>'Same'
		,'DropoffLocationID'	=>'12'
		,'PickupLocationName'	=>'Sydney'
		,'DropoffLocationName'	=>'Sydney'
		,'PickupTime'			=>'10:00'
		,'ReturnTime'			=>'10:00'
		,'PickupDay'			=>0
		,'PickupMonth'			=>0
		,'PickupYear'			=>0
		,'DropoffDay'			=>0
		,'DropoffMonth'			=>0
		,'DropoffYear'			=>0
		,'Age'					=>'1'
		,'PromoCode'			=>''
		,'AgencyCode'			=>''
		,'AgencyName'			=>''
		,'CarSizeID'			=>0
		,'CategoryTypeInfoID'	=>0
		,'InsuranceID'			=>0
		,'firstname'			=>''
		,'lastname'				=>''
		,'AgentEmail'			=>''
		,'CustomerEmail'		=>''
		,'Phone'				=>''
		,'NoTravelling'			=>''
		,'ReferenceNo'			=>''
		,'ReservationRef'		=>''
		,'ReservationNo'		=>''
		,'Cost_Object'			=>'[]'
		,'Agent_Object'			=>'[]'
	);
	
	public function __construct()
	{
		$this->_data['PickupDay']=date('d',strtotime('+3 months'));
		$this->_data['PickupMonth']=date('m',strtotime('+3 months'));
		$this->_data['PickupYear']=date('Y',strtotime('+3 months'));
		$this->_data['DropoffDay']=date('d',strtotime('+4 months'));
		$this->_data['DropoffMonth']=date('m',strtotime('+4 months'));
		$this->_data['DropoffYear']=date('Y',strtotime('+4 months'));
		
		if($this::$country=='NZ'){
			$this->_data['CategoryTypeID']=1;
			$this->_data['PickupLocationID']=1;
			$this->_data['DropoffLocationID']=1;
		}
	}
	
	public function validate($cookies)
	{
		foreach($this->_data as $field=>$value){
			if(!isset($cookies[$field])){
				return false;
			}
		}
		return true;
	}
	
	public function error()
	{
		return $this->_error;
	}

	public function extract_agent_obj($agent_obj)
	{
		$agent_obj=@json_decode($agent_obj,true);
		if(!$agent_obj){
			$this->_error='json';
			return false;
		}
		if(!isset($agent_obj[0])){
			$this->_error='array';
			return false;
		}
		foreach(explode(',','agency,agentbranch') as $field){
			if(!isset($agent_obj[0][$field])){
				$this->_error="missing {$field} field";
				return false;
			}
		}
		return $agent_obj;
	}

	public function extract_cost_obj($cost_obj)
	{
		$cost_obj=@json_decode($cost_obj,true);
		if(!$cost_obj){
			$this->_error='json';
			return false;
		}
		if(!isset($cost_obj['car'])){
			$this->_error='missing car field';
			return false;
		}
		foreach(explode(',','totrate,numofdays,avgrate,imagename,vehiclecategory,total') as $field){
			if(!isset($cost_obj['car'][$field])){
				$this->_error="missing car {$field} field";
				return false;
			}
		}
		$cost_obj['car']['totrate']=number_format($cost_obj['car']['totrate'],2);
		$cost_obj['car']['avgrate']=number_format($cost_obj['car']['avgrate'],2);
		
		if(!isset($cost_obj['insurance'])){
			$this->_error="missing insurance field";
			return false;
		}
		foreach(explode(',','name,displaytotal,displaydaily,displaytype') as $field){
			if(!isset($cost_obj['insurance'][$field])){
				$this->_error="missing insurance {$field} field";
				return false;
			}
		}
		$cost_obj['insurance']['displaytotal']=number_format($cost_obj['insurance']['displaytotal'],2);
		$cost_obj['insurance']['displaydaily']=number_format($cost_obj['insurance']['displaydaily'],2);
		
		if(!isset($cost_obj['mandatory'])){
			$this->_error="missing mandatory field";
			return false;
		}
		foreach($cost_obj['mandatory'] as $key=>$mandatory){
			foreach(explode(',','name,displaytotal,displaydaily,displaytype') as $field){
				if(!isset($mandatory[$field])){
					$this->_error="missing insurance {$field} field";
					return false;
				}
			}
			$cost_obj['mandatory'][$key]['displaytotal']=number_format($cost_obj['mandatory'][$key]['displaytotal'],2);
			$cost_obj['mandatory'][$key]['displaydaily']=number_format($cost_obj['mandatory'][$key]['displaydaily'],2);
		}

		if(!isset($cost_obj['discount_summary'])){
			$this->_error="missing discount_summary field";
			return false;
		}
		
		if(!isset($cost_obj['total'])){
			$this->_error="missing total field";
			return false;
		}
		$cost_obj['total']=number_format($cost_obj['total'],2);
		
		if(
			!isset($cost_obj['agent_to_collect'])||
			!isset($cost_obj['agent_to_collect']['value'])||
			!isset($cost_obj['agent_to_collect']['type'])
		){
			$this->_error="missing agent_to_collect field";
			return false;
		}
		$cost_obj['agent_to_collect']['value']=number_format($cost_obj['agent_to_collect']['value'],2);
		
		return $cost_obj;
	}

	public function get_js()
	{
		return json_encode($this->_data);
	}

	public static $page_title=array(
		'AU'=>'TRAVELLERS AUTOBARN - AUSTRALIA AGENT BOOKING',
		'NZ'=>'TRAVELLERS AUTOBARN - NEW ZEALAND AGENT BOOKING',
	);
	public function page_title()
	{
		return $this::$page_title[$this::$country];
	}

	public static $currency=array(
		'AU'=>'AU',
		'NZ'=>'NZ',
	);
	public function currency()
	{
		return $this::$currency[$this::$country];
	}

	public static $cars_and_campervans=array(
		'AU'=>'AUSTRALIA CARS AND CAMPERVANS',
		'NZ'=>'NEW ZEALAND CAMPERVANS',
	);
	public function cars_and_campervans()
	{
		return $this::$cars_and_campervans[$this::$country];
	}

	public static $cars_row_unavailable_html=array(
		'AU'=><<<EOT
<td><a
		style='text-decoration:underline; cursor:pointer;'
		onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
		>%categoryfriendlydescription<a>
	</input></td>
<td>BOOKED OUT</td>
<td>unlimited</td>
<td>free</td>
EOT
		,
		'NZ'=><<<EOT
<td><input
	type='radio'
	onclick=''
	style='vertical-align: top;visibility:hidden;'
	name='a'><a
		style='text-decoration:underline; cursor:pointer;'
		onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
		>%categoryfriendlydescription<a>
	</input></td>
<td>BOOKED OUT</td>
<td></td>
<td></td>
EOT
	);
	public function cars_row_unavailable_html()
	{
		return $this::$cars_row_unavailable_html[$this::$country];
	}
	
	public static $cars_row_unavailable_because_html=array(
		'AU'=><<<EOT
<td><a
		style='text-decoration:underline; cursor:pointer;'
		onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
		>%categoryfriendlydescription<a>
	</input></td>
<td colspan="3">%new_availablemsg</td>
EOT
		,
		'NZ'=><<<EOT
<td><input
	type='radio'
	onclick=''
	style='vertical-align: top;visibility:hidden;'
	name='a'><a
		style='text-decoration:underline; cursor:pointer;'
		onclick='window.open("%vehicledescurl","Car","width=600, height=800, menu=no, toolbar=no,scrollbars=yes, status=no");return false;'
		>%categoryfriendlydescription<a>
	</input></td>
<td colspan="3">%new_availablemsg</td>
EOT
	);
	public function cars_row_unavailable_because_html()
	{
		return $this::$cars_row_unavailable_because_html[$this::$country];
	}

	
	public static $wp_ajax_url=array(
		'AU'=>'http://www.travellers-autobarn.com.au/ajax/b2b-popups.php?s={placeholder}',
		'NZ'=>'http://www.travellers-autobarn.co.nz/ajax/b2b-popups.php?s={placeholder}',
	);
	public function wp_ajax_url($placeholder)
	{
		return str_replace(
			'{placeholder}',
			$placeholder,
			$this::$wp_ajax_url[$this::$country]
		);
	}

	public static $reservation_quotation_days_html=array(
		'AU'=><<<EOT
<td></td>
<td align='left' class='text'><span style='margin-left:10px;'>Days</span></td>
<td class='text' align='right'style='width:100px;' width=100px  >AU$%totrate</td>
<td class='text' align='right' style='width:150px; color:#999;' width=150px >%numofdays Days @ AU$%avgrate</td>
EOT
		,
		'NZ'=><<<EOT
<td></td>
<td align='left' class='text'><span style='margin-left:10px;'>Rates</span></td>
<td class='text' align='right'style='width:100px;' width=100px  >$%totrate</td>
<td class='text' align='right' style='width:150px; color:#999;' width=150px >%numofdays Days x $%avgrate</td>
EOT
	);
	public function reservation_quotation_days_html()
	{
		return $this::$reservation_quotation_days_html[$this::$country];
	}

	public static $reservation_quotation_excess_html=array(
		'AU'=><<<EOT
<td></td>
<td class=text  align=left><span style='margin-left:10px;'>%name</span>
<td class=text align=right>  %displaytype at $%displaydaily</td>
<td  align=right class=text style='color:#999;'>$%displaytotal</td>
EOT
		,
		'NZ'=><<<EOT
<td></td>
<td class=text  align=left><span style='margin-left:10px;'>%name</span>
<td class=text align=right>  %displaytype at $%displaydaily</td>
<td  align=right class=text style='color:#999;'>$%displaytotal</td>
EOT
	);
	public function reservation_quotation_excess_html()
	{
		return $this::$reservation_quotation_excess_html[$this::$country];
	}

	public static $reservation_quotation_mandatory_html=array(
		'AU'=><<<EOT
<td></td>
<td class=text align=left ><span style='margin-left:10px;'>%name</span>
<td class=text align=right>  %displaytype at $%displaydaily </td>
<td  align=right class=text style='color:#999;'>$%displaytotal</td>
EOT
		,
		'NZ'=><<<EOT
<td></td>
<td class=text align=left ><span style='margin-left:10px;'>%name</span>
<td class=text align=right>  $%displaytotal </td>
<td  align=right class=text style='color:#999;'>%displaytype at $%displaydaily</td>
EOT
	);
	public function reservation_quotation_mandatory_html()
	{
		return $this::$reservation_quotation_mandatory_html[$this::$country];
	}

	public static $reservation_quotation_discount_html=array(
		'AU'=><<<EOT
<td></td>
<td class=text align=left ><span style='margin-left:10px;'>Discount</span>
<td class=text align=right>-$%fees</td>
<td  align=right class=text style='color:#999;'>%name</td>
EOT
		,
		'NZ'=><<<EOT
<td></td>
<td class=text align=left ><span style='margin-left:10px;'>Discount</span>
<td class=text align=right>-$%fees</td>
<td  align=right class=text style='color:#999;'>%name</td>
EOT
	);
	public function reservation_quotation_discount_html()
	{
		return $this::$reservation_quotation_discount_html[$this::$country];
	}

	public static $reservation_quotation_total_html=array(
		'AU'=><<<EOT
<tr>
	<td></td>
	<td align='left' class='text'><span style='margin-left:10px;'><b>Total </span></b></td>
	<td class='text' align='right'style='width:100px;' width=100px  ><b>AU$%total</b></td>
	<td class='text' align='right' style='width:150px; color:#999;' width=150px >%days Days @ AU$%day_avg</td>
</tr>
<tr>
	<td class='text' colspan='2'></td>
	<td class='text' colspan='2' align='right' style='color:#999;'>(incl GST of AU$%gst)</td>
</tr>
<tr>
	<td></td>
	<td align='left' class='text'><span style='margin-left:10px;'><b>Agent to collect (%type) </span></b></td>
	<td class='text' align='right'style='width:100px;' width=100px  ><b>AU$%agent</b></td>
	<td class='text' align='right' style='width:150px; color:#999;' width=150px ></td>
</tr>
EOT
		,
		'NZ'=><<<EOT
<tr>
	<td></td>
	<td align='left' class='text'><span style='margin-left:10px;'><b>Total </span></b></td>
	<td class='text' align='right'style='width:100px;' width=100px  ><b>NZD %total</b></td>
	<td class='text' align='right' style='width:150px; color:#999;' width=150px >(incl GST of $%gst)</td>
</tr>
<tr>
	<td></td>
	<td align='left' class='text'><span style='margin-left:10px;'><b>Agent to collect (%type) </span></b></td>
	<td class='text' align='right'style='width:100px;' width=100px  ><b>$%agent</b></td>
	<td class='text' align='right' style='width:150px; color:#999;' width=150px ></td>
</tr>
EOT
	);
	public function reservation_quotation_total_html()
	{
		return $this::$reservation_quotation_total_html[$this::$country];
	}

	public static $thanks=array(
		'AU'=>'Thanks for booking with Travellers Autobarn - Australia',
		'NZ'=>'Thanks for booking with Travellers Autobarn - New Zealand',
	);
	public function thanks()
	{
		return $this::$thanks[$this::$country];
	}

	public static $tc_url=array(
		'AU'=>'http://www.travellers-autobarn.com.au/campervan-hire-australia/terms-and-conditions/',
		'NZ'=>'http://www.travellers-autobarn.co.nz/campervan-hire-new-zealand/terms-and-conditions/',
	);
	public function tc_url()
	{
		return $this::$tc_url[$this::$country];
	}

	public static $found_us=array(
		'AU'=>53,
		'NZ'=>54,
	);
	public function found_us()
	{
		return $this::$found_us[$this::$country];
	}
	
	public static $domain=array(
		'AU'=>'www.travellers-autobarn.com.au',
		'NZ'=>'www.travellers-autobarn.co.nz',
	);
	public function domain()
	{
		return $this::$domain[$this::$country];
	}

	public static $title=array(
		'AU'=>'Travellers Autobarn - Australia',
		'NZ'=>'Travellers Autobarn - New Zealand',
	);
	public function title()
	{
		return $this::$title[$this::$country];
	}
	
	public static $onrequest_email_subject=array(
		'AU'=>'Travellers Autobarn Australia Request Availablity',
		'NZ'=>'Travellers Autobarn New Zealand Request Availablity',
	);
	public function onrequest_email_subject()
	{
		return $this::$onrequest_email_subject[$this::$country];
	}

	public function years_selection()
	{
		$years=array();
		for($year=date('Y');$year<=date('Y')+4;$year++){
			$years[]="<option value='{$year}'>{$year}</option>";
		}
		return implode('',$years);
	}

}
