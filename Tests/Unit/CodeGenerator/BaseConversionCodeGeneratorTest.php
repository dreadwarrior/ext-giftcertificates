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
 * Test case for class Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGenerator.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package giftcertificates
 * @subpackage Tests/CodeGenerator
 *
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGeneratorTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 *
	 * @var Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGenerator
	 */
	protected $codeGenerator;

	public function setUp() {
		$this->codeGenerator = $this->objectManager->create('Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGenerator');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnStringInput() {
		$code = $this->codeGenerator->generate('HelloWorld!');		
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnArrayInput() {
		$code = $this->codeGenerator->generate(array('Hello', 'World'));
	}

	/**
	 * 
	 * @test
	 */
	public function encodeOnlyWorksForIntegers() {
		$code = $this->codeGenerator->generate(time());
		$this->assertNotEmpty($code, 'Generation only works for integers. Integer input results in a non-empty string.');

		$code = $this->codeGenerator->generate(17021981);
		$this->assertEquals('19qc5', $code);

		$code = $this->codeGenerator->generate(5140605);
		$this->assertEquals('lziZ', $code);
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnIntegerInput() {
		$code = $this->codeGenerator->validate(1, 'unimportant');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnArrayInput() {
		$code = $this->codeGenerator->validate(array('Hello', 'World'), 'unimportant');
	}

	/**
	 *
	 * @test
	 */
	public function validateOnlyWorksForStrings() {
		$validationResult = $this->codeGenerator->validate('19qc5', 17021981);
		$this->assertTrue($validationResult, 'Validation succeeds if challenger and defender matches.');

		$validationResult = $this->codeGenerator->validate('19qc5', time());
		$this->assertFalse($validationResult, 'Validation fails if challenger and defender dont match.');
	}
}
?>