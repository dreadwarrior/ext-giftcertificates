<?php

/***************************************************************
 * Copyright notice
 *
 * 2011 Thomas Juhnke <tommy@van-tomas.de>
 * 
 * All rights reserved
 *
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Service to init the static_info_tables API
 *  
 *
 * @package giftcertificates
 * @subpackage Service
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class Tx_Giftcertificates_Service_StaticInfoTablesApiInitService implements t3lib_Singleton {

	/**
	* holds a reference to the tx_staticinfotables_pi1 API object
	*
	* @var tx_staticinfotables_pi1
	*/
	protected $api;

	/**
	 * initialize service object
	 *
	 * Try to create a new static_info_tables API instance
	 *
	 * @return void
	 * @throws Tx_Extbase_Exception if ext:static_info_tables is not loaded
	 */
	public function initializeObject() {
		if (!t3lib_extMgm::isLoaded('static_info_tables')) {
			throw new Tx_Extbase_Exception('In order to use this component, you must ensure that ext:static_info_tables is installed in your TYPO3 instance', 1323207511);
		}
		
		$this->api = &t3lib_div::getUserObj('EXT:static_info_tables/pi1/class.tx_staticinfotables_pi1.php:&tx_staticinfotables_pi1');
		
		if ($this->api->needsInit()) {
			$this->api->init();
		}		
	}

	/**
	 * returns the API instance
	 *
	 * @return void
	 */
	public function getApi() {
		return $this->api;
	}
}
?>