<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * View helper which returns save button with icon
 * Note: This view helper is experimental!
 *
 * = Examples =
 *
 * <code title="Default">
 * <f:be.buttons.icon uri="{f:uri.action()}" />
 * </code>
 * <output>
 * An icon button as known from the TYPO3 backend, skinned and linked with the default action of the current controller.
 * Note: By default the "close" icon is used as image
 * </output>
 *
 * <code title="Default">
 * <f:be.buttons.icon uri="{f:uri.action(action:'new')}" icon="new_el" title="Create new Foo" />
 * </code>
 * <output>
 * This time the "new_el" icon is returned, the button has the title attribute set and links to the "new" action of the current controller.
 * </output>
 *
 * @package giftcertificates
 * @subpackage ViewHelpers\Be\Buttons
 * @author Steffen Kamper <info@sk-typo3.de>
 * @author Bastian Waidelich <bastian@typo3.org>
 * @license http://www.gnu.org/copyleft/gpl.html
 */
class Tx_Giftcertificates_ViewHelpers_Be_Buttons_IconViewHelper extends Tx_Fluid_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * array of allowed icons
	 *
	 * @var array allowed icons to be used with this view helper
	 */
	protected $allowedIcons = array();

	/**
	 * initialize the view helper
	 * 
	 * @return void
	 */
	public function initialize() {
		// set the list of allowed icons to the available icons of the sprite API
		$this->allowedIcons = $GLOBALS['TBE_STYLES']['spriteIconApi']['iconsAvailable'];
	}
	
	/**
	 * Renders an icon link as known from the TYPO3 backend
	 *
	 * @param string $uri the target URI for the link. If you want to execute JavaScript here, prefix the URI with "javascript:"
	 * @param string $icon Icon to be used. See self::allowedIcons for a list of allowed icon names
	 * @param string $title Title attribte of the resulting link
	 * @return string the rendered icon link
	 */
	public function render($uri, $icon = 'closedok', $title = '') {
		if (!in_array($icon, $this->allowedIcons)) {
			throw new Tx_Fluid_Core_ViewHelper_Exception('"' . $icon . '" is no valid icon. Allowed are "' . implode('", "', $this->allowedIcons) .'".', 1253208523);
		}

		return '<a href="' . $uri . '">' . t3lib_iconWorks::getSpriteIcon($icon, array('title' => $title)) . '</a>';
	}
}
?>