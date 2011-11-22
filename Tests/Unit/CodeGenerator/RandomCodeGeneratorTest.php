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
 * Test case for class Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package giftcertificates
 * @subpackage Tests/CodeGenerator
 *
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class Tx_Giftcertificates_CodeGenerator_RandomCodeGeneratorTest extends Tx_Extbase_BaseTestCase {

	/**
	 *
	 * @var Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator
	 */
	protected $codeGenerator;

	public function setUp() {
		$this->codeGenerator = $this->objectManager->create('Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator');
	}

	/**
	 *
	 * @test
	 */
	public function returnedCodeDoesNotContainerAnyNumbersWithDefaultAlphabet() {
		$code = $this->codeGenerator->generate('not-used-input-data');
		$this->assertNotContains(3, $code, 'A random code does not contain any numbers with default alphabet');
	}
}
?>