<?php
$f = 'myfile.txt';
$t = 'time.txt';
if(!file_exists($f))
$handle = fopen($f, 'w') or die('Cannot open file:  '.$f);
if(!file_exists($t))
$handle = fopen($t, 'w') or die('Cannot open file:  '.$t);

$dateFormat = "F d Y H:i:s"; // "D d M Y g:i A"

//$atime = fileatime($f);
//$ctime = filectime($f);
$mtime = filemtime($f);

$file_handle = fopen($t, "r");
while (!feof($file_handle)) {
	$line = fgets($file_handle);
}
if ($line != $mtime) {
  echo "$f was modified! At: ".date($dateFormat, $mtime);
  $file_handle = fopen($t, 'w');
	fwrite($file_handle, $mtime);
	fclose($file_handle);
} else {
	echo "$f Not modified! Last Time: ".date($dateFormat, $line);
}