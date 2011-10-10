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
 * Test case for class Tx_Giftcertificates_Domain_Model_Ordering.
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
class Tx_Giftcertificates_Domain_Model_OrderingTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Giftcertificates_Domain_Model_Ordering
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Giftcertificates_Domain_Model_Ordering();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getOrderingNumberReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setOrderingNumberForStringSetsOrderingNumber() { 
		$this->fixture->setOrderingNumber('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getOrderingNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function getShippingTypeReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getShippingType()
		);
	}

	/**
	 * @test
	 */
	public function setShippingTypeForIntegerSetsShippingType() { 
		$this->fixture->setShippingType(12);

		$this->assertSame(
			12,
			$this->fixture->getShippingType()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentTypeReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPaymentType()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentTypeForIntegerSetsPaymentType() { 
		$this->fixture->setPaymentType(12);

		$this->assertSame(
			12,
			$this->fixture->getPaymentType()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentStatusReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPaymentStatus()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentStatusForIntegerSetsPaymentStatus() { 
		$this->fixture->setPaymentStatus(12);

		$this->assertSame(
			12,
			$this->fixture->getPaymentStatus()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentTransactionIdReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPaymentTransactionIdForStringSetsPaymentTransactionId() { 
		$this->fixture->setPaymentTransactionId('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPaymentTransactionId()
		);
	}
	
	/**
	 * @test
	 */
	public function getOrderingItemsReturnsInitialValueForObjectStorageContainingTx_Giftcertificates_Domain_Model_OrderingItem() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getOrderingItems()
		);
	}

	/**
	 * @test
	 */
	public function setOrderingItemsForObjectStorageContainingTx_Giftcertificates_Domain_Model_OrderingItemSetsOrderingItems() { 
		$orderingItem = new Tx_Giftcertificates_Domain_Model_OrderingItem();
		$objectStorageHoldingExactlyOneOrderingItems = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneOrderingItems->attach($orderingItem);
		$this->fixture->setOrderingItems($objectStorageHoldingExactlyOneOrderingItems);

		$this->assertSame(
			$objectStorageHoldingExactlyOneOrderingItems,
			$this->fixture->getOrderingItems()
		);
	}
	
	/**
	 * @test
	 */
	public function addOrderingItemToObjectStorageHoldingOrderingItems() {
		$orderingItem = new Tx_Giftcertificates_Domain_Model_OrderingItem();
		$objectStorageHoldingExactlyOneOrderingItem = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneOrderingItem->attach($orderingItem);
		$this->fixture->addOrderingItem($orderingItem);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneOrderingItem,
			$this->fixture->getOrderingItems()
		);
	}

	/**
	 * @test
	 */
	public function removeOrderingItemFromObjectStorageHoldingOrderingItems() {
		$orderingItem = new Tx_Giftcertificates_Domain_Model_OrderingItem();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($orderingItem);
		$localObjectStorage->detach($orderingItem);
		$this->fixture->addOrderingItem($orderingItem);
		$this->fixture->removeOrderingItem($orderingItem);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getOrderingItems()
		);
	}
	
}
?>