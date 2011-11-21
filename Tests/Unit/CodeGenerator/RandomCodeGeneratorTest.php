<?php
class Tx_Giftcertificates_CodeGenerator_RandomCodeGeneratorTest extends Tx_Extbase_BaseTestCase {

	/**
	 *
	 * @var Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator
	 */
	protected $codeGenerator;

	public function setUp() {
		$this->codeGenerator = $this->objectManager->create('Tx_Giftcertificates_CodeGenerator_RandomCodeGenerator');
	}

	/**
	 *
	 * @test
	 */
	public function returnedCodeDoesNotContainerAnyNumbersWithDefaultAlphabet() {
		$code = $this->codeGenerator->generate('not-used-input-data');
		$this->assertNotContains(3, $code, 'A random code does not contain any numbers with default alphabet');
	}
}
?>