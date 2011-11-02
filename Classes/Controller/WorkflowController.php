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
 * the main controller for the frontend plugin
 * 
 * It controls the ordering, payment and other frontend related workflow
 * processes.
 *
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Controller_WorkflowController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * certificateRepository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateRepository
	 */
	protected $certificateRepository;

	/**
	 * injectCertificateRepository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository
	 * @return void
	 */
	public function injectCertificateRepository(Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository) {
		$this->certificateRepository = $certificateRepository;
	}

	public function indexAction() {
		$certificates = $this->certificateRepository->findAll();
		$this->view->assign('certificates', $certificates);
	}

	/**
	 * action show
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function showAction(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$workflowStep1Form = new Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1();
		$workflowStep1Form->setCertificate($certificate);

		//$this->view->assign('certificate', $certificate);
		$this->view->assign('form', $workflowStep1Form);

		// $this->settings = TypoScript setup under plugin.tx_giftcertificates.settings
	}

	/**
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1 $form
	 */
	public function orderAction(Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1 $form) {
		if ($this->request->hasArgument('preview')) {
			$this->forward('preview', null, null, array('form' => $form));
		}

		$this->view->assign('message', 'I\'m your order!');
	}

	/**
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1 $form
	 */
	public function previewAction(Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1 $form) {
		$this->view->assign('message', 'I\'m your preview!');

		$TSparser = $this->objectManager->create('t3lib_TSparser');
		$TSparser->parse($form->getCertificate()->getLayout());
		$setup = $TSparser->setup;

		if ('IMAGE' != $setup['10']) {
			throw new Tx_Extbase_Exception('The TLO of the layout configuration must be "IMAGE"!', 1319551146);
		}

		$pIPos = $setup['10.']['file.']['personalizationImagePosition'];
	
		$GLOBALS['TSFE']->includeTCA();
		t3lib_div::loadTCA('tx_giftcertificates_domain_model_certificate');
		$path = $GLOBALS['TCA']
			['tx_giftcertificates_domain_model_certificate']
			['columns']
			['personalization_image']
			['config']
			['uploadfolder'];

		$setup['10.']['file.'][$pIPos .'.']['file'] = $path . '/' . $form->getPersonalizationImage();

		$preview = $this->configurationManager->getContentObject()->cObjGetSingle($setup['10'], $setup['10.']);

		$this->view->assign('form', $form);
		$this->view->assign('preview', $preview);
	}
}
?>