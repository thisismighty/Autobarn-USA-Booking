<?php
/*
Plugin Name: EM Log
Description: File-based logging
Author: EM
Version: 1.6
 modified to allow using this class outside WordPress, but still use the
 WordPress time functions if available.

Version: 1.5

Used on distributioncentral.com, coralexpeditions.com

There's no front-end or back-end interface. This plugin allows processes to
write information to a file for later debugging.

The files are not originally truncated to size. The constant
EMLog_enable_destruct can be defined to do such, but it's not adviseable given
the time necessary to execute the task. Truncating the file size is more
appropriately done via a cron job or ad-hoc executing via command line.
Run 'php EMLog.php' for more information on the command line tool.

@todo make some API for log download and rotate
*/

class EMLog
{
	public function __construct($logfile,$prepend='',$lines=1000000)
	{
		$this->_logfile=$logfile;
		if($prepend===true){
			list($usec,$sec)=explode(" ",microtime());
			$prepend=((float)$usec+(float)$sec);
			$this->_prepend=' '.$prepend;
		}else{
			$this->_prepend=' '.$prepend;
		}
		$this->_lines=$lines;
	}
	
	public function __destruct()
	{
		if(!defined('EMLog_enable_destruct')||!EMLog_enable_destruct){
			return;
		}
		$this->truncate();
	}

	protected $_lines=null;
	protected $_prepend='';
	protected $_logfile='';
	public function log($msg = '')
	{
		if(!is_string($msg)){
			$msg=print_r($msg,true);
		}
		$log = 'cli';
		if (isset($_SERVER['REQUEST_URI'])) {
			$log = $_SERVER['REQUEST_URI'];
		}
		$ip='';
		if (isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		if(function_exists('current_time')){
			$date = current_time('Y-m-d H:i:s');
		}else{
			$date = date('Y-m-d H:i:s');
		}
		file_put_contents(
			$this->_logfile,
			"[{$date} {$ip} {$log}]{$this->_prepend} {$msg}\n",
			FILE_APPEND
		);
		return;
	}
	
	protected $_error='';
	public function error()
	{
		return $this->_error;
	}

	public function truncate()
	{
		$this->_error='';
		if(!file_exists($this->_logfile)){
			$this->_error='file not found';
			return false;
		}
		$fp=fopen($this->_logfile, 'r');
		$pos=-1;
		$lines=array();
		$currentLine='';
		while (-1!==fseek($fp,--$pos,SEEK_END)){
			$char=fgetc($fp);
			if(chr(10)!=$char){
				$currentLine=$char.$currentLine;
				continue;
			}
			$lines[]=$currentLine;
			if(count($lines)>$this->_lines){
				break;
			}
			$currentLine='';
		}
		fclose($fp);
		$lines=implode("\n",array_reverse($lines));
		file_put_contents($this->_logfile, $lines);
		return true;
	}
	
	public function rotate()
	{
		$this->_error='';
		if(!file_exists($this->_logfile)){
			$this->_error='file not found';
			return false;
		}
		$newname=$this->_logfile.date('.Y-m-d-H-i-s');
		if(!rename($this->_logfile, $newname)){
			$this->_error="error moving {$this->_logfile} to {$newname}";
			return false;
		}
		$dir=dirname($this->_logfile);
		$newname_base=basename($newname);
		$command="tar czvf {$newname}.tar.gz -C {$dir} {$newname_base} --remove-files";
		exec($command, $output, $return_var);
		if($return_var===0){
			return true;
		}
		$output=implode("\n",$output);
		$this->_error="tar error:\n{$command}\n{$output}\nreturned {$return_var}";
		return false;
	}
	
	const CLI_HELP=<<<EOT
Rotates a log file.

php EMLog.php [method]

method
	truncate [file] [number_of_lines]
		crops the file, losing old records. Parameters are

		file
			required, path to file

		number_of_lines
			required, number of lines left on the file, must be numeric.
		
	rotate [file]
		moves the log file and zips the result. Parameters are
		
		file
			required, path to file

EOT;
	public static function cli_controller($argv)
	{
		if(!isset($argv[1])){
			echo static::CLI_HELP;
			return 1;
		}
		if($argv[1]=='truncate'){
			return static::cli_truncate($argv);
		}
		if($argv[1]=='rotate'){
			return static::cli_rotate($argv);
		}
		echo static::CLI_HELP;
		return 2;
	}

	public static function cli_truncate($argv)
	{
		if(!isset($argv[3])){
			echo static::CLI_HELP;
			return 10;
		}
		if(!is_numeric($argv[3])){
			echo static::CLI_HELP;
			return 11;
		}
		$EMLog=new EMLog($argv[2], '', $argv[3]);
		$try=$EMLog->truncate();
		if($try===false){
			echo 'There was an error: '.$EMLog->error()."\n";
			return 12;
		}
		echo "Success\n";
		return 0;
	}
	
	public function cli_rotate($argv)
	{
		if(!isset($argv[2])){
			echo static::CLI_HELP;
			return 20;
		}
		$EMLog=new EMLog($argv[2], '', 0);
		$try=$EMLog->rotate();
		if($try===false){
			echo 'There was an error: '.$EMLog->error()."\n";
			return 21;
		}
		echo "Success\n";
		return 0;
	}

}

if(php_sapi_name()=='cli'&&realpath($argv[0])==__FILE__){
	die(EMLog::cli_controller($argv));
}
