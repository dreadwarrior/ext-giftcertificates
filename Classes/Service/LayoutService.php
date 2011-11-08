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
  const LABEL_REGEXP = '/^#\s?label=(.[^;\r\n]*).*$/Sim';

  /**
   * a regular expression to retrieve the preview image from a layout file
   * 
   * @const string
   */
  const PREVIEW_REGEXP = '/^#.*preview=(.[^\n\r]*).*$/Sim';

  /**
   * 
   * @var Tx_Extbase_Configuration_ConfigurationManagerInterface $configuration
   */
  protected $configurationManager = NULL;

  /**
   * 
   * @var array
   */
  protected $settings = array();

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
  }

  /**
   * returns the available layouts
   * 
   * @return string
   */
  public function getAvailableLayouts() {
    $absPath = t3lib_div::getFileAbsFileName($this->settings['layoutDir']);
    $files = t3lib_div::getFilesInDir($absPath);

    $layouts = array();
    foreach ($files as $fileChecksum => $fileName) {
      $this->addLayoutLabel($absPath, $fileName, $layouts);
    }

    return $layouts;
  }

  /**
   * adds the layout label to the layout stack
   * 
   * @param string $absPath absolute path to layout directory (WITH trailing slash)
   * @param string $name of file
   * @param array $layouts reference to layout stack
   * @return void
   */
  protected function addLayoutLabel($absPath, $filename, &$layouts) {
    // @todo: implement BufferedReader or something to make this more performant...
    $layoutContent = t3lib_div::getUrl($absPath . $filename);

    $labelMatches = array();
    if (FALSE !== $this->getLayoutLabel($layoutContent)) {
      $layouts[$filename] = $labelMatches[1];
    } else {
      $layouts[$filename] = $filename;
    }
  }

  /**
   * fetches the label from a layout
   * 
   * @param string $subject the layout
   * @return mixed string if label was found, FALSE otherwise
   */
  protected function getLayoutLabel($subject) {
    $matches = array();
    if (preg_match(self::LABEL_REGEXP, $subject, $matches)) {
      return $matches[1];
    }

    return FALSE;
  }

  /**
   * renders the layout from the given $layoutFile
   * 
   * @param string filename of layout
   * @return mixed
   */
  public function renderLayout($layoutFile) {
    return 'WIP';
  }
}
?>