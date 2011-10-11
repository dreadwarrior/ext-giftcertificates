<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>, Profi Webmedia
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
	 * certificateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateRepository
	 */
	protected $certificateRepository;

	/**
	 * upload service
	 * 
	 * @var Tx_Giftcertificates_Service_Upload
	 */
	protected $uploadService;

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
	 * @param Tx_Giftcertificates_Service_Upload $uploadService
	 */
	public function injectUploadService(Tx_Giftcertificates_Service_Upload $uploadService) {
		$this->uploadService = $uploadService;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$certificates = $this->certificateRepository->findAll();
		$this->view->assign('certificates', $certificates);
	}

	/**
	 * action show
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
	 * @param $newCertificate
	 * @dontvalidate $newCertificate
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate = NULL) {
		$this->view->assign('newCertificate', $newCertificate);

		$allowedTypes = $this->certificateRepository->getAllowedTypes();
		$this->view->assign('allowedTypes', $allowedTypes);
	}

	/**
	 * action create
	 *
	 * @param $newCertificate
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Certificate $newCertificate) {
		$uploadStatus = $this->uploadService->doUpload('backend', 
			array('certificate', 'previewImage'), $certificate, 'preview_image');

		$uploadStatus = $this->uploadService->doUpload('backend',
			array('certificate', 'personalizationImage'), $certificate, 'personalization_image');

		$this->certificateRepository->add($newCertificate);
		$this->flashMessageContainer->add('Your new Certificate was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $certificate
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->view->assign('certificate', $certificate);

		$allowedTypes = $this->certificateRepository->getAllowedTypes();
		$this->view->assign('allowedTypes', $allowedTypes);
	}

	/**
	 * action update
	 *
	 * @param $certificate
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$uploadStatus = $this->uploadService->doUpload('backend', 
			array('certificate', 'previewImage'), $certificate, 'preview_image');

		$uploadStatus = $this->uploadService->doUpload('backend',
			array('certificate', 'personalizationImage'), $certificate, 'personalization_image');

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