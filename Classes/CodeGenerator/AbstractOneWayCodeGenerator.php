<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Juhnke <tommy@van-tomas.de>
 *  All rights reserved
 *
 *  This class is a backport of the corresponding class of FLOW3.
 *  All credits go to the v5 team.
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
 * a one-way code generator which doesn't support decoding of input data
 *
 * Use this CodeGenerator if you're using some kind of hash code
 *
 * @package giftcertificates
 * @subpackage CodeGenerator
 * @author tommy
 */
abstract class Tx_Giftcertificates_CodeGenerator_AbstractOneWayCodeGenerator implements Tx_Giftcertificates_CodeGenerator_CodeGeneratorInterface {

	/**
	 * will always return TRUE
	 * 
	 * Beware, that generators of this kind needs some manual work in order
	 * to validate the input data...
	 *
	 * @see Tx_Giftcertificates_CodeGenerator_CodeGeneratorInterface::decode()
	 */
	final public function validate($challenger, $defender) {
		return TRUE;
	}
}
?>