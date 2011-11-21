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
class Tx_Giftcertificates_Domain_Model_Cart extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * totalValue
	 *
	 * @var float
	 */
	protected $totalValue;

	/**
	 * certificate
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Certificate>
	 */
	protected $certificate;


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
		$this->certificate = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Returns the totalValue
	 *
	 * @return float $totalValue
	 */
	public function getTotalValue() {
		return $this->totalValue;
	}

	/**
	 * Sets the totalValue
	 *
	 * @param float $totalValue
	 * @return void
	 */
	public function setTotalValue($totalValue) {
		$this->totalValue = $totalValue;
	}

	/**
	 * Adds a Certificate
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function addCertificate(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		$this->certificate->attach($certificate);

		$this->updateTotalValue();
	}

	/**
	 * Removes a Certificate
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificateToRemove The Certificate to be removed
	 * @return void
	 */
	public function removeCertificate(Tx_Giftcertificates_Domain_Model_Certificate $certificateToRemove) {
		$this->certificate->detach($certificateToRemove);

		$this->updateTotalValue();
	}

	/**
	 * Returns the certificate
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Certificate> $certificate
	 */
	public function getCertificate() {
		return $this->certificate;
	}

	/**
	 * Sets the certificate
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Giftcertificates_Domain_Model_Certificate> $certificate
	 * @return void
	 */
	public function setCertificate(Tx_Extbase_Persistence_ObjectStorage $certificate) {
		$this->certificate = $certificate;

		$this->updateTotalValue();
	}

	/**
	 * returns the amount of certificates in the cart
	 *
	 * @return integer
	 */
	public function getNumberOfCertificates() {
		return $this->certificate->count();
	}

	/**
	 * updates the total value of the cart
	 *
	 * Call this method everytime a certificate changes or the certificate ObjectStorage
	 * of the cart changes
	 *
	 * @return void
	 * @api
	 */
	public function updateTotalValue() {
		$value = 0;
		foreach ($this->certificate as $certificate) {
			$value += $certificate->getValue();
		}

		$this->setTotalValue($value);
	}

	/**
	 * determines if the given certificate is stored in the ObjectStorage
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $certificate
	 * @return boolean TRUE if certificate exists, FALSE otherwise
	 */
	public function hasCertificate(Tx_Giftcertificates_Domain_Model_Certificate $certificate) {
		return $this->certificate->offsetExists($certificate);
	}
}
?>