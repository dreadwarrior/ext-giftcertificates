<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
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
 * a validator
 *
 * useless, because $_FILES is not fetched by the request builder of extbase
 * @see http://forge.typo3.org/issues/5718
 *
 * @package giftcertificates
 * @subpackage Validation\Validator
 * @author tommy
 */
class Tx_Giftcertificates_Validation_Validator_WebImageValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * (non-PHPdoc)
	 * @see Tx_Extbase_Validation_Validator_AbstractValidator::isValid()
	 */
  public function isValid($value) {
    die($value);
  }
}
?>