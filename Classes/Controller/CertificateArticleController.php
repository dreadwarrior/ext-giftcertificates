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
class Tx_Giftcertificates_Controller_CertificateArticleController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action new
	 *
	 * @param $newCertificateArticle
	 * @dontvalidate $newCertificateArticle
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_CertificateArticle $newCertificateArticle = NULL) {
		$this->view->assign('newCertificateArticle', $newCertificateArticle);
	}

	/**
	 * action create
	 *
	 * @param $newCertificateArticle
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_CertificateArticle $newCertificateArticle) {
		$this->certificateArticleRepository->add($newCertificateArticle);
		$this->flashMessageContainer->add('Your new CertificateArticle was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $certificateArticle
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle) {
		$this->view->assign('certificateArticle', $certificateArticle);
	}

	/**
	 * action update
	 *
	 * @param $certificateArticle
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle) {
		$this->certificateArticleRepository->update($certificateArticle);
		$this->flashMessageContainer->add('Your CertificateArticle was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $certificateArticle
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle) {
		$this->certificateArticleRepository->remove($certificateArticle);
		$this->flashMessageContainer->add('Your CertificateArticle was removed.');
		$this->redirect('list');
	}

}
?>