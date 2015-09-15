<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
define('APP_ROOT', __DIR__);
define('LOG_PATH', realpath(APP_ROOT.'\..\logs'));


// Define application environment
$env = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
define('APPLICATION_ENV', $env);

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
	$path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	if (__FILE__ !== $path && is_file($path)) {
		return false;
	}
	unset($path);
}

// Setup autoloading
require 'init_autoloader.php';
$logger = new Zend\Log\Logger;
$writer = new Zend\Log\Writer\Stream(realpath(LOG_PATH).DIRECTORY_SEPARATOR.'log'.date('Y-m-d').'-error.log');
$logger->addWriter($writer);
Zend\Log\Logger::registerErrorHandler($logger);

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
