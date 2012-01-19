<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Juhnke <tommy@van-tomas.de>
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
 * a service which will provide ordering number incrementation data
 *
 * @package giftcertificates
 * @subpackage Service
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Service_OrderingNumberingService implements t3lib_Singleton {

	/**
	 * a configuration manager instance
	 *
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
	 */
	protected $configurationManger;

	/**
	 * the configuration incrementation method
	 *
	 * @var string
	 */
	protected $incrementationMethod;

	/**
   * the current incrementation offset
   *
   * gets raised after multiple calls, if order number isn't unique (exists in database)
   *
   * @var integer
	 */
	protected $incrementOffset = 0;

	/**
	 * injects the configuration manager
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}

	/**
	 * initializes the service object
	 * 
	 * @return void
	 */
	public function initializeObject() {
		$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

		$this->incrementationMethod = $settings['orderingNumbering']['method'];
	}

	/**
	 * creates a unique ordering number
	 * 
	 * You can setup the incrementation method in the TypoScript configuration
	 *
	 * @return mixed either a string or a number, dependent on the selected incrementation method
	 */
	public function createOrderingNumber() {
		switch ($this->incrementationMethod) {
			case "date":
				$orderingNumber = date('Y-m-') . ++$this->incrementOffset;
			break;
			case "integer":
			default:
				$orderingNumber = ++$this->incrementOffset;
			break;
		}

		return $orderingNumber;
	}
}
?>