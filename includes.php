<?php
$debug = false;
foreach(glob(dirname(__FILE__)."/interfaces/*.php") as $file) {
	if($debug) echo $file . "\n";
	include($file);
}
foreach(glob(dirname(__FILE__)."/core/*.php") as $file) {
	if($debug) echo $file . "\n";
	include($file);
}
foreach(glob(dirname(__FILE__)."/lib/*.php") as $file) {
	if($debug) echo $file . "\n";
	include($file);
}

?>
