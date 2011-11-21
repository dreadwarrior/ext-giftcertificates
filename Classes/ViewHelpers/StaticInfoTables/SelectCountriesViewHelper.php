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
 * @see tx_staticinfotables_pi1::buildStaticInfoSelector()
 *
 * @package giftcertificates
 * @subpackage ViewHelpers\StaticInfoTables
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_ViewHelpers_StaticInfoTables_SelectCountriesViewHelper extends Tx_Giftcertificates_Core_ViewHelper_AbstractStaticInfoTablesViewHelper {

	/**
	 * initializing the arguments for this view helper
	 * 
	 * This method basically re-maps all the arguments of tx_staticinfotables_pi1::buildStaticInfoSelector()
	 * 
	 * @return void
	 */
	public function initializeArguments() {
		$this
			->registerArgument('name', 'string', 'A value for the name attribute of the <select> tag', TRUE)
			->registerArgument('class', 'string', 'A value for the class attribute of the <select> tag', FALSE, '')
			->registerArgument('selectedArray', 'array', 'The values of the code of the entries to be pre-selected in the drop-down selector: value of cn_iso_3, zn_code, cu_iso_3 or lg_iso_2', FALSE, array())
			->registerArgument('country', 'string', 'The value of the country code (cn_iso_3) for which a drop-down selector of type \'SUBDIVISIONS\' is requested (meaningful only in this case)', FALSE, '')
			->registerArgument('submit', 'string', 'If set to 1, an onchange attribute will be added to the <select> tag for immediate submit of the changed value; if set to other than 1, overrides the onchange script', FALSE, 0)
			->registerArgument('id', 'string', 'A value for the id attribute of the <select> tag', FALSE, '')
			->registerArgument('title', 'string', 'A value for the title attribute of the <select> tag', FALSE, '')
			->registerArgument('addWhere', 'string', 'A where clause for the records', FALSE, '')
			->registerArgument('lang', 'string', 'language to be used', FALSE, '')
			->registerArgument('local', 'boolean', 'If set, we are looking for the "local" title field', FALSE, FALSE)
			->registerArgument('mergeArray', 'array', 'additional array to be merged as key => value pair', FALSE, array())
			->registerArgument('size', 'integer', 'max elements that can be selected. Default: 1', FALSE, 1)
			->registerArgument('outSelectedArray', 'array', 'resulting selected array with the ISO alpha-3 code of the countries', FALSE, array());
	}

	/**
	 * renders a select list with countries from ext:static_info_tables
	 * 
	 * @return string
	 */
	public function render() {
		return $this->api->buildStaticInfoSelector('COUNTRIES', 
			$this->arguments['name'],
			$this->arguments['class'],
			$this->arguments['selectedArray'],
			$this->arguments['country'],
			$this->arguments['submit'],
			$this->arguments['id'],
			$this->arguments['title'],
			$this->arguments['addWhere'],
			$this->arguments['lang'],
			$this->arguments['local'],
			$this->arguments['mergeArray'],
			$this->arguments['size'],
			$this->arguments['outSelectedArray']
		);
	}
}
?>