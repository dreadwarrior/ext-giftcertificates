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
 * Translate a key from locallang_db. The files are loaded from the folder
 * "Resources/Private/Language/".
 *
 * == Examples ==
 *
 * <code title="Translate key">
 * <f:translate key="key1" />
 * </code>
 * <output>
 * // value of key "key1" in the current website language
 * </output>
 *
 * <code title="Keep HTML tags">
 * <f:translate key="htmlKey" htmlEscape="false" />
 * </code>
 * <output>
 * // value of key "htmlKey" in the current website language, no htmlspecialchars applied
 * </output>
 *
 * <code title="Translate key from custom locallang file">
 * <f:translate key="LLL:EXT:myext/Resources/Private/Language/locallang.xml:key1" />
 * </code>
 * <output>
 * // value of key "key1" in the current website language
 * </output>
 *
 * <code title="Inline notation with arguments and default value">
 * {f:translate(key: 'argumentsKey', arguments: {0: 'dog', 1: 'fox'}, default: 'default value')}
 * </code>
 * <output>
 * // value of key "argumentsKey" in the current website language
 * // with "%1" and "%2" are replaced by "dog" and "fox" (printf)
 * // if the key is not found, the output is "default value"
 * </output>
 */
class Tx_Giftcertificates_ViewHelpers_Be_TranslateViewHelper extends Tx_Fluid_ViewHelpers_TranslateViewHelper {

	/**
	 * Translate a given key or use the tag body as default.
	 *
	 * @param string $key The locallang_db key
	 * @param string $default if the given locallang key could not be found, this value is used. . If this argument is not set, child nodes will be used to render the default
	 * @param boolean $htmlEscape TRUE if the result should be htmlescaped. This won't have an effect for the default value
	 * @param array $arguments Arguments to be replaced in the resulting string
	 * @return string The translated key or tag body if key doesn't exist
	 * @author Christopher Hlubek <hlubek@networkteam.com>
	 * @author Bastian Waidelich <bastian@typo3.org>
	 */
	public function render($key, $default = NULL, $htmlEscape = TRUE, array $arguments = NULL) {
		$request = $this->controllerContext->getRequest();
		$extensionName = $request->getControllerExtensionName();

		// expand key to LLL:-reference to locallang_db.xml by default
		if (!t3lib_div::isFirstPartOfStr($key, 'LLL:')) {
			$key = 'LLL:EXT:' . t3lib_div::camelCaseToLowerCaseUnderscored($extensionName) . '/Resources/Private/Language/locallang_db.xml:' . $key;
		}

		return parent::render($key, $default, $htmlEscape, $arguments);
	}
}

?>