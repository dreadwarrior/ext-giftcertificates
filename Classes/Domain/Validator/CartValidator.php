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
class Tx_Giftcertificates_Domain_Validator_CartValidator extends Tx_Giftcertificates_Validation_Validator_AbstractValidator {

	/**
	 * validates the incoming cart object
	 *
	 * @param Tx_Giftcertificates_Domain_Model_Cart $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (!is_a($value, 'Tx_Giftcertificates_Domain_Model_Cart')) {
			$msg = sprintf('Given object (%s) is not of expected type (Tx_Giftcertificates_Domain_Model_Cart)!', get_class($value));
			$this->addError($msg, 1327065505);

			return FALSE;
		}

		/*
		if (FALSE === $this->resolveAndProcessSubPropertyValidation($value, 'certificate')) {
			return FALSE;
		}
		*/

		return TRUE;
	}
}
?>