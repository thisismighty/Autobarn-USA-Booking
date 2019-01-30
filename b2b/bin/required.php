<?php
require 'EMDebug.php';

spl_autoload_register(function($class) {
	if(file_exists(__DIR__ . "/{$class}.php")){
		require_once __DIR__ . "/{$class}.php";
		return;
	}
});

session_start();

