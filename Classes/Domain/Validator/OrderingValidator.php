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
 * domain model object validator
 *
 * @package giftcertificates
 * @subpackage Domain\Validator
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Validator_OrderingValidator extends Tx_Giftcertificates_Validation_Validator_AbstractValidator {

	/**
	 * an ordering numbering service
	 *
	 * @var Tx_Giftcertificates_Service_OrderingNumberService
	 */
	protected $orderingNumberingService;

	/**
	 * the ordering repository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_OrderingRepository
	 */
	protected $orderingRepository;

	/**
	 * injects the ordering numbering service
	 *
	 * @param Tx_Giftcertificates_Service_OrderingNumberingService $orderingNumberingService
	 * @return void
	 */
	public function injectOrderingNumberingService(Tx_Giftcertificates_Service_OrderingNumberingService $orderingNumberingService) {
		$this->orderingNumberingService = $orderingNumberingService;
	}

	/**
	 * injects the ordering repository
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_OrderingRepository $orderingRepository
	 * @return void
	 */
	public function injectOrderingRepository(Tx_Giftcertificates_Domain_Repository_OrderingRepository $orderingRepository) {
		$this->orderingRepository = $orderingRepository;
	}

	/**
	 * validates the incoming ordering object
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Ordering $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (!$value instanceof Tx_Giftcertificates_Domain_Model_Ordering) {
			$msg = sprintf('Given object (%s) is not of correct type (must be: Tx_Giftcertificates_Domain_Model_Ordering)', get_class($value));
			$this->addError($msg, 1326878191);

			return FALSE;
		}

		do {
			$orderingNumber = $this->orderingNumberingService->createOrderingNumber();
			$value->setOrderingNumber($orderingNumber);
		} while (0 < $this->orderingRepository->countByOrderingNumber($orderingNumber));

		if ('billing_email' === $value->getShippingType()
				|| 'billing_address' === $value->getShippingType()) {

			$billingAddress = $value->getBillingAddress();
			$shippingAddress = $value->getShippingAddress()->copyFromBillingAddress($billingAddress);
		}

		if (FALSE === $this->resolveAndProcessSubPropertyValidation($value, 'billingAddress')) {
			return FALSE;
		}

		/*
		$billingAddressValidator = $this->objectManager->get('Tx_Extbase_Validation_ValidatorResolver')->getBaseValidatorConjunction('Tx_Giftcertificates_Domain_Model_BillingAddress');
		if (!$billingAddressValidator->isValid($value->getBillingAddress())) {
			$propertyError = $this->createPropertyError('billingAddress', $billingAddressValidator->getErrors());

			$this->result->addError($propertyError);

			return FALSE;
		}
		*/

		if (FALSE === $this->resolveAndProcessSubPropertyValidation($value, 'payment')) {
			return FALSE;
		}

		if (FALSE === $this->resolveAndProcessSubPropertyValidation($value, 'shippingAddress')) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * creates a PropertyError object
	 *  
	 * The returned object can be added to the validation results
	 *
	 * @param string $propertyName
	 * @param array $errors
	 * @return Tx_Extbase_Validation_PropertyError
	 */
	protected function createPropertyError($propertyName, array $errors) {
		$error = new Tx_Extbase_Validation_PropertyError($propertyName);
		$error->addErrors($errors);

		return $error;
	}
}
?>