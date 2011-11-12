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
class Tx_Giftcertificates_Controller_PaymentController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action new
	 *
	 * @param $newPayment
	 * @dontvalidate $newPayment
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Payment $newPayment = NULL) {
		if ($newPayment == NULL) { // workaround for fluid bug ##5636
			$newPayment = t3lib_div::makeInstance('Tx_Giftcertificates_Domain_Model_Payment');
		}
		$this->view->assign('newPayment', $newPayment);
	}

	/**
	 * action create
	 *
	 * @param $newPayment
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Payment $newPayment) {
		$this->paymentRepository->add($newPayment);
		$this->flashMessageContainer->add('Your new Payment was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $payment
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Payment $payment) {
		$this->view->assign('payment', $payment);
	}

	/**
	 * action update
	 *
	 * @param $payment
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Payment $payment) {
		$this->paymentRepository->update($payment);
		$this->flashMessageContainer->add('Your Payment was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $payment
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Payment $payment) {
		$this->paymentRepository->remove($payment);
		$this->flashMessageContainer->add('Your Payment was removed.');
		$this->redirect('list');
	}

}
?>