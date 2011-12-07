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
 * ViewHelper for rendering a <select> list from static_info_tables API
 * 
 * @see tx_staticinfotables_pi1::buildStaticInfoSelector()
 *
 * @package giftcertificates
 * @subpackage ViewHelpers\StaticInfoTables
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_ViewHelpers_StaticInfoTables_SelectCountriesViewHelper extends Tx_Fluid_ViewHelpers_Form_SelectViewHelper implements Tx_Giftcertificates_Core_ViewHelper_StaticInfoTablesViewHelperInterface {
	
	/**
	* reference to static_info_tables API
	*
	* @var tx_staticinfotables_pi1
	*/
	protected $api;

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_Core_ViewHelper_StaticInfoTablesViewHelperInterface::injectStaticInfoTablesApiInitService()
	 */
	public function injectStaticInfoTablesApiInitService(Tx_Giftcertificates_Service_StaticInfoTablesApiInitService $staticInfoTablesApiInitService) {
		$this->api = $staticInfoTablesApiInitService->getApi();
	}

	/**
	 * initializing the arguments for this view helper
	 * 
	 * This method basically re-maps all the arguments of tx_staticinfotables_pi1::buildStaticInfoSelector()
	 * 
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();

		$this
			->registerArgument('apiAddWhere', 'string', 'A where clause for the records', FALSE, '')
			->registerArgument('apiLang', 'string', 'language to be used', FALSE, '')
			->registerArgument('apiLocal', 'boolean', 'If set, we are looking for the "local" title field', FALSE, FALSE);

		// overrides argument "options" from Tx_Fluid_ViewHelpers_Form_SelectViewHelper
		$this
			->overrideArgument('options', 'array', 'Associative array with internal IDs as key, and the values are displayed in the select box', FALSE);
	}

	/**
	 * returns the options for the select list
	 *
	 * This method overrides the SelectViewHelper by fetching the options
	 * via static_info_tables_pi1::initCountries() call
	 *
	 * @return array an associative array of options, key will be the value of the option tag
	 */
	protected function getOptions() {
		if (FALSE === $this->arguments['options']
				|| 0 === count($this->arguments['options'])) {
			$this->arguments['options'] = $this->api->initCountries(
				'ALL', 
				$this->arguments['apiLang'], 
				$this->arguments['apiLocal'], 
				$this->arguments['apiAddWhere']
			);
		}

		return parent::getOptions();
	}
}
?>