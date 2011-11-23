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
 * a serial generator based on CakePHP's String::uuid() method
 * 
 * @see https://github.com/cakephp/cakephp/blob/master/lib/Cake/Utility/String.php
 *
 * @package giftcertificates
 * @subpackage Serial
 */
class Tx_Giftcertificates_Serial_RandomUUIDSerial implements Tx_Giftcertificates_Serial_SerialInterface {

	/**
	 * generates a GUID
	 * 
	 * (non-PHPdoc)
	 *
	 * @see Tx_Giftcertificates_Serial_SerialInterface::generate()
	 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
	 */
	public function generate($input) {
		$node = t3lib_div::getIndpEnv('SERVER_ADDR');

		if (FALSE !== strpos($node, ':')) {
			if (substr_count($node, '::')) {
				$colonOccurence = substr_count($node, ':');
				$collapsedZeroGroupReplacement = str_repeat(':0000', 8 - $colonOccurence);

				$node = str_replace('::', $collapsedZeroGroupReplacement . ':' . $node);
			}

			$node = explode(':', $node);
			$ipv6 = '';

			foreach ($node as $id) {
				$ipv6 .= str_pad(base_convert($id, 16, 2), 16, 0, STR_PAD_LEFT);
			}
			$node = base_convert($ipv6, 2, 10);

			if (38 > strlen($node)) {
				$node = NULL;
			} else {
				$node = crc32($node);
			}
		} elseif (empty($node)) {
			$host = t3lib_div::getIndpEnv('HOSTNAME');

			if (empty($host)) {
				$host = t3lib_div::getIndpEnv('HOST');
			}

			if (!empty($host)) {
				$ip = gethostbyname($host);

				if ($ip === $host) {
					$node = crc32($host);
				} else {
					$node = ip2long($ip);
				}
			}
		} elseif ('127.0.0.1' !== $node) {
			$node = ip2long($node);
		} else {
			$node = NULL;
		}

		if (empty($node)) {
			$node = crc32($GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey']);
		}

		if (function_exists('zend_thread_id')) {
			$pid = zend_thread_id();
		} else {
			$pid = getmypid();
		}

		if (!$pid || $pid > 65535) {
			$pid = mt_rand(0, 0xfff) | 0x4000;
		}

		list($timeMid, $timeLow) = explode(' ', microtime());

		$uuid = sprintf('%08x-%04x-%04x-%02x%02x-%04x%08x', 
			(int) $timeLow,
			(int) substr($timeMid, 2) & 0xffff,
			mt_rand(0, 0xfff) | 0x4000,
			mt_rand(0, 0x3f) | 0x80,
			mt_rand(0, 0xff),
			$pid,
			$node 
		);

		return $uuid;
	}

	/**
	 * (non-PHPdoc)
	 * @see Tx_Giftcertificates_Serial_SerialInterface::validate()
	 */
	public function validate($challenger, $defender) {
		return $challenger === $defender;
	}
}
?>