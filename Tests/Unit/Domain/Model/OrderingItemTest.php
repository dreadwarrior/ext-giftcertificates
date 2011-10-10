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
 * Test case for class Tx_Giftcertificates_Domain_Model_OrderingItem.
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
class Tx_Giftcertificates_Domain_Model_OrderingItemTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Giftcertificates_Domain_Model_OrderingItem
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Giftcertificates_Domain_Model_OrderingItem();
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
	public function getAmountReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getAmount()
		);
	}

	/**
	 * @test
	 */
	public function setAmountForIntegerSetsAmount() { 
		$this->fixture->setAmount(12);

		$this->assertSame(
			12,
			$this->fixture->getAmount()
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
	public function getParentOrderingItemReturnsInitialValueForTx_Giftcertificates_Domain_Model_OrderingItem() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getParentOrderingItem()
		);
	}

	/**
	 * @test
	 */
	public function setParentOrderingItemForTx_Giftcertificates_Domain_Model_OrderingItemSetsParentOrderingItem() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_OrderingItem();
		$this->fixture->setParentOrderingItem($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getParentOrderingItem()
		);
	}
	
	/**
	 * @test
	 */
	public function getCertificateReturnsInitialValueForTx_Giftcertificates_Domain_Model_Certificate() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getCertificate()
		);
	}

	/**
	 * @test
	 */
	public function setCertificateForTx_Giftcertificates_Domain_Model_CertificateSetsCertificate() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_Certificate();
		$this->fixture->setCertificate($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getCertificate()
		);
	}
	
	/**
	 * @test
	 */
	public function getArticleReturnsInitialValueForTx_Giftcertificates_Domain_Model_Article() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getArticle()
		);
	}

	/**
	 * @test
	 */
	public function setArticleForTx_Giftcertificates_Domain_Model_ArticleSetsArticle() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_Article();
		$this->fixture->setArticle($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getArticle()
		);
	}
	
}
?>