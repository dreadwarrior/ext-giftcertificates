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
 * controller for cart domain model object
 *
 * @package giftcertificates
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Controller_CartController extends Tx_Giftcertificates_MVC_Controller_ActionController {

	/**
	 * cartRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CartRepository
	 */
	protected $cartRepository;

	/**
	 * certificateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateRespository
	 */
	protected $certificateRepository;

	/**
	 * injectCartRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CartRepository $cartRepository
	 * @return void
	 */
	public function injectCartRepository(Tx_Giftcertificates_Domain_Repository_CartRepository $cartRepository) {
		$this->cartRepository = $cartRepository;
	}

	/**
	 * injects the certificate repository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository
	 * @return void
	 */
	public function injectCertificateRepository(Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository) {
		$this->certificateRepository = $certificateRepository;
	}

	/**
	 * action show
	 *
	 * @param $cart
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		// store cart id
		if (!$this->user->offsetExists('cart')) {
			$this->user['cart'] = $cart->getUid();
		}

		$cart->updateTotalValue();

		$this->view->assign('cart', $cart);
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

		$this->redirect('show', 'Cart', NULL, array('cart' => $newCart));
	}

	/**
	 * action edit
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Cart $cart
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @ignorevalidation $cart
	 * @ignorevalidation $certificate
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Cart $cart, Tx_Giftcertificates_Domain_Model_Certificate $certificate = NULL) {
		$cart->addCertificate($certificate);

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