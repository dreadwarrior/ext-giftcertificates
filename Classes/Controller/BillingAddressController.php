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
 *
 *
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Controller_BillingAddressController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action new
	 *
	 * @param $newBillingAddress
	 * @dontvalidate $newBillingAddress
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_BillingAddress $newBillingAddress = NULL) {
		$this->view->assign('newBillingAddress', $newBillingAddress);
	}

	/**
	 * action create
	 *
	 * @param $newBillingAddress
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_BillingAddress $newBillingAddress) {
		$this->billingAddressRepository->add($newBillingAddress);
		$this->flashMessageContainer->add('Your new BillingAddress was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $billingAddress
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress) {
		$this->view->assign('billingAddress', $billingAddress);
	}

	/**
	 * action update
	 *
	 * @param $billingAddress
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress) {
		$this->billingAddressRepository->update($billingAddress);
		$this->flashMessageContainer->add('Your BillingAddress was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $billingAddress
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress) {
		$this->billingAddressRepository->remove($billingAddress);
		$this->flashMessageContainer->add('Your BillingAddress was removed.');
		$this->redirect('list');
	}

}
?>