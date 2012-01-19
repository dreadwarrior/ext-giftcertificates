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
class Tx_Giftcertificates_Domain_Model_Ordering extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * orderingNumber
	 *
	 * @var string
	 */
	protected $orderingNumber;

	/**
	 * must be one of:
	 * - billing_address
	 * - billing_email
	 * - donee_address
	 * - donee_email
	 * - other_address
	 * - other_email
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $shippingType;

	/**
	 * cart
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Cart
	 */
	protected $cart;

	/**
	 * shippingAddress
	 *
	 * @var Tx_Giftcertificates_Domain_Model_ShippingAddress
	 */
	protected $shippingAddress;

	/**
	 * payment
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Payment
	 */
	protected $payment;

	/**
	 * billingAddress
	 *
	 * @var Tx_Giftcertificates_Domain_Model_BillingAddress
	 */
	protected $billingAddress;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the orderingNumber
	 *
	 * @return string $orderingNumber
	 */
	public function getOrderingNumber() {
		return $this->orderingNumber;
	}

	/**
	 * Sets the orderingNumber
	 *
	 * @param string $orderingNumber
	 * @return void
	 */
	public function setOrderingNumber($orderingNumber) {
		$this->orderingNumber = $orderingNumber;
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
	 * Returns the cart
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Cart $cart
	 */
	public function getCart() {
		return $this->cart;
	}

	/**
	 * Sets the cart
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Cart $cart
	 * @return void
	 */
	public function setCart(Tx_Giftcertificates_Domain_Model_Cart $cart) {
		$this->cart = $cart;
	}

	/**
	 * Returns the shippingAddress
	 *
	 * @return Tx_Giftcertificates_Domain_Model_ShippingAddress $shippingAddress
	 */
	public function getShippingAddress() {
		return $this->shippingAddress;
	}

	/**
	 * Sets the shippingAddress
	 *
	 * @param Tx_Giftcertificates_Domain_Model_ShippingAddress $shippingAddress
	 * @return void
	 */
	public function setShippingAddress(Tx_Giftcertificates_Domain_Model_ShippingAddress $shippingAddress) {
		$this->shippingAddress = $shippingAddress;
	}

	/**
	 * Returns the payment
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Payment $payment
	 */
	public function getPayment() {
		return $this->payment;
	}

	/**
	 * Sets the payment
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Payment $payment
	 * @return void
	 */
	public function setPayment(Tx_Giftcertificates_Domain_Model_Payment $payment) {
		$this->payment = $payment;
	}

	/**
	 * Returns the billingAddress
	 *
	 * @return Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress
	 */
	public function getBillingAddress() {
		return $this->billingAddress;
	}

	/**
	 * Sets the billingAddress
	 *
	 * @param Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress
	 * @return void
	 */
	public function setBillingAddress(Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress) {
		$this->billingAddress = $billingAddress;
	}

}
?>