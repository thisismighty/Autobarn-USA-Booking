<?php
spl_autoload_register(function($class) {
	if(file_exists(__DIR__ . "/../bin/{$class}.php")){
		require_once __DIR__ . "/../bin/{$class}.php";
		return;
	}
});

session_start();

ControllerSourceSite::from_post($_POST, $_SESSION);
