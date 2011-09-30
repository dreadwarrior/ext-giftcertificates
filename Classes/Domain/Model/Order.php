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
class Tx_Giftcertificates_Domain_Model_Order extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * orderNumber
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $orderNumber;

	/**
	 * shippingType
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $shippingType;

	/**
	 * paymentType
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $paymentType;

	/**
	 * either payed or not...
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $paymentStatus;

	/**
	 * transaction id of external payment provider or empty if payment on account
	 *
	 * @var string
	 */
	protected $paymentTransactionId;

	/**
	 * orderItems
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_OrderItem>
	 */
	protected $orderItems;

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
		$this->orderItems = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the orderNumber
	 *
	 * @return string $orderNumber
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * Sets the orderNumber
	 *
	 * @param string $orderNumber
	 * @return void
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
	}

	/**
	 * Returns the shippingType
	 *
	 * @return integer $shippingType
	 */
	public function getShippingType() {
		return $this->shippingType;
	}

	/**
	 * Sets the shippingType
	 *
	 * @param integer $shippingType
	 * @return void
	 */
	public function setShippingType($shippingType) {
		$this->shippingType = $shippingType;
	}

	/**
	 * Returns the paymentType
	 *
	 * @return integer $paymentType
	 */
	public function getPaymentType() {
		return $this->paymentType;
	}

	/**
	 * Sets the paymentType
	 *
	 * @param integer $paymentType
	 * @return void
	 */
	public function setPaymentType($paymentType) {
		$this->paymentType = $paymentType;
	}

	/**
	 * Returns the paymentStatus
	 *
	 * @return integer $paymentStatus
	 */
	public function getPaymentStatus() {
		return $this->paymentStatus;
	}

	/**
	 * Sets the paymentStatus
	 *
	 * @param integer $paymentStatus
	 * @return void
	 */
	public function setPaymentStatus($paymentStatus) {
		$this->paymentStatus = $paymentStatus;
	}

	/**
	 * Returns the paymentTransactionId
	 *
	 * @return string $paymentTransactionId
	 */
	public function getPaymentTransactionId() {
		return $this->paymentTransactionId;
	}

	/**
	 * Sets the paymentTransactionId
	 *
	 * @param string $paymentTransactionId
	 * @return void
	 */
	public function setPaymentTransactionId($paymentTransactionId) {
		$this->paymentTransactionId = $paymentTransactionId;
	}

	/**
	 * Adds a OrderItem
	 *
	 * @param Tx_Giftcertificates_Domain_Model_OrderItem $orderItem
	 * @return void
	 */
	public function addOrderItem(Tx_Giftcertificates_Domain_Model_OrderItem $orderItem) {
		$this->orderItems->attach($orderItem);
	}

	/**
	 * Removes a OrderItem
	 *
	 * @param Tx_Giftcertificates_Domain_Model_OrderItem $orderItemToRemove The OrderItem to be removed
	 * @return void
	 */
	public function removeOrderItem(Tx_Giftcertificates_Domain_Model_OrderItem $orderItemToRemove) {
		$this->orderItems->detach($orderItemToRemove);
	}

	/**
	 * Returns the orderItems
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_OrderItem> $orderItems
	 */
	public function getOrderItems() {
		return $this->orderItems;
	}

	/**
	 * Sets the orderItems
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_OrderItem> $orderItems
	 * @return void
	 */
	public function setOrderItems(Tx_Extbase_Persistence_ObjectStorage $orderItems) {
		$this->orderItems = $orderItems;
	}

}
?>