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
 * a serial generator based on Flickr's base_encode/base_decode
 * method for Flickr photo IDs
 * 
 * For further information see https://secure.flickr.com/groups/api/discuss/72157616713786392/
 *
 * @package giftcertificates
 * @subpackage Serial
 * @author tommy
 */
class Tx_Giftcertificates_Serial_BaseConversionSerial implements Tx_Giftcertificates_Serial_SerialInterface {

	/**
	 * the alphabet of the serial
	 * 
	 * @var string
	 */
	protected $alphabet;

	/**
	 * injects the configuration manager
	 *
	 * This DI method basically sets the necessary parameter 'alphabet'
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$configuration = $configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManager::CONFIGURATION_TYPE_SETTINGS);
		$settings = $configuration['settings']['serial']['config'];

		$this->alphabet = (string) $settings['alphabet'];

		if ('' === trim($settings['alphabet'])) {
			$this->alphabet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_Serial_SerialInterface::generate()
	 */
	public function generate($input) {
		if (FALSE === is_integer($input)) {
			throw new Tx_Extbase_Exception('The BaseConversionSerial expects an integer value for encoding!', 1321832012);
		}

		$base_count = strlen($this->alphabet);
		$encoded = '';
		while ($input >= $base_count) {
			$div = $input / $base_count;
			$mod = ($input - ($base_count * intval($div)));
			$encoded = $this->alphabet[$mod] . $encoded;
			$input = intval($div);
		}

		if ($input) {
			$encoded = $this->alphabet[$input] . $encoded;
		}

		return $encoded;
	}

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_Serial_SerialInterface::validate()
	 */
	public function validate($challenger, $defender) {
		if (FALSE === is_string($challenger)) {
			throw new Tx_Extbase_Exception('The BaseConversionSerial expects a string value for decoding!', 1321832023);
		}

		$decoded = 0;
		$multi = 1;
		while (strlen($challenger) > 0) {
			$digit = $challenger[strlen($challenger) - 1];
			$decoded += $multi * strpos($this->alphabet, $digit);
			$multi = $multi * strlen($this->alphabet);
			$challenger = substr($challenger, 0, -1);
		}
		
		return $decoded === $defender;
	}
}
?>