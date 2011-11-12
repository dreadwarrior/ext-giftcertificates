<?php
class Tx_Giftcertifiates_Service_Settings implements t3lib_Singleton {

	/**
	 * 
	 * @var mixed
	 */
	protected $settings = NULL;

	/**
	 * 
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * injects the configuration manager and loads the settings
	 * 
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
	}

	/**
	 * returns the extension settings
	 * 
	 * @return array
	 */
	public function getSettings() {
		if (NULL === $this->settings) {
			$this->settings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		}

		return $this->settings;
	}

	/**
	 * returns the settings at $propertyPath, which is separated by "."
	 * 
	 * "pages.uid" would return $this->settings['pages']['uid']. If the path
	 * is invalid or no entry was found, false is returned.
	 * 
	 * @param string $propertyPath a path, separated by "."
	 * @return mixed
	 */
	public function getByPath($propertyPath) {
		return Tx_Extbase_Reflection_ObjectAccess::getPropertyPath($this->settings, $propertyPath);
	}
}
?>