<?php

namespace Converter\Controller;
use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class ConverterControllerTest extends AbstractConsoleControllerTestCase
{
	public function setUp()
	{
		$this->setApplicationConfig(
			include realpath(__DIR__.'/../../../../../config/application.config.php')
		);
		parent::setUp();
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->dispatch('foo bar');
		$this->assertModuleName('Converter');
		$this->assertControllerName('Converter\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('convert-route');
	}
}