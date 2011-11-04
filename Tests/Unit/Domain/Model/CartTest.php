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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_Giftcertificates_Domain_Model_Cart.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Gift certificate system
 *
 * @author Thomas Juhnke <tommy@van-tomas.de>
 */
class Tx_Giftcertificates_Domain_Model_CartTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Giftcertificates_Domain_Model_Cart
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Giftcertificates_Domain_Model_Cart();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getTotalValueReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getTotalValue()
		);
	}

	/**
	 * @test
	 */
	public function setTotalValueForFloatSetsTotalValue() { 
		$this->fixture->setTotalValue(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getTotalValue()
		);
	}
	
	/**
	 * @test
	 */
	public function getCertificateReturnsInitialValueForObjectStorageContainingTx_Giftcertificates_Domain_Model_Certificate() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCertificate()
		);
	}

	/**
	 * @test
	 */
	public function setCertificateForObjectStorageContainingTx_Giftcertificates_Domain_Model_CertificateSetsCertificate() { 
		$certificate = new Tx_Giftcertificates_Domain_Model_Certificate();
		$objectStorageHoldingExactlyOneCertificate = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificate->attach($certificate);
		$this->fixture->setCertificate($objectStorageHoldingExactlyOneCertificate);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCertificate,
			$this->fixture->getCertificate()
		);
	}
	
	/**
	 * @test
	 */
	public function addCertificateToObjectStorageHoldingCertificate() {
		$certificate = new Tx_Giftcertificates_Domain_Model_Certificate();
		$objectStorageHoldingExactlyOneCertificate = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificate->attach($certificate);
		$this->fixture->addCertificate($certificate);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCertificate,
			$this->fixture->getCertificate()
		);
	}

	/**
	 * @test
	 */
	public function removeCertificateFromObjectStorageHoldingCertificate() {
		$certificate = new Tx_Giftcertificates_Domain_Model_Certificate();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($certificate);
		$localObjectStorage->detach($certificate);
		$this->fixture->addCertificate($certificate);
		$this->fixture->removeCertificate($certificate);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCertificate()
		);
	}
	
}
?>