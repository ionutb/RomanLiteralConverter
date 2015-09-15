<?php

namespace Converter;

/**
 * Class Log
 * @package Converter
 * helper class that enables to write to logs easier
 */
class Log
{
	public static function __callStatic($method, $args)
	{
		$logger = new \Zend\Log\Logger();
		$writer = new \Zend\Log\Writer\Stream(LOG_PATH.DIRECTORY_SEPARATOR.'log'.date('Y-m-d').'-error.log');
		$logger->addWriter($writer);
		return $logger->$method($args[0]);
	}
};