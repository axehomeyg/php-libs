<?php
class File {
	function __construct($filename) {
		$this->file = $filename;
	}
  function filesize($block = 'b') {
		$size = filesize($this->file);
		$block = strtolower($block);
		switch($block) {
			case "b":
				return $size;
				break;
			case "kb":
				return $size / 1024;
				break;
			case "mb":
			default:
				return $size / 1024 / 1024;
				break;
		}
		return $size;
	}
	function touch($mode = null) {
		touch($this->file);
		if($mode)	chmod($this->file, $mode);
	}
	function append($content) {
    $f = fopen($this->file, "a+");
		fwrite($f, $content);
		fclose($f);
	}
	function write($content) {
		$f = fopen($this->file, "w+");
    fwrite($f, $content);
    fclose($f);
	}
	function read($content) {
		return file_get_contents($this->file);
	}
  function join() {
    $args = func_get_args();
    return preg_replace("/\/{2,}/","/", join("/",$args));
  }


}
?>
