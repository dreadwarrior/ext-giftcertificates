<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
 *  All rights reserved
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
 * A service for the gift certificate layouts. It provides mixed functionality
 * from retrieving valid layout files to rendering processes etc.
 *
 * @package giftcertificates
 * @subpackage Service
 */
class Tx_Giftcertificates_Service_LayoutService implements t3lib_Singleton {

	/**
	 * a regular expression to retrieve the label from a layout file
	 * 
	 * @const string
	 */
	const LABEL_REGEXP = '/^#\s?label=(.[^;\r\n]*).*$/Sims';

	/**
	 * a regular expression to retrieve the preview image from a layout file
	 * 
	 * @const string
	 */
	const PREVIEW_REGEXP = '/^#.*preview=(.[^\n\r]*).*$/Sims';

	/**
	 * an object manager instance
	 *
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager = NULL;

	/**
	 * a configuration manager instance
	 *
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
	 */
	protected $configurationManager = NULL;

	/**
	 * TS settings array
	 *
	 * @var array
	 */
	protected $settings = array();

	/**
	 * absolute path to the layout directory
	 * 
	 * @var string
	 */
	protected $layoutDirectory = '';

	/**
	 * injects the ObjectManager into this service
	 * 
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

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
	 * Initialize the object (called by objectManager)
	 * 
	 */
	public function initializeObject() {
		$this->settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		$this->layoutDirectory = t3lib_div::getFileAbsFileName($this->settings['layoutDir']);
	}

	/**
	 * returns the available layouts
	 * 
	 * @return string
	 */
	public function getAvailableLayouts() {
		$files = t3lib_div::getFilesInDir($this->layoutDirectory);

		$layouts = array();
		foreach ($files as $fileChecksum => $fileName) {
			$this->addLayoutLabel($fileName, $layouts);
		}

		return $layouts;
	}

	/**
	 * adds the layout label to the layout stack
	 * 
	 * @param string $filename name of file
	 * @param array $layouts reference to layout stack
	 * @return void
	 */
	protected function addLayoutLabel($filename, &$layouts) {
		// @todo: implement BufferedReader or something to make this more performant...
		$layoutContent = t3lib_div::getUrl($this->layoutDirectory . $filename);

		$layoutLabel = $this->getLayoutLabel($layoutContent, $filename);
		$layouts[$filename] = $layoutLabel;
	}

	/**
	 * fetches the label from a layout
	 * 
	 * @param string $subject the layout
	 * @param string the default if no label was found
	 * @return mixed string if label was found, FALSE otherwise
	 */
	protected function getLayoutLabel($subject, $default = '-- no label --') {
		$matches = array();
		if (preg_match(self::LABEL_REGEXP, $subject, $matches)) {
			return $matches[1];
		}

		return $default;
	}

	/**
	 * renders the layout from the given $certificate's template
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate 
	 * @return string rendered cObj content
	 */
	public function renderLayout(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		// read layout
		$layoutFile = $certificate->getTemplate()->getLayout();
		$layoutContent = t3lib_div::getUrl($this->layoutDirectory . $layoutFile);

		// create parser and parse layout setup
		$parser = $this->objectManager->get('t3lib_TSparser');
		$parser->parse($layoutContent);

		$this->validateLayout($parser->setup);

		// perform cObject rendering
		/* @var $cObj tslib_cObj */
		$cObj = $this->objectManager->get('tslib_cObj');
		$cObj->start(array(
			'personalizationImage' => $certificate->getPersonalizationImage()
		));

		return $cObj->cObjGet($parser->setup);
	}

	/**
	 * validates a layout setup array by specific rules
	 * 
	 * The rules are as follows:
	 * - only one TLO (actually 2 setup keys - cObj + conf)
	 * - TLO must be 'IMAGE'
	 * - IMAGE.file must be 'GIFBUILDER'
	 * 
	 * @param array $layoutSetup the layout setup
	 * @return void
	 * @throws Tx_Extbase_Configuration_Exception_ParseError if one of the rules is violated
	 */
	protected function validateLayout(array $layoutSetup) {
		// to be save that we'll start at the first item with current()/key() retrieval
		reset($layoutSetup);
		// if setup starts with 10 = IMAGE, entryPoint will be '10.'
		$entryPoint = key($layoutSetup) .'.';

		// 2 => e.g. 10 & 10.
		$isSingleTLO = 2 === count($layoutSetup);

		$isImageTLO = 'IMAGE' === current($layoutSetup);

		$isGifbuilderResource = isset($layoutSetup[$entryPoint]['file']) && 'GIFBUILDER' === $layoutSetup[$entryPoint]['file'];

		$error = array(); 

		if (!$isSingleTLO) {
			$error[] = 'no single TLO';
		}
			
		if (!$isImageTLO) {
			$error[] = 'no IMAGE TLO';
		}

		if (!$isGifbuilderResource) {
			$error[] = 'no GIFBUILDER imgResource';
		}

		if (0 < count($error)) {
			$exceptionMessage = 'The specified layout is not valid (%s). Please read the documentation and make sure the layout setup complies with the layout setup rules.';
			throw new Tx_Extbase_Configuration_Exception_ParseError(sprintf($exceptionMessage, implode(', ', $error)), 1321029265);
		}
	}
}
?>