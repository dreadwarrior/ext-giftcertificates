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
class Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1 extends Tx_Extbase_DomainObject_AbstractValueObject {
	/**
	 * 
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Certificate
	 */
	protected $certificate;

	/**
	 * 
	 * @var string
	 */
	protected $personalizationImage;

	/* either... */
	/**
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	protected $articles;

	/* ...or */
	/**
	 * 
	 * @var float
	 */
	protected $value;

	/**
	 * 
	 * @var string
	 */
	protected $salutation;

	/**
	 * 
	 * @var string
	 */
	protected $firstname;

	/**
	 * 
	 * @var string
	 */
	protected $lastname;

	/**
	 * 
	 * @var string
	 */
	protected $message;

	/**
	 * 
	 * @return Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 */
	public function getCertificate() {
		return $this->certificate;
	}

	/**
	 * 
	 * @return string
	 */
	public function getPersonalizationImage() {
		return $this->personalizationImage;
	}

	/**
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	public function getArticles() {
		return $this->articles;
	}

	/**
	 * 
	 * @return float
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * 
	 * @return string
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * 
	 * @return firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * 
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * 
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 */
	public function setCertificate(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->certificate = $certificate;
	}

	// @todo: validator_fileexists; validator_isimage etc. pp
	/**
	 * 
	 * @param string $personalizationImage
	 */
	public function setPersonalizationImage($personalizationImage) {
		$this->personalizationImage = $personalizationImage;
	}

	/**
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Article>
	 */
	public function setArticles(Tx_Giftcertificates_Domain_Model_FormObject_WorkflowStep1Articles $articles) {
		$this->articles = $articles;
	}

	/**
	 * 
	 * @param float $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * 
	 * @param string $salutation
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}

	/**
	 * 
	 * @param string $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * 
	 * @param string $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * 
	 * @param string $message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	public function renderPreview($size = '480x640') {
	}
}
?>