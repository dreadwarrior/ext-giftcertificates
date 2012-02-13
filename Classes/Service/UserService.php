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
 * A user service which is responsible for storing data into the session.
 *
 * @package giftcertificates
 * @subpackage Service
 * @api
 */
class Tx_Giftcertificates_Service_UserService implements t3lib_Singleton, ArrayAccess {

	/**
	 * a configuration manager instance
	 *
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 */
	protected $configurationManager;

	/**
	 * a session namespace identification string
	 * 
	 * @var string
	 */
	protected $sessionNamespace;

	/**
	 * flags if the current communication happens in backend
	 *
	 * @var boolean
	 */
	protected $isBackend = FALSE;

	/**
	 * injects the configuration manager
	 * 
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}

	/**
	 * initialization, called by the ObjectManager
	 * 
	 * This sets the session namespace (extension name currently) and registers the
	 * shutdown function which is responsible for actually persisting the session data.
	 * 
	 * @return void
	 */
	public function initializeObject() {
		$configuration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$this->sessionNamespace = t3lib_div::camelCaseToLowerCaseUnderscored($configuration['extensionName']);

		if ('BE' === TYPO3_MODE) {
			$this->isBackend = TRUE;
		}

		register_shutdown_function(array($this, '_shutdown'));
	}

	/**
	 * saves the given data into the user session
	 * 
	 * @param mixed $data
	 * @return void
	 * @api
	 */
	public function write($data) {
		if ($this->isBackend) {
			$GLOBALS['BE_USER']->setAndSaveSessionData($this->sessionNamespace, $data);
		} else {
			$GLOBALS['TSFE']->fe_user->setKey('ses', $this->sessionNamespace, $data);
		}
	}

	/**
	 * returns the session data
	 * 
	 * @return mixed
	 * @api
	 */
	public function read() {
		if ($this->isBackend) {
			return $GLOBALS['BE_USER']->getSessionData($this->sessionNamespace);
		} else {
			return $GLOBALS['TSFE']->fe_user->getKey('ses', $this->sessionNamespace);
		}
	}

	/**
	 * cleans up the session data
	 * 
	 * @return void
	 * @api
	 */
	public function delete() {
		if ($this->isBackend) {
			$GLOBALS['BE_USER']->setAndSaveSessionData($this->sessionNamespace, NULL);
		} else {
			$GLOBALS['TSFE']->fe_user->setKey('ses', $this->sessionNamespace, NULL);
		}
	}

	/**
	 * stores the session data
	 * 
	 * This is called automatically at the end of a request cycle, but you're allowed
	 * to call this by yourself, if you have the need to access session data during
	 * the same request.
	 *
	 * @return void
	 * @api
	 */
	public function storeSessionData() {
		if (FALSE === $this->isBackend) {
			$GLOBALS['TSFE']->fe_user->storeSessionData();
		}
	}

	/**
	 * stores the session data automatically
	 * 
	 * @return void
	 */
	public function _shutdown() {
		$this->storeSessionData();
	}

	/***********************************
	 * 
	 * ArrayAccess interface API methods
	 * 
	 **********************************/

	/**
	 * (non PHP-doc)
	 * 
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) {
		$data = $this->read();

		return isset($data[$offset]);
	}

	/**
	 * (non PHP-doc)
	 * 
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) {
		$data = $this->read();

		if (!$this->offsetExists($offset)) {
			throw new Tx_Extbase_Exception('The specified offset doesn\'t exist and therefore can\'t be retrieved.', 1321350840);
		}

		return $data[$offset];
	}

	/**
	 * (non PHP-doc)
	 * 
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value) {
		$data = $this->read();
		$data[$offset] = $value;

		$this->write($data);
	}

	/**
	 * (non PHP-doc)
	 * 
	 * @see ArrayAccess::offsetUnset
	 */
	public function offsetUnset($offset) {
		$data = $this->read();

		if (!$this->offsetExists($offset)) {
			throw new Tx_Extbase_Exception('The specified offset doesn\'t exist and therefore can\'t be removed!', 1321350920);
		}

		unset($data[$offset]);

		$this->write($data);
	}
}
?>