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
 * @package Giftcertificates
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
   * 
   * @var Tx_Extbase_Object_ObjectManagerInterface
   */
  protected $objectManager = NULL;

  /**
   * 
   * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
   */
  protected $configurationManager = NULL;

  /**
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
   * @param string $name of file
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
    /**
     * 1. read layout
     * 2. inject personalization image
     * 3. create TS parser instance
     * 4. perform cObject rendering
     * 5. return image/image resource
     */

    // read layout
    $layoutFile = $certificate->getTemplate()->getLayout();
    $layoutContent = t3lib_div::getUrl($this->layoutDirectory . $layoutFile);

    // create parser and parse layout setup
    $parser = $this->objectManager->get('t3lib_TSparser');
    $parser->parse($layoutContent);

    if (!$this->validateLayout($parser->setup)) {
      throw new Tx_Extbase_Configuration_Exception_ParseError('The specified layout is not valid. Please read the documentation and make sure the layout setup complies with the layout setup rules.', 1321029265);
    }

    // @todo: inject personalization image by rewriting the layout setup
    reset($parser->setup);
    $entryPoint = key($parser->setup) .'.';

    $setup = array();
    $found = $prevKey = $nextKey = NULL;
    foreach ($parser->setup[$entryPoint]['file.'] as $confKey => $confValue) {
      // flag found state
      if ('PERSONALIZATION_IMAGE' === $confKey) {
        $found = TRUE;

        continue;
      }

      // store setup
      if ('PERSONALIZATION_IMAGE.' === $confKey) {
        $personalizationImageSetup = $confValue;

        continue;
      }

      $setup[$confKey] = $confValue;

      if (NULL === $found) {
        $prevKey = $confKey;
      }
      if (NULL === $nextKey) {
        $nextKey = $confKey;
      }
    }

    $prevKeyVal = intval($prevKey);
    $nextKeyVal = intval($nextKey);

    // perform cObject rendering
    $cObj = $this->objectManager->get('tslib_cObj');

    return $cObj->cObjGet($setup);
  }

  /**
   * validates a layout setup array by specific rules
   * 
   * The rules are as follows:
   * - only one TLO
   * - TLO must be 'IMAGE'
   * - IMAGE.file must be 'GIFBUILDER'
   * - IMAGE.file.PERSONALIZATION_IMAGE must exist
   * 
   * @param array $layoutSetup the layout setup
   * @return boolean TRUE if layout is valid, FALSE otherwise
   */
  protected function validateLayout(array $layoutSetup) {
    // to be save that we'll start at the first item with current()/key() retrieval
    reset($layoutSetup);

    $isSingleTLO = 1 === count($layoutSetup);
    $isImageTLO = 'IMAGE' === current($layoutSetup);

    // if setup starts with 10 = IMAGE, entryPoint will be '10.'
    $entryPoint = key($layoutSetup) .'.';

    $isGifbuilderResource = isset($layoutSetup[$entryPoint]['file']) && 'GIFBUILDER' === $layoutSetup[$entryPoint]['file'];

    $hasPersonalizationImageConf = isset($layoutSetup[$entryPoint]['file.']) && isset($layoutSetup[$entryPoint]['file.']['PERSONALIZATION_IMAGE']);

    return $isSingleTLO && $isImageTLO && $isGifbuilderResource && $hasPersonalizationImageConf;
  }

  /**
   * rewrites the layout setup for a proper GIFBUILDER configuration
   * 
   * Basically, this replaces the PERSONALIZATION_IMAGE marker in the setup with
   * the correct configuration key in order.
   * 
   * @param array $setup the TS setup array
   */
  public function rewritePersonalizationImage(array $setup) {
  }
}
?>