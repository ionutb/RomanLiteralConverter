<?php

namespace Converter\Controller;

use Zend\Mvc\Controller\AbstractActionController;
class IndexController extends AbstractActionController
{
	public  function convertAction()
	{
		return 'convert action';
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
