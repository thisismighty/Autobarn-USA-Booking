<?php
/*
Version 1.5
 */

if (
	isset($_SERVER['REQUEST_URI'])
	&&
	stripos($_SERVER['REQUEST_URI'],preg_replace('#\..*?$#','',basename(__FILE__))) !== false
) {
	header('HTTP/1.0 404 Not Found');
	die();
}

class EMDebug
{
	public static $to_email='fulvio@em.com.au';

	public static function protocol($server=null)
	{
		if($server===null){
			$server=$_SERVER;
		}
		return isset($server['HTTPS'])?'https':'http';
	}

	public static function where($level=0)
	{
		if(static::$to_email!==false){
			return null;
		}
		$args = debug_backtrace();
		foreach ($args as $key => $arg) {
			foreach (array_keys($arg) as $k) {
				if (!in_array($k, array('class', 'line', 'function', 'type', 'file'))) {
					unset($args[$key][$k]);
				}
			}
		}
		foreach ($args as $key => $arg) {
			if ($key < $level) {
				continue;
			}
			echo "<!-- {$arg['file']} -->";
			return;
		}
		echo '<!-- unknown file -->';
	}

	public static function d() {
		ob_start();
		foreach (func_get_args() as $arg) {
			var_dump($arg);
		}
		$str=ob_get_clean().static::backtrace(1);
		if(static::debugemail($str)!==null){
			return;
		}
		if(php_sapi_name()=='cli'){
			echo $str;
			return;
		}
		$str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str).static::backtrace(1);
		echo (
			'"</script><pre style="'
			.'border:5px solid black;background-color:#ffd;'
			.'font-family:monospace;font-size:16px;padding:20px;line-height: 26px;'
			.'">'.$str.'</pre>'
		);
	}
	
	public static function dif($cond) {
		if(!$cond){
			return;
		}
		ob_start();
		foreach (func_get_args() as $arg) {
			var_dump($arg);
		}
		$str=ob_get_clean().static::backtrace(1);
		if(static::debugemail($str)!==null){
			return;
		}
		if(php_sapi_name()=='cli'){
			echo $str;
			return;
		}
		$str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str).static::backtrace(1);
		echo (
			'"</script><pre style="'
			.'border:5px solid black;background-color:#ffd;'
			.'font-family:monospace;font-size:16px;padding:20px;line-height: 26px;'
			.'">'.$str.'</pre>'
		);
	}
	
	public static function ddif($cond) {
		if(!$cond){
			return;
		}
		ob_start();
		foreach (func_get_args() as $arg) {
			var_dump($arg);
		}
		$str=ob_get_clean().static::backtrace(1);
		if(static::debugemail($str)!==null){
			die('An error has occurred. Our team has been advised. Please try again later.');
		}
		if(php_sapi_name()=='cli'){
			die($str).static::backtrace(1);
		}
		if(strlen($str)>10000000){
			$str=substr($str,0,10000000);
		}
		$str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str).static::backtrace(1);
		die(
			'"</script><pre style="'
			.'border:5px solid black;background-color:#ffd;'
			.'font-family:monospace;font-size:16px;padding:20px;line-height: 26px;'
			.'">'.$str.'</pre>'
		);
	}

	public static function dd() {
		ob_start();
		foreach (func_get_args() as $arg) {
			var_dump($arg);
		}
		$str=ob_get_clean().static::backtrace(1);
		if(static::debugemail($str)!==null){
			die('An error has occurred. Our team has been advised. Please try again later.');
		}
		if(php_sapi_name()=='cli'){
			die($str).static::backtrace(1);
		}
		if(strlen($str)>10000000){
			$str=substr($str,0,10000000);
		}
		$str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str).static::backtrace(1);
		die(
			'"</script><pre style="'
			.'border:5px solid black;background-color:#ffd;'
			.'font-family:monospace;font-size:16px;padding:20px;line-height: 26px;'
			.'">'.$str.'</pre>'
		);
	}

	public static function pd() {
		ob_start();
		foreach (func_get_args() as $arg) {
			print_r($arg);
		}
		$str=ob_get_clean().static::backtrace(1);
		if(static::debugemail($str)!==null){
			return;
		}
		if(php_sapi_name()=='cli'){
			die($str);
			return;
		}
		$str = str_replace(array('<', '>'), array('&lt;', '&gt;'), $str).static::backtrace(1);
		die(
			'"</script><pre style="'
			.'border:5px solid black;background-color:#ffd;'
			.'font-family:monospace;font-size:16px;padding:20px;line-height: 26px;'
			.'">'.$str.'</pre>'
		);
	}

	public static function debugemail($str) {
		if(static::$to_email===false){
			return null;
		}
		$location=__DIR__;
		if(isset($_SERVER['HTTP_HOST'])){
			$location=$_SERVER['HTTP_HOST'];
		}
		return mail(static::$to_email, "Error on {$location}", $str);
	}

	public static function backtrace($level = 2) {
		$args = debug_backtrace();
		foreach ($args as $key => $arg) {
			foreach (array_keys($arg) as $k) {
				if (!in_array($k, array('class', 'line', 'function', 'type', 'file'))) {
					unset($args[$key][$k]);
				}
			}
		}
		$show = array();
		foreach ($args as $key => $arg) {
			if ($key < $level) {
				continue;
			}
			if (!isset($arg['file'])) {
				$arg['file'] = '?';
			}
			if (!isset($arg['line'])) {
				$arg['line'] = '?';
			}
			if (isset($arg['class'])) {
				$show[] = "{$arg['file']}:{$arg['line']} <i>calls</i> {$arg['class']}{$arg['type']}{$arg['function']}";
				continue;
			}
			if (isset($arg['file'])) {
				$show[] = "{$arg['file']}:{$arg['line']} <i>calls</i> {$arg['function']}";
				continue;
			}
			$show[] = "? <i>calls</i> {$arg['function']}";
		}
		return implode("\n", $show)."\n";
	}
	
	public static function shutdown_handler() {
		$a = error_get_last();
		if ($a === null) {
			return;
		}
		if (stripos($a['message'],'magic_quotes_gpc')!==false && stripos($a['message'],'deprecated')!==false) {
			return;
		}
		if (stripos($a['message'],'WP_Feed_Cache::create')!==false && stripos($a['message'],'deprecated')!==false) {
			return;
		}
		if (stripos($a['message'],'Declaration of ')!==false && stripos($a['message'],' should be compatible with ')!==false) {
			return;
		}
		if (stripos($a['message'],'Automatically populating $HTTP_RAW_POST_DATA')!==false) {
			return;
		}
		static::error_handler($a['type'], $a['message'], $a['file'], $a['line']);
		error_log(
			'Shutdown PHP '.static::error_number_to_string($a["type"]).
			": {$a["message"]} in {$a["file"]} on line {$a["line"]}"
		);
	}

	public static function exception_handler(Exception $e) {
		error_log(
			'PHP Unhandled exception: '.
			$e->getMessage().
			' in '.$e->getFile().
			' on line '.$e->getLine().
			static::SERVER_referer()
		);
		return static::error_handler(
			$e->getCode(), 'Unhandled exception: ' . $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace()
		);
	}

	public static function error_number_to_string($no) {
		$options = array(
			E_ERROR => 'Error',
			E_WARNING => 'Warning',
			E_PARSE => 'Parse',
			E_NOTICE => 'Notice',
			E_CORE_ERROR => 'Core Error',
			E_CORE_WARNING => 'Core Warning',
			E_COMPILE_ERROR => 'Compile Error',
			E_COMPILE_WARNING => 'Compile Warning',
			E_USER_ERROR => 'User Error',
			E_USER_WARNING => 'User Warning',
			E_USER_NOTICE => 'User Notice',
			E_STRICT => 'Strict',
			E_RECOVERABLE_ERROR => 'Recoverable Error',
			E_DEPRECATED => 'Deprecated',
			E_USER_DEPRECATED => 'User Deprecated',
			E_ALL => 'All'
		);
		if (isset($options[$no])) {
			return $options[$no];
		}
		return '';
	}

	public static function SERVER_referer() {
		if (
			isset($_SERVER['REQUEST_URI'])
			&&
			isset($_SERVER['HTTP_HOST'])
		) {
			return ", referer http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		}
		return ', unknown referer';
	}
	
	protected static $_error_path_to_ignore=array();
	/**
	 * @param type $path needs to be relative to this file
	 */
	public static function error_handler_add_ignore_by_path($path) {
		static::$_error_path_to_ignore[]=$path;
	}

	protected static $_error_path_to_ignore_cli=array();
	/**
	 * @param type $path needs to be absolute
	 */
	public static function error_handler_add_ignore_by_path_cli($path) {
		static::$_error_path_to_ignore_cli[]=$path;
	}

	public static function error_handler($no, $str = '', $file = '', $line = 0, $context = array()) {
		error_log('PHP caught '.static::error_number_to_string($no).": {$str} in {$file} on line {$line}");
		if(error_reporting()===0){
			return;
		}
		if(php_sapi_name()=='cli'){
			foreach(static::$_error_path_to_ignore_cli as $ignore){
				$path=DIRECTORY_SEPARATOR.trim($ignore,DIRECTORY_SEPARATOR);
				if(strpos($file,$path)===0){
					return;
				}
			}
		}else{
			foreach(static::$_error_path_to_ignore as $ignore){
				$path=__DIR__.DIRECTORY_SEPARATOR.trim($ignore,DIRECTORY_SEPARATOR);
				if(strpos($file,$path)===0){
					return;
				}
			}
		}
		if (strpos($str,'Something may be wrong with WordPress.org') !== false) {
			return;
		}
		if (stripos($str,'Declaration of ')!==false && stripos($str,' should be compatible with ')!==false) {
			return;
		}
		if (stripos($str,'Automatically populating $HTTP_RAW_POST_DATA')!==false) {
			return;
		}
		static::dd(array(
			'Error' => static::error_number_to_string($no),
			'String' => $str,
			'local' => $file . ':' . $line,
			'URL' => static::SERVER_referer(),
			'$_SESSION' => isset($_SESSION) ? $_SESSION : 'no session',
			'$_GET' => $_GET,
			'$_POST' => $_POST,
			'$_COOKIE' => $_COOKIE,
			'Context' => $context,
			'Number' => $no,
			'$_SERVER' => $_SERVER,
			'Paths ignored' => static::$_error_path_to_ignore,
			'Paths ignored cli' => static::$_error_path_to_ignore_cli,
		));
	}
}
