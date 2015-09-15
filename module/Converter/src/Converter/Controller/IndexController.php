<?php

namespace Converter\Controller;

use Converter\Model\Convert;

use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Exception\InvalidArgumentException;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

	/**
	 * @param array $variables
	 * @return ViewModel
	 */
	protected function _getViewModel($variables = null)
	{
		return new \Zend\View\Model\ViewModel($variables);
	}

	public function indexAction()
	{
		return $this->_getViewModel(
			array(
				'error' => $this->params()->fromRoute('error'),
				'decimal' => $this->params()->fromRoute('decimal')
			)
		);
	}

	public  function convertToRomanAction()
	{
		$decimal = $this->params()->fromPost('number');
		try {
			$convert = new Convert();
			$romanNumber = $convert->convertToRoman($decimal);
		} catch (InvalidArgumentException $ex)
		{
			return $this->forward()->dispatch('Converter\Controller\Index', array(
				'action' => 'index',
				'error' => $ex->getMessage(),
				'decimal' => $decimal
			));
		}

		return $this->_getViewModel(
			array (
				'response' => $romanNumber,
				'decimal' => $decimal
			)
		);
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
