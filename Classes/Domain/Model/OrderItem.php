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
class Tx_Giftcertificates_Domain_Model_OrderItem extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * identification for the certificate; root level OrderItem only
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $identification;

	/**
	 * reflects amount of selected articles (NOT certificates!)
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $amount;

	/**
	 * reflects price of an certificate or article
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $value;

	/**
	 * reflect property coupon's selected articles
	 *
	 * @var Tx_Giftcertificates_Domain_Model_OrderItem
	 */
	protected $parentOrderItem;

	/**
	 * certificate
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Certificate
	 */
	protected $certificate;

	/**
	 * article
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Article
	 */
	protected $article;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

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
	 * Returns the amount
	 *
	 * @return integer $amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Sets the amount
	 *
	 * @param integer $amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
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
	 * Returns the parentOrderItem
	 *
	 * @return Tx_Giftcertificates_Domain_Model_OrderItem $parentOrderItem
	 */
	public function getParentOrderItem() {
		return $this->parentOrderItem;
	}

	/**
	 * Sets the parentOrderItem
	 *
	 * @param Tx_Giftcertificates_Domain_Model_OrderItem $parentOrderItem
	 * @return void
	 */
	public function setParentOrderItem(Tx_Giftcertificates_Domain_Model_OrderItem $parentOrderItem) {
		$this->parentOrderItem = $parentOrderItem;
	}

	/**
	 * Returns the certificate
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 */
	public function getCertificate() {
		return $this->certificate;
	}

	/**
	 * Sets the certificate
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function setCertificate(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->certificate = $certificate;
	}

	/**
	 * Returns the article
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Article $article
	 */
	public function getArticle() {
		return $this->article;
	}

	/**
	 * Sets the article
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Article $article
	 * @return void
	 */
	public function setArticle(Tx_Giftcertificates_Domain_Model_Article $article) {
		$this->article = $article;
	}

}
?>