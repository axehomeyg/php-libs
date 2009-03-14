<?php
class Logger {
	function __construct($log_path) {
		if(!file_exists($log_path)) {
			mkdir($log_path, 0777);
		}
		$this->log_path = $log_path;
	}
	
	function __call($method, $message) {
		$this->write($message, "$method.log");
	}
  function write($message, $file) {
		$file = new File(File::join($this->log_path,$file));
    $file->touch(0777);
		$method = $file->filesize("mb") > (10 * 1024 * 1024) ? "write" : "append";
		$file->{$method}($this->format_message($message));
  }
	private
	function format_message($message) {
		return "[".date("Y-m-d H:m:i")."]: $message\n";
	}
}
?>
