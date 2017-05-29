<?php
class checkFile {
	protected $f;
	private $mtime;
	private static $t = 'time.txt';
	public $dateFormat = "F d Y H:i:s"; // "D d M Y g:i A"

	function __construct($txtFile) {
		$this->f = $txtFile;
		$this->mtime = filemtime($this->f);

		if(!file_exists(self::$t))
		$handle = fopen(self::$t, 'w') or die('Cannot open file:  '.self::$t);
	}

	public function getLastModTime($t) {
		$file_handle = fopen($t, "r");
		while (!feof($file_handle)) {
			return $time = fgets($file_handle);
		}
	}

	public function getResult() {
		if ($this->getLastModTime(self::$t) != $this->mtime) {
		  echo "$this->f was modified! At: ".date($this->dateFormat, $this->mtime);
		  $file_handle = fopen(self::$t, 'w');
			fwrite($file_handle, $this->mtime);
			fclose($file_handle);
		} else {
			echo "$this->f Not modified! Last Time: ".date($this->dateFormat, $this->getLastModTime(self::$t));
		}
	}
}

$checkFile = new checkFile('myfile.txt');
$checkFile->getResult();
