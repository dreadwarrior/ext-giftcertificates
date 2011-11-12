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
class Tx_Giftcertificates_Controller_CertificateController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action show; performs the preview of the certificate
	 *
	 * @param $certificate
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->view->assign('certificate', $certificate);
	}

	/**
	 * action new
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $newCertificate
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate
	 * @dontvalidate $newCertificate
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate = NULL, Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate = NULL) {
		if ($newCertificate == NULL) { // workaround for fluid bug ##5636
			$newCertificate = t3lib_div::makeInstance('Tx_Giftcertificates_Domain_Model_Certificate');
		}
		$newCertificate->setCertificateTemplate($certificateTemplate);
		$this->view->assign('newCertificate', $newCertificate);
	}

	/**
	 * action create
	 *
	 * @param $newCertificate
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate) {
		/*
		$this->certificateRepository->add($newCertificate);
		$this->flashMessageContainer->add('Your new Certificate was created.');
		$this->redirect('list');
		*/
		$this->redirect('new', 'cart', NULL, array('newCart' => NULL, 'certificate' => $newCertificate));
	}

	/**
	 * action edit
	 *
	 * @param $certificate
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
		$this->flashMessageContainer->add('Your Certificate was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $certificate
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->certificateRepository->remove($certificate);
		$this->flashMessageContainer->add('Your Certificate was removed.');
		$this->redirect('list');
	}

}
?>