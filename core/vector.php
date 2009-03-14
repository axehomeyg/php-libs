<?php

class Vector implements Enumerable, Iterator {
	function __construct($ar = array()) {
		if(is_array($ar)) {
			$this->data = $ar;
		}
		else {
			$args = func_get_args();
			$this->data = $args;
		}
	}

	// ==============
	// = Enumerable =
	// ==============
	function map($method) {
		$new_vector = new Vector; # map is non-destructive
		foreach($this as $value) {
			if(gettype($method) == 'string' && function_exists($method)) {
				# wrap with method call
				$new_vector->data[] = $method($value);
			}
			else if(get_class($method) == 'Proc') {
				# wrap with proc call
				$new_vector->data[] = $method->call($value);
			}
			else {
				# apply method
				$new_vector->data[] = $value->{$method}();
			}
		}
		return $new_vector;
	}
	
	
	function inject($initial_value, $accumulator_name, $iterator_name, $block) {
	  $proc = new Proc($accumulator_name, $iterator_name, $block);
	  foreach($this as $iterator) {
	    $initial_value = $proc->call($initial_value, $iterator);
	  }
	  return $initial_value;
	}
	
	
	function pop() {
		$datum = array_pop($this->data);
		$this->rewind();
		return $datum;
	}
	
	function push() {
		$args = func_get_args();
		foreach($args as $arg) array_push($this->data, $arg);
		$this->rewind();
		return $this;
	}

	// ============
	// = Iterator =
	// ============
	private $valid = FALSE; 
	function rewind() { $this->valid = (FALSE !== reset($this->data));} 
	function current() { return current($this->data);} 
	function key() { return key($this->data);} 
	function next() { $this->valid = (FALSE !== next($this->data));} 
	function valid() { return $this->valid; }
}

?>
