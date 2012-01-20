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
 * domain model object
 *
 * @package giftcertificates
 * @subpackage Domain\Model
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Model_Payment extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * must be one of
	 * - bank_account ("Bankeinzug/-überweisung")
	 * - pay_pal
	 * - credit_card
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $type;

	/**
	 * creditCardName
	 *
	 * @var string
	 */
	protected $creditCardName;

	/**
	 * creditExpiryDate
	 *
	 * @var string
	 */
	protected $creditExpiryDate;

	/**
	 * creditCardNumber
	 *
	 * @var string
	 */
	protected $creditCardNumber;

	/**
	 * status
	 *
	 * @var boolean
	 */
	protected $status;

	/**
	 * transactionId
	 *
	 * a transaction ID from some external payment service
	 *
	 * @var string
	 */
	protected $transactionId;

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
	 * @return string $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param string $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the creditCardName
	 *
	 * @return string $creditCardName
	 */
	public function getCreditCardName() {
		return $this->creditCardName;
	}

	/**
	 * Sets the creditCardName
	 *
	 * @param string $creditCardName
	 * @return void
	 */
	public function setCreditCardName($creditCardName) {
		$this->creditCardName = $creditCardName;
	}

	/**
	 * Returns the creditExpiryDate
	 *
	 * @return string $creditExpiryDate
	 */
	public function getCreditExpiryDate() {
		return $this->creditExpiryDate;
	}

	/**
	 * Sets the creditExpiryDate
	 *
	 * @param string $creditExpiryDate
	 * @return void
	 */
	public function setCreditExpiryDate($creditExpiryDate) {
		$this->creditExpiryDate = $creditExpiryDate;
	}

	/**
	 * Returns the creditCardNumber
	 *
	 * @return string $creditCardNumber
	 */
	public function getCreditCardNumber() {
		return $this->creditCardNumber;
	}

	/**
	 * Sets the creditCardNumber
	 *
	 * @param string $creditCardNumber
	 * @return void
	 */
	public function setCreditCardNumber($creditCardNumber) {
		$this->creditCardNumber = $creditCardNumber;
	}

	/**
	 * Returns the status
	 *
	 * @return boolean $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param boolean $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Returns the boolean state of status
	 *
	 * @return boolean
	 */
	public function isStatus() {
		return $this->getStatus();
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

}
?>