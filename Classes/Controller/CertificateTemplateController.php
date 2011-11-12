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
class Tx_Giftcertificates_Controller_CertificateTemplateController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * certificateTemplateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateTemplateRepository
	 */
	protected $certificateTemplateRepository;

	/**
	 * upload service
	 * 
	 * holds a reference to the upload service for this controller
	 * 
	 * @var Tx_Giftcertificates_Service_Upload
	 */
	protected $uploadService;

	/**
	 * injectCertificateTemplateRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CertificateTemplateRepository $certificateTemplateRepository
	 * @return void
	 */
	public function injectCertificateTemplateRepository(Tx_Giftcertificates_Domain_Repository_CertificateTemplateRepository $certificateTemplateRepository) {
		$this->certificateTemplateRepository = $certificateTemplateRepository;
	}

	/**
	 * injects the upload service
	 * 
	 * @param Tx_Giftcertificates_Service_Upload $uploadService
	 * @return void
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
		$certificateTemplates = $this->certificateTemplateRepository->findAll();
		$this->view->assign('certificateTemplates', $certificateTemplates);
	}

	/**
	 * action show
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate) {
		$this->view->assign('certificateTemplate', $certificateTemplate);
	}

	/**
	 * action new
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $newCertificateTemplate
	 * @dontvalidate $newCertificateTemplate
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $newCertificateTemplate = NULL) {
		$this->view->assign('newCertificateTemplate', $newCertificateTemplate);
	}

	/**
	 * action create
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $newCertificateTemplate
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $newCertificateTemplate) {
		$uploadStatus = $this->uploadService->doUpload('backend',
			array('newCertificateTemplate', 'previewImage'), $newCertificateTemplate, 'preview_image');

		$uploadStatus = $this->uploadService->doUpload('backend',
			array('newCertificateTemplate', 'personalizationImage'), $newCertificateTemplate, 'personalization_image');

		$this->certificateTemplateRepository->add($newCertificateTemplate);
		$this->flashMessageContainer->add('Your new CertificateTemplate was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param Tx_Giftcertificates_Domain_model_CertificateTemplate $certificateTemplate
	 * @dontvalidate $certificateTemplate
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate) {
		$this->view->assign('certificateTemplate', $certificateTemplate);
	}

	/**
	 * action update
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate) {
		echo '<pre>' . print_r($certificateTemplate, true) . '</pre>';
		$uploadStatus = $this->uploadService->doUpload('backend',
			array('certificateTemplate', 'previewImage'), $certificateTemplate, 'preview_image');

		$uploadStatus = $this->uploadService->doUpload('backend',
			array('certificateTempalte', 'personalizationImage'), $certificateTemplate, 'personalization_image');

		if ($this->request->hasArgument('personalizationImage')) {
			$paramPersonalizationImage = $this->request->getArgument('personalizationImage');
			$paramPersonalizationImageDelete = $paramPersonalizationImage['delete'];

			foreach ($paramPersonalizationImageDelete as $paramPersonalizationImageDelete_filename) {
				$certificateTemplate->removePersonalizationImage($personalizationImageDelete_filename);
			}
		}

		echo '<pre>' . print_r($certificateTemplate, true) . '</pre>';
		die();

		$this->certificateTemplateRepository->update($certificateTemplate);
		$this->flashMessageContainer->add('Your CertificateTemplate was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTempltae $certificateTemplate
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate) {
		$this->certificateTemplateRepository->remove($certificateTemplate);
		$this->flashMessageContainer->add('Your CertificateTemplate was removed.');
		$this->redirect('list');
	}

}
?>