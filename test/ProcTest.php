<?php
require_once 'PHPUnit/Framework.php';
require_once "../includes.php";

class ProcTest extends PHPUnit_Framework_TestCase {
		public function testProc() {
			$proc = new Proc('value', 'return strrev($value);');
			
			$this->assertEquals("TSET", $proc->call('TEST'));
		}
}

?>
