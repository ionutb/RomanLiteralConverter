<?php

namespace Converter\Controller;

use Converter\Model\Convert;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	public  function convertToRomanAction()
	{
		$decimal = $this->params()->fromRoute('id');
		$convert = new Convert();

		$romanNumber = $convert->convertToRoman($decimal);
		$view =  new ViewModel();
		$view->setVariable('response', $romanNumber);
		$view->setVariable('decimal', $decimal);
		return $view;
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
