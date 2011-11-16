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
 * Abstract ViewHelper for static_info_tables API
 *
 * @package giftcertificates
 * @subpackage Core/ViewHelper
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
abstract class Tx_Giftcertificates_Core_ViewHelper_AbstractStaticInfoTablesViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * holds a reference to the tx_staticinfotables_pi1 API object
	 * 
	 * @var tx_staticinfotables_pi1
	 */
	protected $api;

	public function initialize() {
		parent::initialize();

		if (!t3lib_extMgm::isLoaded('static_info_tables')) {
			throw new Tx_Extbase_Exception('To be able to use this ViewHelper you must ensure that ext:static_info_tables is installed in your TYPO3 instance', 1321475198);
		}

		$this->api = &t3lib_div::getUserObj('EXT:static_info_tables/pi1/class.tx_staticinfotables_pi1.php:&tx_staticinfotables_pi1');

		if ($this->api->needsInit()) {
			$this->api->init();
		}
	}
}
?>