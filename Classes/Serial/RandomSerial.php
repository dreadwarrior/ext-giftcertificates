<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
 *  All rights reserved
 *
 *  This class is a backport of the corresponding class of FLOW3.
 *  All credits go to the v5 team.
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
 * a simple serial
 * 
 * @package giftcertificates
 * @subpackage Serial
 * @author tommy
 */
class Tx_Giftcertificates_Serial_RandomSerial implements Tx_Giftcertificates_Serial_SerialInterface {

	/**
	 * alphabet of resulting serial
	 *
	 * @var string
	 */
	protected $alphabet;

	/**
	 * the length of the serial
	 *
	 * @var integer
	 */
	protected $length;

	/**
	 * injects the configuration manager
	 * 
	 * This DI method basically sets the necessary parameters 'alphabet' and 'length'
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$configuration = $configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManager::CONFIGURATION_TYPE_SETTINGS);
		$settings = $configuration['settings']['serial']['config'];

		$this->alphabet = (string) $settings['alphabet'];
		$this->length = (integer) $settings['length']['config'];

		// fall back to defaults if necessary...
		if ('' === trim($settings['alphabet'])) {
			$this->alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}

		if (1 > (int) $this->length) {
			$this->length = 12;
		}
	}

	/**
	 * generates a random serial string
	 * 
	 * The input data is not used for serial generation but you have to
	 * specify *any* kind of data here...
	 *
	 * @param mixed $input
	 * @return string
	 */
	public function generate($input) {
		$serial = '';
		$alphabetLength = strlen($this->alphabet);

		for ($i = 0; $i < $this->length; $i++) {
			$serial .= $this->alphabet[mt_rand(0, $alphabetLength - 1)];
		}
		
		return $serial;
	}

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_Serial_SerialInterface::validate()
	 */
	public function validate($challenger, $defender) {
		return $challenger === $defender;
	}
}
?>