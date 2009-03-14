<?php
require_once 'PHPUnit/Framework.php';
require_once "../includes.php";

class TestNode {
	function __construct($item) {
		$this->item = $item;
	}
	function upper() {
		return strtoupper($this->item);
	}
}

class VectorTest extends PHPUnit_Framework_TestCase {

		public function testVectorMapWithProc() {
			$proc = new Proc('value', 'return strrev($value);');
			$vector_of_strings = new Vector("testa", "testb", "testc");
			$this->assertEquals($vector_of_strings->map($proc)->data, array("atset","btset","ctset"));
		}
		public function testVectorMapWithFunction() {
			$vector_of_strings = new Vector("testa", "testb", "testc");
			$this->assertEquals($vector_of_strings->map('strtoupper')->data, array("TESTA","TESTB","TESTC"));
		}

		public function testVectorMapWithMethod() {
			
			$vector_of_objects = new Vector(
														new TestNode("testa"),
														new TestNode("testb"),
														new TestNode("testc")
													);
													
			$this->assertEquals($vector_of_objects->map('upper')->data, array("TESTA","TESTB","TESTC"));
		}
		public function testVectorInjection() {
			$vector_of_strings = new Vector("testa", "testb", "testc");
			$result = $vector_of_strings->inject("", 'accumulator', 'value', 'return $accumulator . $value;');
			$this->assertEquals("testatestbtestc", $result);
		}
}

?>
