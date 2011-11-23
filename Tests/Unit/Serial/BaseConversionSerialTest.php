<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class Tx_Giftcertificates_Serial_BaseConversionSerial.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package giftcertificates
 * @subpackage Tests/Serial
 *
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class Tx_Giftcertificates_Serial_BaseConversionSerialTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 *
	 * @var Tx_Giftcertificates_Serial_BaseConversionSerial
	 */
	protected $serial;

	public function setUp() {
		$this->serial = $this->objectManager->create('Tx_Giftcertificates_Serial_BaseConversionSerial');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnStringInput() {
		$code = $this->serial->generate('HelloWorld!');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnArrayInput() {
		$code = $this->serial->generate(array('Hello', 'World'));
	}

	/**
	 * 
	 * @test
	 */
	public function encodeOnlyWorksForIntegers() {
		$serial = $this->serial->generate(time());
		$this->assertNotEmpty($serial, 'Generation only works for integers. Integer input results in a non-empty string.');

		$serial = $this->serial->generate(17021981);
		$this->assertEquals('19qc5', $serial);

		$serial = $this->serial->generate(5140605);
		$this->assertEquals('lziZ', $serial);
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnIntegerInput() {
		$code = $this->serial->validate(1, 'unimportant');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnArrayInput() {
		$code = $this->serial->validate(array('Hello', 'World'), 'unimportant');
	}

	/**
	 *
	 * @test
	 */
	public function validateOnlyWorksForStrings() {
		$validationResult = $this->serial->validate('19qc5', 17021981);
		$this->assertTrue($validationResult, 'Validation succeeds if challenger and defender matches.');

		$validationResult = $this->serial->validate('19qc5', time());
		$this->assertFalse($validationResult, 'Validation fails if challenger and defender dont match.');
	}
}
?>