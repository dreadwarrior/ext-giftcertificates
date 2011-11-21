<?php
class Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGeneratorTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 *
	 * @var Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGenerator
	 */
	protected $codeGenerator;

	public function setUp() {
		$this->codeGenerator = $this->objectManager->create('Tx_Giftcertificates_CodeGenerator_BaseConversionCodeGenerator');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnStringInput() {
		$code = $this->codeGenerator->generate('HelloWorld!');		
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function generateWillThrowExceptionOnArrayInput() {
		$code = $this->codeGenerator->generate(array('Hello', 'World'));
	}

	/**
	 * 
	 * @test
	 */
	public function encodeOnlyWorksForIntegers() {
		$code = $this->codeGenerator->generate(time());
		$this->assertNotEmpty($code, 'Generation only works for integers. Integer input results in a non-empty string.');

		$code = $this->codeGenerator->generate(17021981);
		$this->assertEquals('19qc5', $code);

		$code = $this->codeGenerator->generate(5140605);
		$this->assertEquals('lziZ', $code);
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnIntegerInput() {
		$code = $this->codeGenerator->validate(1, 'unimportant');
	}

	/**
	 *
	 * @test
	 * @expectedException Tx_Extbase_Exception
	 */
	public function validateWillThrowAnExceptionOnArrayInput() {
		$code = $this->codeGenerator->validate(array('Hello', 'World'), 'unimportant');
	}

	/**
	 *
	 * @test
	 */
	public function validateOnlyWorksForStrings() {
		$validationResult = $this->codeGenerator->validate('19qc5', 17021981);
		$this->assertTrue($validationResult, 'Validation succeeds if challenger and defender matches.');

		$validationResult = $this->codeGenerator->validate('19qc5', time());
		$this->assertFalse($validationResult, 'Validation fails if challenger and defender dont match.');
	}
}
?>