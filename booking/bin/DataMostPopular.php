<?php

class DataMostPopular
{
	public static $pop_url='';
	protected $_cache=null;
	public function url(){
		if(!$this->_cache){
			$try=file_get_contents($this::$pop_url);
			if($try){
				$this->_cache=$try;
			}
		}
		return json_decode($this->_cache);
	}
}
