<?php

function logThis($var){
	$toLog = print_r($var, true);
	$bt = debug_backtrace();
  	$caller = array_shift($bt);
  	$file = $caller['file'];
  	$line = $caller['line'];
	$toLog = $toLog."\n".$file.":".$line;
	$fHandle = fopen('Configuration/log.txt', 'a+');
	fwrite($fHandle, date('Y/m/d-h:i:s').": ".$toLog."\n");
}


?>
