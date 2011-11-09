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
class Tx_Giftcertificates_Domain_Model_Certificate extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * identification
	 *
	 * @var string
	 */
	protected $identification;

  /**
   * personalMessage
   * 
   * @var string
   * @validate NotEmpty
   */
  protected $personalMessage;

	/**
	 * personalizationImage
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $personalizationImage;

	/**
	 * isRedeemed
	 *
	 * @var boolean
	 */
	protected $isRedeemed;

  /**
   * template
   * 
   * @var Tx_Giftcertificates_Domain_Model_Template
   */
  protected $template;

	/**
	 * donee
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Donee
	 */
	protected $donee;

	/**
	 * certificateArticle
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle>
	 */
	protected $certificateArticle;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->certificateArticle = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the identification
	 *
	 * @return string $identification
	 */
	public function getIdentification() {
		return $this->identification;
	}

	/**
	 * Sets the identification
	 *
	 * @param string $identification
	 * @return void
	 */
	public function setIdentification($identification) {
		$this->identification = $identification;
	}

  /**
   * Returns the personalMessage
   * 
   * @return string $personalMessage
   */
  public function getPersonalMessage() {
    return $this->personalMessage;
  }

  /**
   * Sets the personalMessage
   * 
   * @param string $personalMessage
   * @return void
   */
  public function setPersonalMessage($personalMessage) {
    $this->personalMessage = $personalMessage;
  }

	/**
	 * Returns the personalizationImage
	 *
	 * @return string $personalizationImage
	 */
	public function getPersonalizationImage() {
		return $this->personalizationImage;
	}

	/**
	 * Sets the personalizationImage
	 *
	 * @param string $personalizationImage
	 * @return void
	 */
	public function setPersonalizationImage($personalizationImage) {
		$this->personalizationImage = $personalizationImage;
	}

	/**
	 * Returns the isRedeemed
	 *
	 * @return boolean $isRedeemed
	 */
	public function getIsRedeemed() {
		return $this->isRedeemed;
	}

	/**
	 * Sets the isRedeemed
	 *
	 * @param boolean $isRedeemed
	 * @return void
	 */
	public function setIsRedeemed($isRedeemed) {
		$this->isRedeemed = $isRedeemed;
	}

	/**
	 * Returns the boolean state of isRedeemed
	 *
	 * @return boolean
	 */
	public function isIsRedeemed() {
		return $this->getIsRedeemed();
	}

	/**
	 * Returns the template
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Template $template
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * Sets the template
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Template $template
	 * @return void
	 */
	public function setTemplate(Tx_Giftcertificates_Domain_Model_Template $template) {
		$this->template = $template;
	}

	/**
	 * Returns the donee
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Donee $donee
	 */
	public function getDonee() {
		return $this->donee;
	}

	/**
	 * Sets the donee
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Donee $donee
	 * @return void
	 */
	public function setDonee(Tx_Giftcertificates_Domain_Model_Donee $donee) {
		$this->donee = $donee;
	}

	/**
	 * Adds a CertificateArticle
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle
	 * @return void
	 */
	public function addCertificateArticle(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle) {
		$this->certificateArticle->attach($certificateArticle);
	}

	/**
	 * Removes a CertificateArticle
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticleToRemove The CertificateArticle to be removed
	 * @return void
	 */
	public function removeCertificateArticle(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticleToRemove) {
		$this->certificateArticle->detach($certificateArticleToRemove);
	}

	/**
	 * Returns the certificateArticle
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle> $certificateArticle
	 */
	public function getCertificateArticle() {
		return $this->certificateArticle;
	}

	/**
	 * Sets the certificateArticle
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle> $certificateArticle
	 * @return void
	 */
	public function setCertificateArticle(Tx_Extbase_Persistence_ObjectStorage $certificateArticle) {
		$this->certificateArticle = $certificateArticle;
	}

}
?>