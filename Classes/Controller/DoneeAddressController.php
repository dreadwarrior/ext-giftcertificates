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
class Tx_Giftcertificates_Controller_DoneeAddressController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action new
	 *
	 * @param $newDoneeAddress
	 * @dontvalidate $newDoneeAddress
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_DoneeAddress $newDoneeAddress = NULL) {
		$this->view->assign('newDoneeAddress', $newDoneeAddress);
	}

	/**
	 * action create
	 *
	 * @param $newDoneeAddress
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_DoneeAddress $newDoneeAddress) {
		$this->doneeAddressRepository->add($newDoneeAddress);
		$this->flashMessageContainer->add('Your new DoneeAddress was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $doneeAddress
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_DoneeAddress $doneeAddress) {
		$this->view->assign('doneeAddress', $doneeAddress);
	}

	/**
	 * action update
	 *
	 * @param $doneeAddress
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_DoneeAddress $doneeAddress) {
		$this->doneeAddressRepository->update($doneeAddress);
		$this->flashMessageContainer->add('Your DoneeAddress was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $doneeAddress
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_DoneeAddress $doneeAddress) {
		$this->doneeAddressRepository->remove($doneeAddress);
		$this->flashMessageContainer->add('Your DoneeAddress was removed.');
		$this->redirect('list');
	}

}
?>