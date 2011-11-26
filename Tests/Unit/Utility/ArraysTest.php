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
 *  the Free Software Foundation; either version 3 of the License, or
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

require dirname(__FILE__) . '/../../../Classes/Utility/Arrays.php';

/**
 * array manipulation utilities
 *
 * @package giftcertificates
 * @subpackage Tests/Unit/Utility
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Utility_ArraysTest extends tx_phpunit_testcase {

	/**
	 * 
	 * @test
	 */
	public function renameKeys() {
		$keys = array('newkey1', 'newkey2', 'newkey3');

		$array = array(
			'oldkey1' => 'value1',
			'oldkey2' => 'value2',
			'oldkey3' => 'value3'
		);

		Tx_Giftcertificates_Utility_Arrays::renameKeys($array, $keys);

		$this->assertArrayHasKey($keys[0], $array);
		$this->assertArrayHasKey($keys[1], $array);
		$this->assertArrayHasKey($keys[2], $array);
		$this->assertEquals(3, count($array));
	}
}
?>