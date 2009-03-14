<?php
	class Proc {
		function __construct() {
			global $meth;
			$args = func_get_args();
			$vector = new Vector($args);
			$this->method_body = $vector->pop();
			foreach($vector as $arg) {
				$vector->data[$vector->key()] = preg_match("/^\$/", $arg) ? $arg : '$'.$arg;
			}
			$this->method_arguments = join(",", $vector->data);
			$this->method_name = create_function($this->method_arguments, $this->method_body);
		}
		function call() {
			$args = func_get_args();
			return call_user_func_array($this->method_name, $args);
		}
		function to_s() {
			return "function ".$this->method_name."(".$this->method_arguments.") {\n".$this->method_body."\n}";
		}
	}
	
?>