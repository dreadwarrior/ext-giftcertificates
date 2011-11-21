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
 * controller for certificate domain model object
 *
 * @package giftcertificates
 * @subpackage Controller
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Controller_CertificateController extends Tx_Giftcertificates_MVC_Controller_ActionController {

	/**
	 * certificateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateRepository
	 */
	protected $certificateRepository;

	/**
	 * cartRepository
	 * 
	 * @var Tx_Giftcertificates_Domain_Repository_CartRepository
	 */
	protected $cartRepository;

	/**
	 * layoutService
	 * 
	 * @var Tx_Giftcertificates_Service_LayoutService
	 */
	protected $layoutService;

	/**
	 * a reference to a cart (either existing by UID in session or a fresh instance)
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Cart
	 */
	protected $cart;

	/**
	 * injectCertificateRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository
	 * @return void
	 */
	public function injectCertificateRepository(Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository) {
		$this->certificateRepository = $certificateRepository;
	}

	/**
	 * injects the cart repository
	 * 
	 * @param Tx_Giftcertificates_Domain_Repository_CartRepository $cartRepository
	 * @return void
	 */
	public function injectCartRepository(Tx_Giftcertificates_Domain_Repository_CartRepository $cartRepository) {
		$this->cartRepository = $cartRepository;
	}

	/**
	 * injects the LayoutService into this controller
	 * 
	 * @param Tx_Giftcertificates_Service_LayoutService $layoutService
	 * @return void
	 */
	public function injectLayoutService(Tx_Giftcertificates_Service_LayoutService $layoutService) {
		$this->layoutService = $layoutService;
	}

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_MVC_Controller_ActionController::initializeAction()
	 */
	public function initializeAction() {
		// getting or creating a cart
		if ($this->user->offsetExists('cart')) {
			$this->cart = $this->cartRepository->findByUid($this->user['cart']);
		} else {
			$this->cart = $this->objectManager->create('Tx_Giftcertificates_Domain_Model_Cart');
		}
	}

	/**
	 * action new
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $newCertificate
	 * @param Tx_Giftcertificates_Domain_Model_Template $template
	 * @dontvalidate $newCertificate
	 * @dontvalidate $template
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate = NULL, Tx_Giftcertificates_Domain_Model_Template $template = NULL) {
		if ($newCertificate == NULL) { // workaround for fluid bug ##5636
			$newCertificate = t3lib_div::makeInstance('Tx_Giftcertificates_Domain_Model_Certificate');
		}

		if (NULL !== $template) {
			$newCertificate->setTemplate($template);
		}

		$this->view->assign('newCertificate', $newCertificate);
	}

	/**
	 * action create
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $newCertificate
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate) {
		$this->certificateRepository->add($newCertificate);

		if ($this->request->hasArgument('preview')) {
			$this->persistAllAndRedirect('show', 'Certificate', NULL, array('certificate' => $newCertificate));
		}

		$this->cart->addCertificate($newCertificate);

		if ($this->user->offsetExists('cart')) {
			$this->persistAllAndRedirect('show', 'Cart', NULL, array('cart' => $this->cart));
		}

		$this->cartRepository->add($this->cart);

		$this->persistAllAndRedirect('create', 'Cart', NULL, array('newCart' => $this->cart));
	}

	/**
	 * action edit
	 *
	 * @param $certificate
	 * @dontvalidate $certificate
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->view->assign('certificate', $certificate);
	}

	/**
	 * action update
	 *
	 * @param $certificate
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->certificateRepository->update($certificate);

		if ($this->request->hasArgument('preview')) {
			$this->persistAllAndRedirect('show', 'Certificate', NULL, array('certificate' => $certificate));
		}
		
		if (!$this->user->offsetExists('cart')) {
			throw new Tx_Extbase_Exception('No valid cart could be found for your session. Please restart the ordering.');
		}

		$this->redirect('show', 'Cart', NULL, array('cart' => $this->cart));
	}

	/**
	 * action delete
	 *
	 * @param $certificate
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->cart->removeCertificate($certificate);

		$this->certificateRepository->remove($certificate);

		$this->flashMessageContainer->add('Your Certificate was removed.');
		
		if (0 < $this->cart->getCertificate()->count()) {
			$this->redirect('show', 'Cart', NULL, array('cart' => $this->cart));
		}

		$this->redirect('list', 'Template');
	}

	/**
	 * action show
	 * 
	 * This is responsible for displaying a preview of the certificate
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$certificateImage = $this->layoutService->renderLayout($certificate);

		$this->view->assign('certificate', $certificate);
		$this->view->assign('certificateImage', $certificateImage);

		if ($this->user->offsetExists('cart') && $this->cart->hasCertificate($certificate)) {
			$this->view->assign('cart', $this->cart);
		}
	}
}
?>