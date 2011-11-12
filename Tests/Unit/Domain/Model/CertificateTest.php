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
 * @subpackage Gift certificates
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
	public function getValueReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getValue()
		);
	}

	/**
	 * @test
	 */
	public function setValueForFloatSetsValue() { 
		$this->fixture->setValue(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getValue()
		);
	}
	
	/**
	 * @test
	 */
	public function getPersonalMessageReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPersonalMessageForStringSetsPersonalMessage() { 
		$this->fixture->setPersonalMessage('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPersonalMessage()
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
	public function getCertificateTemplateReturnsInitialValueForTx_Giftcertificates_Domain_Model_CertificateTemplate() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getCertificateTemplate()
		);
	}

	/**
	 * @test
	 */
	public function setCertificateTemplateForTx_Giftcertificates_Domain_Model_CertificateTemplateSetsCertificateTemplate() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_CertificateTemplate();
		$this->fixture->setCertificateTemplate($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getCertificateTemplate()
		);
	}
	
	/**
	 * @test
	 */
	public function getCertificateArticlesReturnsInitialValueForObjectStorageContainingTx_Giftcertificates_Domain_Model_CertificateArticle() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getCertificateArticles()
		);
	}

	/**
	 * @test
	 */
	public function setCertificateArticlesForObjectStorageContainingTx_Giftcertificates_Domain_Model_CertificateArticleSetsCertificateArticles() { 
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$objectStorageHoldingExactlyOneCertificateArticles = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificateArticles->attach($certificateArticle);
		$this->fixture->setCertificateArticles($objectStorageHoldingExactlyOneCertificateArticles);

		$this->assertSame(
			$objectStorageHoldingExactlyOneCertificateArticles,
			$this->fixture->getCertificateArticles()
		);
	}
	
	/**
	 * @test
	 */
	public function addCertificateArticleToObjectStorageHoldingCertificateArticles() {
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$objectStorageHoldingExactlyOneCertificateArticle = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneCertificateArticle->attach($certificateArticle);
		$this->fixture->addCertificateArticle($certificateArticle);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneCertificateArticle,
			$this->fixture->getCertificateArticles()
		);
	}

	/**
	 * @test
	 */
	public function removeCertificateArticleFromObjectStorageHoldingCertificateArticles() {
		$certificateArticle = new Tx_Giftcertificates_Domain_Model_CertificateArticle();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($certificateArticle);
		$localObjectStorage->detach($certificateArticle);
		$this->fixture->addCertificateArticle($certificateArticle);
		$this->fixture->removeCertificateArticle($certificateArticle);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getCertificateArticles()
		);
	}
	
	/**
	 * @test
	 */
	public function getDoneeReturnsInitialValueForTx_Giftcertificates_Domain_Model_DoneeAddress() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getDonee()
		);
	}

	/**
	 * @test
	 */
	public function setDoneeForTx_Giftcertificates_Domain_Model_DoneeAddressSetsDonee() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_DoneeAddress();
		$this->fixture->setDonee($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getDonee()
		);
	}
	
}
?>