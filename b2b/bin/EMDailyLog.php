<?php

class EMDailyLog
{
	protected static $_s_logdir='';
	protected static $_s_loglabel='';
	protected static $_s_oldest_file_date='';
	
	/**
	 * 
	 * @param type $logdir
	 * @param type $oldest_file_date from time() or strtotime(), like strtotime('-1 month');
	 * @param type $loglabel
	 */
	public static function settings($logdir,$oldest_file_date,$loglabel=null)
	{
		static::$_s_logdir=$logdir;
		static::$_s_loglabel=$loglabel;
		static::$_s_oldest_file_date=$oldest_file_date;
	}
	
	protected $_logdir='';
	protected $_loglabel='';
	protected $_oldest_file_date='';
	
	/**
	 * 
	 * @param type $loglabel
	 * @param type $logdir
	 * @param type $oldest_file_date from time() or strtotime(), like strtotime('-1 month');
	 */
	public function __construct($loglabel,$logdir=null,$oldest_file_date=null)
	{
		if($loglabel===null&&$this::$_s_loglabel===null){
			trigger_error('a label must be defined, either via settings or construct');
		}
		$this->_loglabel			=$loglabel			===null?$this::$_s_loglabel			:$loglabel;
		$this->_logdir				=$logdir			===null?$this::$_s_logdir			:$logdir;
		$this->_oldest_file_date	=$oldest_file_date	===null?$this::$_s_oldest_file_date	:$oldest_file_date;
	}
	
	protected function filename($timestamp=null)
	{
		if($timestamp===null){
			$timestamp=time();
		}
		$date=date('Y-m-d',$timestamp);
		return $this->_logdir.DIRECTORY_SEPARATOR."{$this->_loglabel}.{$date}.log";
	}
	
	protected $_error='';
	public function error()
	{
		return $this->_error;
	}

	public function log($msg = '')
	{
		if(!is_string($msg)){
			$msg=print_r($msg,true);
		}
		$log='cli';
		if(isset($_SERVER['REQUEST_URI'])){
			$log=$_SERVER['REQUEST_URI'];
		}
		$ip='';
		if(isset($_SERVER['REMOTE_ADDR'])){
			$ip=$_SERVER['REMOTE_ADDR'];
		}else{
			$ip=get_current_user();
		}
		if(function_exists('current_time')){
			$date=current_time('Y-m-d H:i:s');
		}else{
			$date=date('Y-m-d H:i:s');
		}
		file_put_contents(
			$this->filename(),
			"[{$date} {$ip} {$log}] {$msg}\n",
			FILE_APPEND
		);
		return;
	}

	public function __destruct()
	{
		$this->clean_by_date();
	}

	public function clean_by_date()
	{
		$oldest_file=basename($this->filename($this->_oldest_file_date));
		$files=glob($this->_logdir.DIRECTORY_SEPARATOR.'*.log');
		foreach($files as $file){
			$short_file=basename($file);
			if(substr($short_file,0,strlen($this->_loglabel))!=$this->_loglabel){
				continue;
			}
			if($short_file<$oldest_file){
				unlink($file);
			}
		}
	}
}
/*
$L=new EMDailyLog(__DIR__.'/../log','test',strtotime('-1 month'));
$L->log('test');
*/