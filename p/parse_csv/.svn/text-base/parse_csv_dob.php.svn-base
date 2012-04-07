<?php

class Parse_csv_dob
{
	var $handle; 
	var $file; 
	var $line;
	var	$inputurl;
	var $outputurl;
	
	/**
	 * Constructor
	 */
	function Parse_csv_dob($inputurl='', $outputurl='', $lines='', $handle='', $file='') 
	{ 
		$this->inputurl=$inputurl;
		$this->outputurl=$outputurl;
		$this->line=$lines;
		$this->handle=$handle;
		$this->file=$file;
	}		
	
	/**
	 * Parse 
	 */
	function parse($in, $out) 
	{ 
	set_time_limit(0);
	ini_set('memory_limit','16M');
	
	$this->inputurl=$in;
	$this->outputurl=$out;
	$this->handle = fopen($this->inputurl, 'r');
	$this->file = fopen($this->outputurl, 'w');
	$this->line = count(file($this->handle));
	
		while (($data = fgetcsv($this->handle, $this->line, chr(9))) !== FALSE) {
			var_dump($data);
			
			//if ($data[21] == "vacant" || $data[21] == "V") {
				foreach($data as $key => $value) {
					fwrite($this->file, $value. ",");
				}
			fputs($this->file, "\n");
			//}
		}
	} 
}


?>