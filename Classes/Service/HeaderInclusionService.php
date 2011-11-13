<?php

/***************************************************************
 * Copyright notice
 *
 * 2010 Daniel Lienert <daniel@lienert.cc>, Michael Knoll <mimi@kaktusteam.de>
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
 * Service to include CSS and JavaScript files
 *  
 *
 * @package Service
 * @author Daniel Lienert <daniel@lienert.cc>
 */

class Tx_Giftcertificates_Service_HeaderInclusionService implements t3lib_Singleton {
	
	/**
	 * @var t3lib_PageRenderer
	 */
	protected $pageRenderer;

	/**
	 * 
	 * @var t3lib_TStemplate
	 */
	protected $TSTemplate = NULL;

	
	/**
	 * Initialize the object (called by objectManager)
	 * 
	 * @return void
	 */
	public function initializeObject() {
		//$this->TSTemplate = $this->objectManager->get('t3lib_TStemplate');

		if (TYPO3_MODE === 'BE') {
			$this->initializeBackend();
		} else {
			$this->initializeFrontend();
		}
	}

	/**
	 * Initialize Backend specific variables
	 * 
	 * @return void
	 */
	protected function initializeBackend() {
		$this->pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
	}

	/**
	 * Initialize Frontend specific variables
	 * 
	 * @return void
	 */
	protected function initializeFrontend() {
		$GLOBALS['TSFE']->backPath = TYPO3_mainDir;
		$this->pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
	}

	/**
	 * Adds CSS file
	 * 
	 * TODO we've set compress = FALSE, as paths (example background url) are rewritten if set to true which we do not want to happen
	 *
	 * @param string $file
	 * @param string $rel
	 * @param string $media
	 * @param string $title
	 * @param boolean $compress
	 * @param boolean $forceOnTop
	 * @return void
	 */
	public function addCSSFile($file, $rel = 'stylesheet', $media = 'all', $title = '', $compress = FALSE, $forceOnTop = FALSE, $allWrap = '') {
		$this->pageRenderer->addCssFile($this->getFileRelFileName($file), $rel, $media, $title, $compress, $forceOnTop , $allWrap);
	}

	/**
	 * Add a JS File to the header
	 * 
	 * @param string $file
	 * @param string $type
	 * @param boolean $compress
	 * @param boolean $forceOnTop
	 * @param string $allWrap
	 * @return void
	 */
	public function addJSFile($file, $type = 'text/javascript', $compress = TRUE, $forceOnTop = FALSE, $allWrap = '') {
		$this->pageRenderer->addJsFile($this->getFileRelFileName($file), $type, $compress, $forceOnTop, $allWrap);
	}

	/**
	 * @see t3lib_PageRenderer::addJsLibrary()
	 * 
	 */
	public function addJSLibrary($name, $file, $type = 'text/javascript', $compress = FALSE, $forceOnTop = FALSE, $allWrap = '', $excludeFromConcatenation = FALSE) {
		$this->pageRenderer->addJsLibrary($name, $this->getFileRelFileName($file), $type, $compress, $forceOnTop, $allWrap, $excludeFromConcatenation);
	}

	public function addCssInlineCode() {
	}

	/**
	 * Add JS inline code
	 *
	 * @param string $name
	 * @param string $block
	 * @param boolean $compress
	 * @param boolean $forceOnTop
	 */
	public function addJSInlineCode($name, $block, $compress = TRUE, $forceOnTop = FALSE) {
		$this->pageRenderer->addJsInlineCode($name, $block, $compress, $forceOnTop);
	}

	/**
	 * Expand the EXT to a relative path
	 * TODO: replace with T3 Method if found
	 * 
	 * @param string $filename
	 */
	public function getFileRelFileName($filename) {

		if (substr($filename, 0, 4) == 'EXT:') { // extension
			list($extKey, $local) = explode('/', substr($filename, 4), 2);
			$filename = '';
			if (strcmp($extKey, '') && t3lib_extMgm::isLoaded($extKey) && strcmp($local, '')) {
				if(TYPO3_MODE === 'FE') {
					$filename = t3lib_extMgm::siteRelPath($extKey) . $local;
				} else {
					$filename = t3lib_extMgm::extRelPath($extKey) . $local;
				}
			}
		}

		return $filename;
	}
}
?>