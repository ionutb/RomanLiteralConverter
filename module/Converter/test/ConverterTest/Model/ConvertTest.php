<?php
class ConvertTest extends PHPUnit_Framework_TestCase
{

	private $knownValues = array(
		[1, 'I'],
		[2, 'II'],
		[3, 'III'],
		[4, 'IV'],
		[5, 'V'],
		[6, 'VI'],
		[7, 'VII'],
		[8, 'VIII'],
		[9, 'IX'],
		[10, 'X'],
		[50, 'L'],
		[100, 'C'],
		[500, 'D'],
		[1000, 'M'],
		[1666, 'MDCLXVI'],
		[1990, 'MCMXC'],
		[2008, 'MMVIII'],
		[3159, 'MMMCLIX'],
		[1977, 'MCMLXXVII'],
		[3999, 'MMMCMXCIX']
	);

	private $badValues = array(-10, 0, 32.4, 4000, '', '-20', 'bad_value');


	public function setUp()
	{
	}

	public function testConvertKnownValues()
	{
		$converter = new \Converter\Model\Convert();
		foreach ($this->knownValues as $item)
		{
			list($decimal, $romanLiteral) = $item;
			$this->assertEquals($romanLiteral, $converter->convertToRoman($decimal));
		}
	}

	public function testConvertIllegalValues() {
		$this->setExpectedException('InvalidArgumentException');
		$converter = new \Converter\Model\Convert();
		foreach ($this->badValues as $badValue)
		{
			$converter->convertToRoman($badValue);
		}

	}
}