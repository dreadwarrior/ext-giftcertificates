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
 * domain model object validator
 *
 * @package giftcertificates
 * @subpackage Domain\Validator
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Domain_Validator_CertificateValidator extends Tx_Giftcertificates_Validation_Validator_AbstractValidator {

	/**
	 * an identification service instance
	 *
	 * @var Tx_Giftcertificates_Service_IdentificationService
	 */
	protected $identificationService;

	/**
	 * the certificate repository
	 *
	 * @var Tx_Giftcertificates_Domain_Repository_CertificateRepository
	 */
	protected $certificateRepository;

	/**
	 * injects the identification generator service
	 * 
	 * @param Tx_Giftcertificates_Service_IdentificationService $identificationService
	 * @return void
	 */
	public function injectIdentificationService(Tx_Giftcertificates_Service_IdentificationService $identificationService) {
		$this->identificationService = $identificationService;
	}

	/**
	 * injects the certificate repository
	 *
	 * The repository is needed to check against uniqueness of the identification data
	 *
	 * @param Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository
	 */
	public function injectCertificateRepository(Tx_Giftcertificates_Domain_Repository_CertificateRepository $certificateRepository) {
		$this->certificateRepository = $certificateRepository;
	}

	/**
	 * validates the certificate
	 * 
	 * @param Tx_Giftcertificates_Domain_Model_Certificate $value
	 * @return boolean
	 */
	public function isValid($value) {
		if (!$value instanceof Tx_Giftcertificates_Domain_Model_Certificate) {
			$msg = sprintf('The given object (%s) is not of correct type (must be: Tx_Giftcertificates_Domain_Model_Certificate)', get_class($value));
			$this->addError($msg, 1326878250);

			return FALSE;
		}

		// identification is only set on creation - no changes allowed after object is persisted!
		if (NULL === $value->getIdentification()) {
			do {
				$identification = $this->identificationService->createIdentification($value->getUid());
				$value->setIdentification($identification);
			} while (0 < $this->certificateRepository->countByIdentification($identification));
		}

		if (NULL === $value->getIsRedeemed()) {
			$value->setIsRedeemed(FALSE);
		}

		if (FALSE === $this->resolveAndProcessSubPropertyValidation($value, 'donee')) {
			return FALSE;
		}

		return TRUE;
	}
}
?>