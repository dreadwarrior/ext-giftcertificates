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
class Tx_Giftcertificates_Domain_Model_ShippingAddress extends Tx_Extbase_DomainObject_AbstractValueObject {

	/**
	 * salutation
	 *
	 * @var string
	 */
	protected $salutation;

	/**
	 * firstname
	 *
	 * @var string
	 */
	protected $firstname;

	/**
	 * lastname
	 *
	 * @var string
	 */
	protected $lastname;

	/**
	 * address
	 *
	 * @var string
	 */
	protected $address;

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip;

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city;

	/**
	 * country
	 *
	 * @var string
	 */
	protected $country;

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email;

	/**
	 * phone
	 * 
	 * @var string
	 */
	protected $phone;

	/**
	 * note
	 * 
	 * @var string
	 */
	protected $note;

	/**
	 * the shipping type
	 *
	 * this property is outsourced into the Ordering domain object; nevertheless it's
	 * necessary for customized validation of the ShippingAddress
	 * 
	 * @see Tx_Giftcertificates_Domain_Model_Ordering::shippingType
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}

	/**
	 * Returns the salutation
	 *
	 * @return string $salutation
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Sets the salutation
	 *
	 * @param string $salutation
	 * @return void
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}

	/**
	 * Returns the firstname
	 *
	 * @return string $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Sets the firstname
	 *
	 * @param string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Returns the lastname
	 *
	 * @return string $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param string $lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the country
	 *
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the phone
	 * 
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 * 
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
	}

	/**
	 * Returns the note
	 * 
	 * @return string $note
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * Sets the note
	 * 
	 * @param string $note
	 * @return void
	 */
	public function setNote($note) {
		$this->note = $note;
	}

	/**
	 * copies the data from $billingAddress into this shipping address
	 * 
	 * This method copies the following properties: salutation, firstname,
	 * lastname, zip, city, country, email, address, phone, note
	 *
	 * @param Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress
	 * @return void
	 */
	public function copyFromBillingAddress(Tx_Giftcertificates_Domain_Model_BillingAddress $billingAddress) {
		$this->setSalutation($billingAddress->getSalutation());
		$this->setFirstname($billingAddress->getFirstname());
		$this->setLastname($billingAddress->getLastname());
		$this->setZip($billingAddress->getZip());
		$this->setCity($billingAddress->getCity());
		$this->setCountry($billingAddress->getCountry());
		$this->setEmail($billingAddress->getEmail());
		$this->setAddress($billingAddress->getAddress());
		$this->setPhone($billingAddress->getPhone());
		$this->setNote($billingAddress->getNote());
	}

	/**
	 * sets the type
	 *
	 * This is (temporarily) needed for validation of the ShippingAddress domain model object
	 *
	 * @param string $type a shipping type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * returns the shipping type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * checks if a property is set (isset() === TRUE && not empty string)
	 *
	 * @param string $property name of the property in lowerCamelCase notation
	 */
	public function isPropertySet($property) {
		$method = 'get'. ucfirst($property);
		$value = call_user_func(array($this, $method));

		return isset($value) && '' !== $value;
	}
}
?>