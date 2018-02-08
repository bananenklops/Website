<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.02017
*/
spl_autoload_register(function ($class_name) {
	if (!preg_match("/Mike42/", $class_name))
		include 'class\\' . $class_name . '.Class.php';
	else {
		$prefix = "Mike42\\";
		$base_dir = __DIR__ . "/class/Mike42/";
		
		/* Only continue for classes in this namespace */
		$len = strlen ( $prefix );
		if (strncmp ( $prefix, $class_name, $len ) !== 0) {
			return;
		}
		
		/* Require the file if it exists */
		$relative_class = substr ( $class_name, $len );
		$file = $base_dir . str_replace ( '\\', '/', $relative_class ) . '.php';
		if (file_exists ( $file )) {
			require $file;
		}
	}
});