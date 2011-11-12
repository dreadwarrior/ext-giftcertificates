<?php
class Tx_Giftcertificates_Service_SessionHandler implements t3lib_Singleton {

	/**
	 * returns the object stored in the user's PHP session
	 * 
	 * @return Object the stored object
	 */
	public function restoreFromSession() {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_giftcertificates_frontend');
		return unserialize($sessionData);
	}

	/**
	 * writes an object into the PHP session
	 * 
	 * @param Object $object any serializable object to store into the session
	 * @return Tx_Giftcertificates_Service_SessionHandler
	 */
	public function writeToSession($object) {
		$sessionData = serialize($object);
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_giftcertificates_frontend', $sessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();

		return $this;
	}

	/**
	 * cleans up the session: removes the stored object from the PHP session
	 * 
	 * @return Tx_Giftcertificates_Service_SessionHandler
	 */
	public function cleanUpSession() {
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_giftcertificates_frontend', NULL);
		$GLOBALS['TSFE']->fe_user->storeSessionData();

		return $this;
	}
}
?>