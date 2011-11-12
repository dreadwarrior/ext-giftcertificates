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
 * upload service class
 *
 * @package giftcertificates
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Service_Upload implements t3lib_Singleton {

	/**
	 * 
	 * @const $namespacePrefix prefix for $_FILES entry point
	 */
	const namespacePrefix = 'tx_giftcertificates_web_giftcertificates';

	/**
	 * 
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * 
	 * @const $uploadTargetDir upload target directory
	 */
	const uploadTargetDir = 'uploads/tx_giftcertificates/';

	/**
	 * 
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * performs an upload
	 * 
	 * @param string $namespaceSuffix $_FILES array entry point; either "backend" or "frontend"
	 * @param array $fieldName an array specifying the path to the form field
	 * @param Tx_Extbase_DomainObject_AbstractEntity $target a domain entity
	 * @param string $property the lowercased_underscored property to set for $target
	 * 
	 * @return mixed TRUE on success, FALSE otherwise; NULL if no files where found in $_FILES
	 */
	public function doUpload($namespaceSuffix = 'backend', array $fieldName, Tx_Extbase_DomainObject_AbstractEntity $target = NULL, $property = NULL) {
		// $_FILES entry point
		$fileInfo = $_FILES[self::namespacePrefix . $namespaceSuffix];

		if ($fileInfo
				&& 0 === Tx_Extbase_Utility_Arrays::getValueByPath($fileInfo['error'], $fieldName)) {
			$basicFileFunctions = $this->objectManager->create('t3lib_basicFileFunctions');

			$fileName = $basicFileFunctions->getUniqueName(
				Tx_Extbase_Utility_Arrays::getValueByPath($fileInfo['name'], $fieldName),
				t3lib_div::getFileAbsFileName(self::uploadTargetDir));

			$uploadStatus = t3lib_div::upload_copy_move(
				Tx_Extbase_Utility_Arrays::getValueByPath($fileInfo['tmp_name'], $fieldName),
				$fileName);

			if (!$uploadStatus) {
				$exceptionMsg = sprintf('The temporary file "%s" could not been uploaded into the upload directory.',
					Tx_Extbase_Utility_Arrays::getValueByPath($fileInfo['tmp_name'], $fieldName));
				throw new Exception($exceptionMsg);
			}

			$method = 'set'. t3lib_div::underscoredToUpperCamelCase($property);

			if (!method_exists($target, $method)) {
				$exceptionMsg = sprintf('The property setter method "%s" does not exist for %s!', $method, get_class($target));
				throw new Exception($exceptionMsg);
			}

			$target->$method(basename($fileName));

			return $uploadStatus;
		}

		return NULL;
	}
}
?>