<?php
	interface Enumerable {
		function map($method);
		function inject($initial_value, $accumulator_name, $iterator_name, $block);
	}
?>
