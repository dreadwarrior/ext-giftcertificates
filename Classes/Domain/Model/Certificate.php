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
	 * a unique identification; maybe used for barcode generation
	 *
	 * @var string
	 * @validate Tx_Giftcertificates_Validation_Validator_IdentificationGeneratorValidator
	 */
	protected $identification;

	/**
	 * one of the associated certificate's personalization image
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $personalizationImage;

	/**
	 * value
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $value;

	/**
	 * personalMessage
	 *
	 * @var string
	 */
	protected $personalMessage;

	/**
	 * isRedeemed
	 *
	 * @var boolean
	 */
	protected $isRedeemed;

	/**
	 * certificateTemplate
	 *
	 * @var Tx_Giftcertificates_Domain_Model_CertificateTemplate
	 */
	protected $certificateTemplate;

	/**
	 * certificateArticles
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle>
	 */
	protected $certificateArticles;

	/**
	 * donee
	 *
	 * @var Tx_Giftcertificates_Domain_Model_DoneeAddress
	 */
	protected $donee;

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
		$this->certificateArticles = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Returns the value
	 *
	 * @return float $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Sets the value
	 *
	 * @param float $value
	 * @return void
	 */
	public function setValue($value) {
		$this->value = $value;
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
	 * Returns the isRedeemed
	 *
	 * @return boolean $isRedeemed
	 */
	public function getIsRedeemed() {
		return (boolean) $this->isRedeemed;
	}

	/**
	 * Sets the isRedeemed
	 *
	 * @param boolean $isRedeemed
	 * @return void
	 */
	public function setIsRedeemed(boolean $isRedeemed) {
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
	 * Returns the certificateTemplate
	 *
	 * @return Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate
	 */
	public function getCertificateTemplate() {
		return $this->certificateTemplate;
	}

	/**
	 * Sets the certificateTemplate
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate
	 * @return void
	 */
	public function setCertificateTemplate(Tx_Giftcertificates_Domain_Model_CertificateTemplate $certificateTemplate) {
		$this->certificateTemplate = $certificateTemplate;
	}

	/**
	 * Adds a CertificateArticle
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle
	 * @return void
	 */
	public function addCertificateArticle(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticle) {
		$this->certificateArticles->attach($certificateArticle);
	}

	/**
	 * Removes a CertificateArticle
	 *
	 * @param Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticleToRemove The CertificateArticle to be removed
	 * @return void
	 */
	public function removeCertificateArticle(Tx_Giftcertificates_Domain_Model_CertificateArticle $certificateArticleToRemove) {
		$this->certificateArticles->detach($certificateArticleToRemove);
	}

	/**
	 * Returns the certificateArticles
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle> $certificateArticles
	 */
	public function getCertificateArticles() {
		return $this->certificateArticles;
	}

	/**
	 * Sets the certificateArticles
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_CertificateArticle> $certificateArticles
	 * @return void
	 */
	public function setCertificateArticles(Tx_Extbase_Persistence_ObjectStorage $certificateArticles) {
		$this->certificateArticles = $certificateArticles;
	}

	/**
	 * Returns the donee
	 *
	 * @return Tx_Giftcertificates_Domain_Model_DoneeAddress $donee
	 */
	public function getDonee() {
		return $this->donee;
	}

	/**
	 * Sets the donee
	 *
	 * @param Tx_Giftcertificates_Domain_Model_DoneeAddress $donee
	 * @return void
	 */
	public function setDonee(Tx_Giftcertificates_Domain_Model_DoneeAddress $donee) {
		$this->donee = $donee;
	}

}
?>