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
 * domain model object validator for ShippingAddress
 *
 * @package giftcertificates
 * @subpackage Domain\Validator
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Validator_ShippingAddressValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * (non-PHPdoc)
	 * @see Tx_Extbase_Validation_Validator_AbstractValidator::isValid()
	 *
	 * @param Tx_Giftcertificates_Domain_Model_ShippingAddress $value
	 */
	public function isValid($value) {
		if (!is_a($value, 'Tx_Giftcertificates_Domain_Model_ShippingAddress')) {
			$msg = sprintf('The given object (%s) is not of required type (Tx_Giftcertificates_Domain_Model_ShippingAddress)', get_class($value));
			$this->addError($msg, 1327329430);

			return FALSE;
		}

		// @todo: perform further validations (email, zip/country/city, address format)

		$isOtherAddress = 'other_address' === $value->getType() ? TRUE : FALSE;
		$isOtherEmail = 'other_email' === $value->getType() ? TRUE : FALSE;

		if ($isOtherAddress
				&& (!$value->isPropertySet('address')
				|| !$value->isPropertySet('zip')
				|| !$value->isPropertySet('city')
				|| !$value->isPropertySet('country'))) {
			$msg = sprintf('You must specify the street address, zip, city & country for this shipping type!');
			$this->addError($msg, 1327338327);

			return FALSE;
		}

		if ($isOtherEmail
				&& (!$value->isPropertySet('email'))) {
			$msg = sprintf('You must specify the email for this shipping type!');
			$this->addError($msg, 1327338437);

			return FALSE;
		}

		return TRUE;
	}
}
?>