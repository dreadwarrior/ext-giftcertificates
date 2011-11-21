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
 * ViewHelper for retrieving a <select> list from static_info_tables API
 * 
 * @see tx_staticinfotables_pi1::getStaticInfoName()
 *
 * @package giftcertificates
 * @subpackage ViewHelpers\StaticInfoTables
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_ViewHelpers_StaticInfoTables_InfoNameViewHelper extends Tx_Giftcertificates_Core_ViewHelper_AbstractStaticInfoTablesViewHelper {

	/**
	 * initializing the arguments for this view helper
	 * 
	 * This method basically re-maps all the arguments of tx_staticinfotables_pi1::buildStaticInfoSelector()
	 * 
	 * @return void
	 */
	public function initializeArguments() {
		$this
			->registerArgument('type', 'string', 'Defines the type of entry of the requested name: "TERRIRORIES", "COUNTRIES", "SUBDIVISIONS", "CURRENCIES", "LANGUAGES", "TAXES", "SUBTAXES"', TRUE)
			->registerArgument('code', 'string', 'The ISO alpha-3 code of a territory, country or currency, or the ISO alpha-2 code of a language or the code of a country subdivision, can be a comma "," separated string, then all the single items are looked up and returned', TRUE)
			->registerArgument('country', 'string', 'The value of the country code (cn_iso_3) for which a name of type "SUBDIVISIONS", "TAXES" or "SUBTAXES" is requested (meaningful only in these cases)', FALSE, '')
			->registerArgument('countrySubdivision', 'string', 'The value of the country subdivision code for which a name of type "SUBTAXES" is requested (meaningful only in this case)', FALSE, '')
			->registerArgument('local', 'boolean', FALSE, FALSE);
	}

	/**
	 * Getting the name of a country, country subdivision, currency, language, tax
	 * 
	 * @return string The name of the object in the current language
	 */
	public function render() {
		return $this->api->getStaticInfoName(
			$this->arguments['type'],
			$this->arguments['code'],
			$this->arguments['country'],
			$this->arguments['countrySubdivision'],
			$this->arguments['local']
		);
	}
}
?>