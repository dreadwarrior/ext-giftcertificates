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
 * a service which will provide an identification data
 *
 * This service will initialize a SerialInterface object instance
 * and call its generate() method for return an identification code.
 *
 * @package giftcertificates
 * @subpackage Service
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Service_IdentificationService implements t3lib_Singleton {

	/**
	 * a configuration manager instance
	 *
	 * @var Tx_Extbase_Configuration_ConfigurationManager
	 */
	protected $configurationManager;

	/**
	 * an object manager instance
	 *
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * a serial generator instance
	 *
	 * @var Tx_Giftcertificates_Serial_SerialInterface
	 */
	protected $serial;

	/**
	 * injects the configuration manager
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}

	/**
	 * injects the object manager
	 *
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * initializes service
	 * 
	 * Instantiates the Serial generator
	 * 
	 * @return void
	 */
	public function initializeObject() {
		$settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);

		$serialName = 'Tx_Giftcertificates_Serial_'. $settings['serial']['class'] .'Serial';
		$this->serial = $this->objectManager->create($serialName);
	}

	/**
	 * creates identification data
	 * 
	 * @param mixed $input any value suitable for the configured serial generator
	 *
	 * @return string
	 */
	public function createIdentification($input) {
		return $this->serial->generate($input);
	}
}
?>