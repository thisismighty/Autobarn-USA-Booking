<?php

class ViewCSS
{
	protected static $_path=null;
	protected static $_url=null;
	protected static $_media=null;
	public static function settings($path,$url,$media)
	{
		static::$_path=$path;
		static::$_url=$url;
		static::$_media=$media;
	}
	
	public static function media_query($type)
	{
		if(!@isset(static::$_media[$type])){
			return false;
		}
		return static::$_media[$type];
	}

	public static function media_queries()
	{
		return static::$_media;
	}

	public static function draw($file)
	{
		$ret=array(
			static::draw_one($file),
		);
		foreach(static::$_media as $type=>$media){
			$ret[]=static::draw_one("{$type}-{$file}",$media);
		}
		return implode("\n",$ret);
	}

	public static function draw_one($file,$media=null)
	{
		$path=static::$_path.$file;
		if(!file_exists($path)){
			return '';
		}
		$url=static::$_url.$file;
		$time=filemtime($path);
		if($media===null){
			return <<<EOT
<link rel="stylesheet" href="{$url}?v={$time}"/>
EOT;
		}
		return <<<EOT
<link rel="stylesheet" media="{$media}" href="{$url}?v={$time}"/>
EOT;
	}

}
