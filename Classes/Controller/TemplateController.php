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
class Tx_Giftcertificates_Controller_TemplateController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * templateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_TemplateRepository
	 */
	protected $templateRepository;

  /**
   * holds a reference to the upload service
   * 
   * @var Tx_Giftcertificates_Service_UploadService
   */
  protected $uploadService = NULL;

	/**
	 * injectTemplateRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_TemplateRepository $templateRepository
	 * @return void
	 */
	public function injectTemplateRepository(Tx_Giftcertificates_Domain_Repository_TemplateRepository $templateRepository) {
		$this->templateRepository = $templateRepository;
	}

  /**
   * injects the upload service into the controller
   * 
   * @param Tx_Giftcertificates_Service_UploadService $uploadService
   * @return void
   */
  public function injectUploadService(Tx_Giftcertificates_Service_UploadService $uploadService) {
    $this->uploadService = $uploadService;
  }

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$templates = $this->templateRepository->findAll();
		$this->view->assign('templates', $templates);
	}

	/**
	 * action new
	 *
	 * @param $newTemplate
	 * @dontvalidate $newTemplate
	 * @return void
	 */
	public function newAction(Tx_Giftcertificates_Domain_Model_Template $newTemplate = NULL) {
		$this->view->assign('newTemplate', $newTemplate);
	}

	/**
	 * creates a new certificate template
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Template $newTemplate
	 * @return void
	 */
	public function createAction(Tx_Giftcertificates_Domain_Model_Template $newTemplate) {
    $uploadStatus = $this->uploadService->doUpload('backend',
      array('template', 'previewImage'), $newTemplate, 'preview_image');

    $uploadStatus = $this->uploadService->doUpload('backend',
      array('template', 'personalizationImage'), $newTemplate, 'personalization_image');

		$this->templateRepository->add($newTemplate);
		$this->flashMessageContainer->add('Your new Template was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $template
	 * @return void
	 */
	public function editAction(Tx_Giftcertificates_Domain_Model_Template $template) {
		$this->view->assign('template', $template);
	}

	/**
	 * action update
	 *
	 * @param $template
	 * @return void
	 */
	public function updateAction(Tx_Giftcertificates_Domain_Model_Template $template) {
    $uploadStatus = $this->uploadService->doUpload('backend',
      array('template', 'previewImage'), $template, 'preview_image');

    $uploadStatus = $this->uploadService->doUpload('backend',
      array('template', 'personalizationImage'), $template, 'personalization_image');

    if ($this->request->hasArgument('personalizationImage')) {
      $paramPersonalizationImage = $this->request->getArgument('personalizationImage');
      $paramPersonalizationImageDelete = $paramPersonalizationImage['delete'];

      foreach ($paramPersonalizationImageDelete as $paramPersonalizationImageDelete_fileName) {
        $certificate->removePersonalizationImage($paramPersonalizationImageDelete_fileName);
      }
    }

		$this->templateRepository->update($template);
		$this->flashMessageContainer->add('Your Template was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $template
	 * @return void
	 */
	public function deleteAction(Tx_Giftcertificates_Domain_Model_Template $template) {
		$this->templateRepository->remove($template);
		$this->flashMessageContainer->add('Your Template was removed.');
		$this->redirect('list');
	}

}
?>