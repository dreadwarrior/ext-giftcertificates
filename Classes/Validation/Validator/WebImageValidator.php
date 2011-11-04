<?php
// useless, because $_FILES is not fetched by the request builder of extbase
// @see http://forge.typo3.org/issues/5718
class Tx_Giftcertificates_Validation_Validator_WebImageValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {
  public function isValid($value) {
    die($value);
  }
}
?>