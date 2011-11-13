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
 *
 *
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Validator_CertificateValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * 
	 * @var Tx_Giftcertificates_Service_IdentificationGeneratorService
	 */
	protected $identificationGeneratorService = NULL;

	/**
	 * injects the identification generator service
	 * 
	 * @param Tx_Giftcertificates_Service_IdentificationGeneratorService $identificationGeneratorService
	 * @return void
	 */
	public function injectIdentificationGeneratorService(Tx_Giftcertificates_Service_IdentificationGeneratorService $identificationGeneratorService) {
		$this->identificationGeneratorService = $identificationGeneratorService;
	}

	/**
	 * validates the certificate
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (!$value instanceof Tx_Giftcertificates_Domain_Model_Certificate) {
			return FALSE;
		}

		if (NULL === $value->getIdentification()) {
			$value->setIdentification($this->identificationGeneratorService->getIdentification());
		}

		if (NULL === $value->getIsRedeemed()) {
			$value->setIsRedeemed(FALSE);
		}

		return TRUE;
	}
}
?>