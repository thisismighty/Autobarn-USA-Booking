<?php

class ControllerSourceSite
{
	protected static $_api_url='https://secure20.rentalcarmanager.com.au/api/3.0/main';
	public static function api_url_set($url)
	{
		static::$_api_url=$url;
	}
	public static function api_url_get()
	{
		return static::$_api_url;
	}

	protected static $_log=0;
	public static function log_set($log)
	{
		static::$_log=$log;
	}
	public static function log_get()
	{
		return static::$_log;
	}

}
