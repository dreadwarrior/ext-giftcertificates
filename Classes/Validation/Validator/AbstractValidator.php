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
 * project specific abstract validator
 * 
 * This validator extends the AbstractValidator of extbase by adding
 * some useful methods to ti.
 *
 * @package giftcertificates
 * @subpackage Domain\Validator
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
abstract class Tx_Giftcertificates_Validation_Validator_AbstractValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {
	
	/**
	 * object manager instance
	 *
	 * @var Tx_Extbase_Object_ObjectManager
	 */
	protected $objectManager;

	/**
	 * injects object manager
	 *
	 * @param Tx_Extbase_Object_ObjectManager $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * resolves and processes validation for a sub property
	 *
	 * @param Tx_Extbase_DomainObject_AbstractEntity $object the target object to fetch the property from
	 * @param string $propertyName name of the property to be validated
	 * @return boolean FALSE if sub property is not valid, TRUE otherwise
	 */
	protected function resolveAndProcessSubPropertyValidation(Tx_Extbase_DomainObject_AbstractEntity $object, $propertyName) {
		$validatorResolver = $this->objectManager->get('Tx_Extbase_Validation_ValidatorResolver'); /* @var $validatorResolver Tx_Extbase_Validation_ValidatorResolver */
		$subPropertyValidator = $validatorResolver->getBaseValidatorConjunction('Tx_Giftcertificates_Domain_Model_'. ucfirst($propertyName));

		$value = call_user_func(array($object, 'get'. ucfirst($propertyName)));

		try {
			if (!$subPropertyValidator->isValid($value)) {
				$subPropertyError = $this->createPropertyError($propertyName, $subPropertyValidator->getErrors());
	
				$this->result->addError($subPropertyError);
	
				return FALSE;
			}
		}
		catch (Tx_Extbase_Reflection_Exception_PropertyNotAccessibleException $e) {
			if (is_a($value, 'Tx_Extbase_Persistence_ObjectStorage')) {
				
				/* @var $value Tx_Extbase_Persistence_ObjectStorage */
				foreach ($value as $actualObject) {
					if (FALSE === $this->resolveAndProcessSubPropertyValidation($actualObject, $propertyName)) {
						return FALSE;
					}
				}
			}
		}

		return TRUE;
	}

	/**
	 * creates a PropertyError object
	 *
	 * The returned object can be added to the validation results
	 * @see http://lists.typo3.org/pipermail/typo3-project-typo3v4mvc/2011-August/010131.html
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