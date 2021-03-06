<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
 *
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
 * Class implements a fake viewhelper to add a javascript file to the header
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package giftcertificates
 * @subpackage ViewHelpers\Include
 * 
 */
class Tx_Giftcertificates_ViewHelpers_Include_JavascriptViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * a header inclusion service instance
	 *
	 * @var Tx_Giftcertificates_Service_HeaderInclusionService
	 */
	protected $headerInclusion = NULL;

	/**
	 * injects the header inclusion service into this view helper
	 * 
	 * @param Tx_Giftcertificates_Service_HeaderInclusionService $headerInclusion
	 * @return void
	 */
	public function injectHeaderInclusionService(Tx_Giftcertificates_Service_HeaderInclusionService $headerInclusion) {
		$this->headerInclusion = $headerInclusion;
	}

	/**
	 * adds the requested js file to the page header
	 * 
	 * @param string $file path of file
	 * @return void
	 */
	public function render($file = '') {
		if ($file) {
			$this->headerInclusion->addJSFile($file, 'text/javascript', FALSE);
		}
	}
}
?>