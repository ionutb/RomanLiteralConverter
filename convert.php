<?php
// Composer autoloading
if (file_exists('vendor/autoload.php')) {
	$loader = include 'vendor/autoload.php';
}

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();