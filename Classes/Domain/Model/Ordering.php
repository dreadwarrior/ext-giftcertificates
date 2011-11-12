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
class Tx_Giftcertificates_Domain_Model_Ordering extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * the order number
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $identification;

	/**
	 * flags if the user opts in to the newsletter
	 *
	 * @var boolean
	 * @validate NotEmpty
	 */
	protected $newsletterOptIn;

	/**
	 * cart
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Cart
	 */
	protected $cart;

	/**
	 * payment
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Payment
	 */
	protected $payment;

	/**
	 * shipping
	 *
	 * @var Tx_Giftcertificates_Domain_Model_Shipping
	 */
	protected $shipping;

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
	 * Returns the newsletterOptIn
	 *
	 * @return boolean $newsletterOptIn
	 */
	public function getNewsletterOptIn() {
		return $this->newsletterOptIn;
	}

	/**
	 * Sets the newsletterOptIn
	 *
	 * @param boolean $newsletterOptIn
	 * @return void
	 */
	public function setNewsletterOptIn($newsletterOptIn) {
		$this->newsletterOptIn = $newsletterOptIn;
	}

	/**
	 * Returns the boolean state of newsletterOptIn
	 *
	 * @return boolean
	 */
	public function isNewsletterOptIn() {
		return $this->getNewsletterOptIn();
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
	 * Returns the shipping
	 *
	 * @return Tx_Giftcertificates_Domain_Model_Shipping $shipping
	 */
	public function getShipping() {
		return $this->shipping;
	}

	/**
	 * Sets the shipping
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Shipping $shipping
	 * @return void
	 */
	public function setShipping(Tx_Giftcertificates_Domain_Model_Shipping $shipping) {
		$this->shipping = $shipping;
	}

}
?>