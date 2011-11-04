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
 * Test case for class Tx_Giftcertificates_Domain_Model_Certificate.
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
class Tx_Giftcertificates_Domain_Model_CertificateTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Giftcertificates_Domain_Model_Certificate
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Giftcertificates_Domain_Model_Certificate();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getIdentificationReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIdentificationForStringSetsIdentification() { 
		$this->fixture->setIdentification('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIdentification()
		);
	}
	
	/**
	 * @test
	 */
	public function getPersonalizationImageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPersonalizationImageForStringSetsPersonalizationImage() { 
		$this->fixture->setPersonalizationImage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPersonalizationImage()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsRedeemedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsRedeemed()
		);
	}

	/**
	 * @test
	 */
	public function setIsRedeemedForBooleanSetsIsRedeemed() { 
		$this->fixture->setIsRedeemed(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsRedeemed()
		);
	}
	
	/**
	 * @test
	 */
	public function getDoneeReturnsInitialValueForTx_Giftcertificates_Domain_Model_Donee() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getDonee()
		);
	}

	/**
	 * @test
	 */
	public function setDoneeForTx_Giftcertificates_Domain_Model_DoneeSetsDonee() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_Donee();
		$this->fixture->setDonee($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getDonee()
		);
	}
	
	/**
	 * @test
	 */
	public function getCertificateArticleReturnsInitialValueForObjectStorageContainingTx_Giftcertificates_Domain_Model_CertificateArticle() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCertificateArticle()
		);
	}

	/**
	 * @test
	 */
	public function setCertificateArticleForObjectStorageContainingTx_Giftcertificates_Domain_Model_CertificateArticleSetsCertificateArticle() { 
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$objectStorageHoldingExactlyOneCertificateArticle = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificateArticle->attach($certificateArticle);
		$this->fixture->setCertificateArticle($objectStorageHoldingExactlyOneCertificateArticle);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCertificateArticle,
			$this->fixture->getCertificateArticle()
		);
	}
	
	/**
	 * @test
	 */
	public function addCertificateArticleToObjectStorageHoldingCertificateArticle() {
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$objectStorageHoldingExactlyOneCertificateArticle = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificateArticle->attach($certificateArticle);
		$this->fixture->addCertificateArticle($certificateArticle);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCertificateArticle,
			$this->fixture->getCertificateArticle()
		);
	}

	/**
	 * @test
	 */
	public function removeCertificateArticleFromObjectStorageHoldingCertificateArticle() {
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($certificateArticle);
		$localObjectStorage->detach($certificateArticle);
		$this->fixture->addCertificateArticle($certificateArticle);
		$this->fixture->removeCertificateArticle($certificateArticle);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCertificateArticle()
		);
	}
	
}
?>