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

/**
* This ViewHelper renders a tt_content record with the RECORDS cObj
*
* = Examples =
*
* <code title="Render tt_content record with ID 1">
* <f:ttContent source="1" />
* </code>
* <output>
* // rendered RECORDS cObj output
* </output>
*
*/
class Tx_Giftcertificates_ViewHelpers_TtContentViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * 
	 * @var Tx_Extbase_Object_ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * 
	 * @var tslib_cObj
	 */
	protected $tslib_cObj = NULL;

	/**
	 * injects objectManager into this viewhelper
	 *
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;		
	}

	public function initialize() {
		$this->tslib_cObj = $this->objectManager->create('tslib_cObj');
	}

	/**
	 * render a tt_content record
	 * 
	 * @param integer $source the tt_content record UID
	 * @return output of RECORDS cObj
	 * @throws Tx_Extbase_MVC_Exception_InvalidArgumentType if $source is not a numeric value
	 */
	public function render($source) {
		if (!is_numeric($source)) {
			throw new Tx_Extbase_MVC_Exception_InvalidArgumentType('The source parameter is no valid record ID!', 1321395096);
		}

		$conf = array(
			'source' => intval($source),
			'tables' => 'tt_content'
		);

		return $this->tslib_cObj->RECORDS($conf);
	}
}
?>