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
 * A multi action controller. This is by far the most common base class for Controllers.
 *
 * @package Giftcertificates
 * @subpackage MVC\Controller
 * @api
 */
class Tx_Giftcertificates_MVC_Controller_ActionController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * 
	 * @var Tx_Giftcertificates_Service_UserService
	 */
	protected $user = NULL;

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * Override this method to solve assign variables common for all actions
	 * or prepare the view in another way before the action is called.
	 *
	 * @param Tx_Extbase_MVC_View_ViewInterface $view The view to be initialized
	 * @return void
	 * @api
	 */
	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
	}

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * Override this method to solve tasks which all actions have in
	 * common.
	 *
	 * @return void
	 * @api
	 */
	protected function initializeAction() {
	}

	/**
	 * A special action which is called if the originally intended action could
	 * not be called, for example if the arguments were not valid.
	 *
	 * The default implementation sets a flash message, request errors and forwards back
	 * to the originating action. This is suitable for most actions dealing with form input.
	 *
	 * We clear the page cache by default on an error as well, as we need to make sure the
	 * data is re-evaluated when the user changes something.
	 *
	 * @return string
	 * @api
	 */
	protected function errorAction() {
		return parent::errorAction();
	}

	/**
	 * A template method for displaying custom error flash messages, or to
	 * display no flash message at all on errors. Override this to customize
	 * the flash message in your action controller.
	 *
	 * @return string|boolean The flash message or FALSE if no flash message should be set
	 * @api
	 */
	protected function getErrorFlashMessage() {
		return 'An error occurred while trying to call ' . get_class($this) . '->' . $this->actionMethodName . '()';
	}

	/**
	 * injects userService into the controller
	 * 
	 * @param Tx_Giftcertificates_Service_UserService $userService
	 * @return void
	 */
	public function injectUserService(Tx_Giftcertificates_Service_UserService $userService) {
		$this->user = $userService;
	}

	/**
	 * determine if controller is in frontend context
	 * 
	 * @return boolean
	 */
	public function isFEContext() {
		return 'FE' === TYPO3_MODE;
	}

	/**
	 * determine if controller is in backend context
	 * 
	 * @return boolean
	 */
	public function isBEContext() {
		return 'BE' === TYPO3_MODE;
	}
}
?>