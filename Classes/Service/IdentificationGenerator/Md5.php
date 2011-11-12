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
 * This is a identification generator service which generates a MD5 identification string
 * 
 * available configuration params:
 * 
 * <code>
 * length = int+; defines the length of the resulting MD5 checksum
 * </code>
 *
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Service_IdentificationGenerator_Md5 implements t3lib_Singleton {

	/**
	 * holds the input data for the identification generation
	 * 
	 * This can be arbitrary data which is then converted into a identification value
	 * 
	 * @var string
	 */
	protected $input;

	/**
	 * holds the settings for this generatior
	 * 
	 * @var array
	 */
	protected $settings;

	/**
	 * injects the settings service and sets the settings directly
	 * 
	 * @param Tx_Giftcertifiates_Service_Settings $settingsService
	 * @return void
	 */
	public function injectSettingsService(Tx_Giftcertifiates_Service_Settings $settingsService) {
		$this->settings = $settingsService->getSettings();
	}

	/**
	 * sets input data
	 * 
	 * The input data must be a non-scalar value (like object or array), which
	 * is then serialized and stored in $this->input
	 * 
	 * @param mixed $input non-scalar data 
	 * @return void
	 * @throws Tx_Extbase_MVC_Exception_InvalidArgumentType
	 */
	public function setInput($input) {
		if (!is_object($input) || !is_array($input)) {
			throw new Tx_Extbase_MVC_Exception_InvalidArgumentType('The input data must be a non-scalar type!', 1320228007);
		}

		$this->input = serialize($input);
	}

	/**
	 * performs the generation
	 * 
	 * The generate method of the MD5 identification generator will use the
	 * input data (convert it into a suiting value) and will generate a MD5
	 * value
	 * 
	 * @return string the generated MD5 value
	 */
	public function generate() {
		$length = $this->settings['length'];

		$identification = t3lib_div::shortMD5($this->input, $length);

		return $identification;
	}
}
?>