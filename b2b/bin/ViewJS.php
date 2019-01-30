<?php

class ViewJS
{
	protected static $_path=null;
	protected static $_url=null;
	public static function settings($path,$url)
	{
		static::$_path=$path;
		static::$_url=$url;
	}

	public static function draw($file)
	{
		$path=static::$_path.$file;
		if(!file_exists($path)){
			return '';
		}
		$url=static::$_url.$file;
		$time=filemtime($path);
		return <<<EOT
<script type="text/javascript" src="{$url}?v={$time}"></script>

EOT;
	}

}
