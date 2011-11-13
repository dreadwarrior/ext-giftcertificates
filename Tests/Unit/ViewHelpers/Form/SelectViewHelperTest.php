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

require_once t3lib_extMgm::extPath('fluid', 'Tests/Unit/ViewHelpers/Form/FormFieldViewHelperBaseTestcase.php');

/**
 * SelectViewHelper test case
 *
 * @package giftcertificates
 * @subpackage Tests/Unit/ViewHelpers/Form
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Tests_Unit_ViewHelpers_Form_SelectViewHelperTest extends Tx_Fluid_Tests_Unit_ViewHelpers_Form_FormFieldViewHelperBaseTestcase {

	/**
	 * @var Tx_Giftcertificates_ViewHelpers_Form_SelectViewHelper
	 */
	protected $viewHelper;
	
	public function setUp() {
		parent::setUp();
		$this->arguments['name'] = '';
		$this->arguments['sortByOptionLabel'] = FALSE;
		$this->viewHelper = $this->getAccessibleMock('Tx_Giftcertificates_ViewHelpers_Form_SelectViewHelper', array('setErrorClassAttribute', 'registerFieldNameForFormTokenGeneration'));
	}

	/**
	 * @test
	 * 
	 * @author Thomas Juhnke <tommy@van-tomas.de>
	 */
	public function localizeLabelIsCalledIfL10nFileArgumentIsSet() {
		$this->viewHelper->expects($this->once())->method('localizeLabel')->with('value1');

		$this->arguments['options'] = array(
			'key1' => 'value1'
		);
		$this->arguments['value'] = 'key1';
		$this->arguments['name'] = 'myName';
		$this->arguments['l10nFile'] = 'EXT:giftcertificates/Tests/Unit/ViewHelpers/Form/Fixtures/locallang.xml';

		$this->injectDependenciesIntoViewHelper($this->viewHelper);
		$this->viewHelper->initialize();
		$this->viewHelper->render();
	}

	/**
	 * @test
	 * 
	 * @author Thomas Juhnke <tommy@van-tomas.de>
	 */
	public function localizeLabelIsCalledIfOptionValueStartsWithLLLPrefix() {
		$this->viewHelper->expects($this->once())->method('localizeLabel')->with('LLL:EXT:giftcertificates/Tests/Unit/ViewHelpers/Form/Fixtures/locallang.xml:value1');

		$this->arguments['options'] = array(
			'key1' => 'LLL:EXT:giftcertificates/Tests/Unit/ViewHelpers/Form/Fixtures/locallang.xml:value1'
		);
		$this->arguments['value'] = 'key1';
		$this->arguments['name'] = 'myName';

		$this->injectDependenciesIntoViewHelper($this->viewHelper);
		$this->viewHelper->initialize();
		$this->viewHelper->render();
	}
}
?>