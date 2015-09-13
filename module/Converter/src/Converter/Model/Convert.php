<?php
namespace Converter\Model;

use Zend\Mvc\Exception\InvalidArgumentException;

class Convert
{
	// we store numerals in an ordered array
	private static $numeralMapping = array(
		['M', 1000],
		['CM', 900],
		['D',  500],
		['CD', 400],
		['C',  100],
		['XC', 90],
		['L',  50],
		['XL', 40],
		['X',  10],
		['IX', 9],
		['V',  5],
		['IV', 4],
		['I',  1],
	);

	const MAX_NUMBER = 3999;

	/**
	 * @param $number convert a number into roman representation
	 * @return string
	 */
	public function convertToRoman($number)
	{

		if (!is_numeric($number))
		{
			throw new InvalidArgumentException("number_not_numeric");
		}

		if ($number <= 0)
		{
			throw new InvalidArgumentException("number_not_positive");
		}

		if ($number > static::MAX_NUMBER)
		{
			throw new InvalidArgumentException("number_too_big");
		}

		$result = '';
		foreach (static::$numeralMapping as $map)
		{
			list ($literal, $decimal) = $map;
 			while ($number >= $decimal)
			{
				//concatenate roman letter for each substraction
				$result .= $literal;
				$number -= $decimal;
			}
		}
		return $result;
	}

}
