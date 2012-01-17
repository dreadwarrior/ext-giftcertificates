<?php
class Tx_Giftcertificates_Domain_Validator_OrderingValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {
	public function isValid($value) {
		if (!$value instanceof Tx_Giftcertificates_Domain_Model_Ordering) {
			return FALSE;
		}

		//if ($value->getShippingType())
	}
}
?>