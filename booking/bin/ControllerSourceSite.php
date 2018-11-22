<?php

class ControllerSourceSite
{
	const POST_KEY='form-source';
	const SESSION_KEY='ControllerSourceSite-source';
	public static function from_post($_post,&$_session)
	{
		if(!isset($_post[static::POST_KEY])){
			return false;
		}
		if(
			/*strpos($_post[static::POST_KEY],'http://travellers-autobarn')===false
			&&
			strpos($_post[static::POST_KEY],'https://travellers-autobarn')===false
			&&
			strpos($_post[static::POST_KEY],'http://www.travellers-autobarn')===false
			&&
			strpos($_post[static::POST_KEY],'https://www.travellers-autobarn')===false*/
            strpos($_post[static::POST_KEY],'http://staging')===false
			&&
			strpos($_post[static::POST_KEY],'https://staging')===false
			&&
			strpos($_post[static::POST_KEY],'http://www.staging')===false
			&&
			strpos($_post[static::POST_KEY],'https://www.staging')===false
		){
			return false;
		}
		$_session[static::SESSION_KEY]=$_post[static::POST_KEY];
	}
	
	protected static $_api_url='https://secure20.rentalcarmanager.com/api/3.0/main';
	public static function api_url_set($url)
	{
		static::$_api_url=$url;
	}

	public static function api_url_get()
	{
		return static::$_api_url;
	}

}
