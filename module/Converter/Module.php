<?php

namespace Converter;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
	private static $cache;
	private static $cacheEnabled = false;


	public function onBootstrap(MvcEvent $e)
	{
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$application   = $e->getApplication();
		$sm = $application->getServiceManager();
		$sharedManager = $application->getEventManager()->getSharedManager();

		$sharedManager->attach('Zend\Mvc\Application', 'dispatch.error',
			function($e) {
				$ex = $e->getParam('exception');
				if ($ex)
				{
					Log::debug($ex);
				}
			}
		);
	}



	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}


}
