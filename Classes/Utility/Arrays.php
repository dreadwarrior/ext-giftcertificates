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
 * array manipulation utilities
 *
 * @package giftcertificates
 * @subpackage Utility
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 *
 */
class Tx_Giftcertificates_Utility_Arrays {

  /**
   * Replaces the keys in the given array with an array of in-order
   * replacement keys.
   *
   * @param array &$target
   * @param array $replacementKeys
   * @author Josh Boyd http://www.jbip.net/content/how-replace-keys-array-php
   **/
  static public function renameKeys(&$target, $replacementKeys) {
    $keys = array_keys($target);
    $values = array_values($target);

    for ($i = 0; $i < count($replacementKeys); $i++) {
      $keys[$i] = $replacementKeys[$i];
    }

    $target = array_combine($keys, $values);
  }
}
?>