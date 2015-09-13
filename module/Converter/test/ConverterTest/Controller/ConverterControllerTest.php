<?php

namespace Converter\Controller;
use Converter\Bootstrap;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class ConverterControllerTest extends AbstractControllerTestCase
{
	public function setUp()
	{
		$this->setApplicationConfig(
			include realpath(Bootstrap::$appRoot.'/config/application.config.php')
		);
		parent::setUp();
	}

	public function testConvertActionCanBeAccessed()
	{
		$this->dispatch('/converter/convert-to-roman/20');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('Converter');
		$this->assertControllerName('Converter\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('convert-route');
		$this->assertActionName('convert-to-roman');
	}
}