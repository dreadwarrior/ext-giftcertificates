<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas Juhnke <tommy@van-tomas.de>
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
 * Payment domain object validation
 *
 * @package giftcertificates
 * @subpackage Domain\Model
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Validator_PaymentValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * external payment provider list
	 *
	 * @var array
	 */
	protected $externalPaymentProvider = array('pay_pal', 'credit_card');

	/**
	 * validates the payment object
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Payment $object
	 * @return boolean
	 */
	public function isValid(Tx_Giftcertificates_Domain_Model_Payment $object) {
		if (!$object instanceof Tx_Giftcertificates_Domain_Model_Payment) {
			$msg = sprintf('Object to be validated is not of correct type (' . get_class($object) . '). Must be Tx_Giftcertificates_Domain_Model_Payment.');
			$this->addError($msg, 1326894465);

			return FALSE;
		}

		// check if transactionId is empty if an external payment method is selected

		$isExternalPayment = in_array($object->getType(), $this->externalPaymentProvider);
		$isEmptyTransactionId = !isset($object->getTransactionId())
														|| NULL === $object->getTransactionId()
														|| '' === $object->getTransactionId();

		if ($isExternalPayment && $isEmptyTransactionId) {
			$msg = sprintf('External payment methods must set a transaction ID in order to create traceable payments.');
			$this->addError($msg, 1326895372);

			return FALSE;
		}

		return TRUE;
	}
}
?>