<?php

class checkFile {
	private $f = 'myfile.txt';
	private $t = 'time.txt';
	private $dateFormat = "F d Y H:i:s"; // "D d M Y g:i A"
	private $mtime = '';

	function __construct() {
		if(!file_exists($this->f))
		$handle = fopen($this->f, 'w') or die('Cannot open file:  '.$this->f);
		if(!file_exists($this->t))
		$handle = fopen($this->t, 'w') or die('Cannot open file:  '.$this->t);
		$this->mtime = filemtime($this->f);
	}

	private function getLastModTime($t) {
		$file_handle = fopen($t, "r");
		while (!feof($file_handle)) {
			return $line = fgets($file_handle);
		}
	}

	public function getResult() {
		if ($this->getLastModTime($this->t) != $this->mtime) {
		  echo "$this->f was modified! At: ".date($this->dateFormat, $this->mtime);
		  $file_handle = fopen($this->t, 'w');
			fwrite($file_handle, $this->mtime);
			fclose($file_handle);
		} else {
			echo "$this->f Not modified! Last Time: ".date($this->dateFormat, $this->getLastModTime($this->t));
		}
	}
}

$checkFile = new checkFile();
$checkFile->getResult();
