<?php

class DataDate
{
	public static function aus2date($aus_date,$format='Y-m-d')
	{
		$date=explode('/',$aus_date);
		if(!isset($date[2])){
			return false;
		}
		return date($format,strtotime("{$date[2]}-{$date[1]}-{$date[0]}"));
	}

}
