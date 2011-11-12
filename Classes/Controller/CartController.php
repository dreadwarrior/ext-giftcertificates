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
class Tx_Giftcertificates_Controller_CartController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action show
	 *
	 * @param $cart
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		$this->view->assign('cart', $cart);
	}

	/**
	 * action new
	 *
	 * @param $newCart Tx_Giftcertificates_Domain_Model_Cart
	 * @param $certificate Tx_Giftcertificates_Domain_Model_Certificate
	 * @dontvalidate $newCart
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Cart $newCart = NULL, Tx_Giftcertificates_Domain_Model_Certificate $certificate = NULL) {
		$newCart->addCertificate($certificate);
		$this->view->assign('newCart', $newCart);
	}

	/**
	 * action create
	 *
	 * @param $newCart
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Cart $newCart) {
		$this->cartRepository->add($newCart);
		$this->flashMessageContainer->add('Your new Cart was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $cart
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		$this->view->assign('cart', $cart);
	}

	/**
	 * action update
	 *
	 * @param $cart
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		$this->cartRepository->update($cart);
		$this->flashMessageContainer->add('Your Cart was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $cart
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		$this->cartRepository->remove($cart);
		$this->flashMessageContainer->add('Your Cart was removed.');
		$this->redirect('list');
	}

}
?>