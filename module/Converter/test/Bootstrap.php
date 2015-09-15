<?php

namespace Converter;

use Zend\Loader\AutoloaderFactory;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
	protected static $serviceManager;

	public static $appRoot;

	public static function init()
	{
		static::$appRoot =  static::findParentPath('RomanLiteralConverter');
		define('APP_ROOT', static::$appRoot);

		$env = getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production';
		define('APPLICATION_ENV', $env);
		define('LOG_PATH', realpath(APP_ROOT.'\..\logs'));

		$zf2ModulePaths = array(dirname(dirname(__DIR__)));
		if (($path = static::findParentPath('vendor'))) {
			$zf2ModulePaths[] = $path;
		}
		if (($path = static::findParentPath('module')) !== $zf2ModulePaths[0]) {
			$zf2ModulePaths[] = $path;
		}
		static::initAutoloader();

		// use ModuleManager to load this module and it's dependencies
		$config = array(
			'module_listener_options' => array(
				'module_paths' => $zf2ModulePaths,
			),
			'modules' => array(
				'Converter'
			)
		);

		$serviceManager = new ServiceManager(new ServiceManagerConfig());
		$serviceManager->setService('ApplicationConfig', $config);
		$serviceManager->get('ModuleManager')->loadModules();
		static::$serviceManager = $serviceManager;
	}

	public static function chroot()
	{
		$rootPath = dirname(static::findParentPath('module'));
		chdir($rootPath);
	}

	public static function getServiceManager()
	{
		return static::$serviceManager;
	}

	protected static function initAutoloader()
	{
		$vendorPath = static::findParentPath('vendor');
		$zf2Path = realpath($vendorPath . '/zendframework');
		if (!is_dir($zf2Path)) {
			throw new RuntimeException(
				'Unable to load ZF2. Run `php composer.phar install` or'
				. ' define a ZF2_PATH environment variable.'.$zf2Path
			);
		}

		if (file_exists(realpath($vendorPath . '/autoload.php'))) {
			include realpath($vendorPath . '/autoload.php');
		}

		AutoloaderFactory::factory(array(
			'Zend\Loader\StandardAutoloader' => array(
				'autoregister_zf' => true,
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/' . __NAMESPACE__,
				),
			),
		));
	}

	protected static function findParentPath($path)
	{
		$dir = __DIR__;
		$previousDir = '.';
		while (!is_dir($dir . DIRECTORY_SEPARATOR . $path)) {
			$dir = dirname($dir);
			if ($previousDir === $dir) {
				return false;
			}
			$previousDir = $dir;
		}
		return $dir . DIRECTORY_SEPARATOR . $path;
	}
}

Bootstrap::init();
Bootstrap::chroot();