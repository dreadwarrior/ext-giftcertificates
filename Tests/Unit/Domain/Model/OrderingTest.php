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
	public function getCartReturnsInitialValueForTx_Giftcertificates_Domain_Model_Cart() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getCart()
		);
	}

	/**
	 * @test
	 */
	public function setCartForTx_Giftcertificates_Domain_Model_CartSetsCart() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_Cart();
		$this->fixture->setCart($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getCart()
		);
	}
	
	/**
	 * @test
	 */
	public function getShippingAddressReturnsInitialValueForTx_Giftcertificates_Domain_Model_ShippingAddress() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getShippingAddress()
		);
	}

	/**
	 * @test
	 */
	public function setShippingAddressForTx_Giftcertificates_Domain_Model_ShippingAddressSetsShippingAddress() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_ShippingAddress();
		$this->fixture->setShippingAddress($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getShippingAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentReturnsInitialValueForTx_Giftcertificates_Domain_Model_Payment() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getPayment()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentForTx_Giftcertificates_Domain_Model_PaymentSetsPayment() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_Payment();
		$this->fixture->setPayment($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getPayment()
		);
	}
	
	/**
	 * @test
	 */
	public function getBillingAddressReturnsInitialValueForTx_Giftcertificates_Domain_Model_BillingAddress() { 
		$this->assertEquals(
			NULL,
			$this->fixture->getBillingAddress()
		);
	}

	/**
	 * @test
	 */
	public function setBillingAddressForTx_Giftcertificates_Domain_Model_BillingAddressSetsBillingAddress() { 
		$dummyObject = new Tx_Giftcertificates_Domain_Model_BillingAddress();
		$this->fixture->setBillingAddress($dummyObject);

		$this->assertSame(
			$dummyObject,
			$this->fixture->getBillingAddress()
		);
	}
	
}
?>