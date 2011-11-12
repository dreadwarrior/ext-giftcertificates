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
class Tx_Giftcertificates_Domain_Model_Payment extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * type
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $type;

	/**
	 * ccName
	 *
	 * @var string
	 */
	protected $ccName;

	/**
	 * ccExpiryDate
	 *
	 * @var DateTime
	 */
	protected $ccExpiryDate;

	/**
	 * ccNumber
	 *
	 * @var string
	 */
	protected $ccNumber;

	/**
	 * isPayed
	 *
	 * @var boolean
	 * @validate NotEmpty
	 */
	protected $isPayed;

	/**
	 * transactionId
	 *
	 * @var string
	 */
	protected $transactionId;

	/**
	 * billingRecipient
	 *
	 * @var Tx_Giftcertificates_Domain_Model_BillingAddress
	 */
	protected $billingRecipient;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the type
	 *
	 * @return integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the ccName
	 *
	 * @return string $ccName
	 */
	public function getCcName() {
		return $this->ccName;
	}

	/**
	 * Sets the ccName
	 *
	 * @param string $ccName
	 * @return void
	 */
	public function setCcName($ccName) {
		$this->ccName = $ccName;
	}

	/**
	 * Returns the ccExpiryDate
	 *
	 * @return DateTime $ccExpiryDate
	 */
	public function getCcExpiryDate() {
		return $this->ccExpiryDate;
	}

	/**
	 * Sets the ccExpiryDate
	 *
	 * @param DateTime $ccExpiryDate
	 * @return void
	 */
	public function setCcExpiryDate($ccExpiryDate) {
		$this->ccExpiryDate = $ccExpiryDate;
	}

	/**
	 * Returns the ccNumber
	 *
	 * @return string $ccNumber
	 */
	public function getCcNumber() {
		return $this->ccNumber;
	}

	/**
	 * Sets the ccNumber
	 *
	 * @param string $ccNumber
	 * @return void
	 */
	public function setCcNumber($ccNumber) {
		$this->ccNumber = $ccNumber;
	}

	/**
	 * Returns the isPayed
	 *
	 * @return boolean $isPayed
	 */
	public function getIsPayed() {
		return $this->isPayed;
	}

	/**
	 * Sets the isPayed
	 *
	 * @param boolean $isPayed
	 * @return void
	 */
	public function setIsPayed($isPayed) {
		$this->isPayed = $isPayed;
	}

	/**
	 * Returns the boolean state of isPayed
	 *
	 * @return boolean
	 */
	public function isIsPayed() {
		return $this->getIsPayed();
	}

	/**
	 * Returns the transactionId
	 *
	 * @return string $transactionId
	 */
	public function getTransactionId() {
		return $this->transactionId;
	}

	/**
	 * Sets the transactionId
	 *
	 * @param string $transactionId
	 * @return void
	 */
	public function setTransactionId($transactionId) {
		$this->transactionId = $transactionId;
	}

	/**
	 * Returns the billingRecipient
	 *
	 * @return Tx_Giftcertificates_Domain_Model_BillingAddress $billingRecipient
	 */
	public function getBillingRecipient() {
		return $this->billingRecipient;
	}

	/**
	 * Sets the billingRecipient
	 *
	 * @param Tx_Giftcertificates_Domain_Model_BillingAddress $billingRecipient
	 * @return void
	 */
	public function setBillingRecipient(Tx_Giftcertificates_Domain_Model_BillingAddress $billingRecipient) {
		$this->billingRecipient = $billingRecipient;
	}

}
?>