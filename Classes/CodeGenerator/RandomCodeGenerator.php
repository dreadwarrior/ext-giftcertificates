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
 * a one-way random code generator
 * 
 * @package giftcertificates
 * @subpackage CodeGenerator
 * @author tommy
 */
class Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator extends Tx_Giftcertificates_CodeGenerator_AbstractOneWayCodeGenerator {

	/**
	 * alphabet of resulting code
	 *
	 * @var string
	 */
	protected $alphabet;

	/**
	 * the length of the code
	 *
	 * @var integer
	 */
	protected $codeLength;

	/**
	 * injects the configuration manager
	 * 
	 * This DI method basically sets the necessary parameters 'alphabet' and 'codeLength'
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$configuration = $configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManager::CONFIGURATION_TYPE_SETTINGS);
		$settings = $configuration['settings']['codeGenerator']['config'];

		$this->alphabet = (string) $settings['alphabet'];
		$this->codeLength = (integer) $settings['codeLength']['config'];

		// fall back to defaults if necessary...
		if ('' === trim($settings['alphabet'])) {
			$this->alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		}

		if (1 > $this->codeLength) {
			$this->codeLength = 12;
		}
	}

	/**
	 * generates a random string
	 * 
	 * The input data is not used for code generation but you have to
	 * specify *any* kind of data here...
	 *
	 * @param mixed $input
	 * @return string
	 */
	public function generate($input) {
		$res = '';
		$alphabetLength = strlen($this->alphabet);

		for ($i = 0; $i < $this->codeLength; $i++) {
			$res .= $this->alphabet[mt_rand(0, $alphabetLength - 1)];
		}
		
		return $res;
	}
}
?>