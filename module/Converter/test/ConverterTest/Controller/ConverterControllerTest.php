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

	public function testCovertActionCanBeAccessed()
	{
		$this->dispatch('/converter/convertToRoman', 'POST', array('number' => 20));
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('Converter');
		$this->assertControllerName('Converter\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('convert-route');
		$this->assertActionName('convertToRoman');
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->dispatch('/');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('Converter');
		$this->assertControllerName('Converter\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('home');
		$this->assertActionName('index');
	}


}