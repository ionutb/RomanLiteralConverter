<?php

namespace Converter\Controller;

use Converter\Model\Convert;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Exception\InvalidArgumentException;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	public function indexAction()
	{
		$error = $this->params()->fromRoute('error');
		$view =  new ViewModel();
		$view->setVariable('error', $this->params()->fromRoute('error'));
		$view->setVariable('decimal', $this->params()->fromRoute('decimal'));
		return $view;

	}
	public  function convertToRomanAction()
	{
		$decimal = $this->params()->fromPost('number');
		$convert = new Convert();
		$convert->setServiceLocator($this->getServiceLocator());
		try {
			$romanNumber = $convert->convertToRoman($decimal);
		} catch (InvalidArgumentException $ex)
		{
			return $this->forward()->dispatch('Converter\Controller\Index', array(
				'action' => 'index',
				'error' => $ex->getMessage(),
				'decimal' => $decimal
			));
		}
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
