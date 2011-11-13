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
 * This select viewhelper works like the original one but it also supports l10n values
 * which are read either by the given path in the value or by specific options given in
 * the l10nFile argument
 *
 * @package giftcertificates
 * @subpackage ViewHelpers/Form
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_ViewHelpers_Form_SelectViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper {

	/**
	 * (non-PHPdoc)
	 * 
	 * @see Tx_Fluid_ViewHelpers_Form_SelectViewHelper::initializeArguments()
	 */
	public function initializeArguments() {
		parent::initializeArguments();

		$this->registerArgument('l10nFile', 'string', 'Specifies the path to the l10n file to use for label translation.');
	}

	/**
	 * Render one option tag
	 *
	 * @param string $value value attribute of the option tag (will be escaped)
	 * @param string $label content of the option tag (will be escaped)
	 * @param boolean $isSelected specifies wheter or not to add selected attribute
	 * @return string the rendered option tag
	 * @author Bastian Waidelich <bastian@typo3.org>
	 * @author Thomas Juhnke <tommy@van-tomas.de>
	 */
	protected function renderOptionTag($value, $label, $isSelected) {
		$output = '<option value="' . htmlspecialchars($value) . '"';
		if ($isSelected) {
			$output.= ' selected="selected"';
		}

		if ($this->isLocalizable($label)) {
			$label = $this->localizeLabel($label);
		}

		$output.= '>' . htmlspecialchars($label) . '</option>';

		return $output;
	}

	/**
	 * determines if the label is localizable
	 * 
	 * Either l10nFile argument is set or label starts with LLL:

	 * @param string $label
	 * return boolean
	 */
	protected function isLocalizable($label) {
		$hasL10nFileArgument = $this->hasArgument('l10nFile');
		$labelStartsWithLLLPrefix = t3lib_div::isFirstPartOfStr($label, 'LLL:');

		return $hasL10nFileArgument || $labelStartsWithLLLPrefix;
	}

	/**
	 * localizes a given option tag label
	 * 
	 * Lookup in l10n file given in label or via l10nFile argument of ViewHelper
	 * 
	 * @param string $label
	 * @return string
	 */
	protected function localizeLabel($label) {
		if ($this->hasArgument('l10nFile')) {
			$label = 'LLL:'. $this->arguments['l10nFile'] . ':' . $label;
		}

		$request = $this->controllerContext->getRequest();
		$extensionName = $request->getControllerExtensionName();
		$localizedLabel = Tx_Extbase_Utility_Localization::translate($label, $extensionName);

		return $localizedLabel;
	}
}
?>